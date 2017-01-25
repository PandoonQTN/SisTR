<?php

namespace Sistr;

defined('SISTR') or die("Accès interdit");

/**
 * Description of utilisateur
 *
 * @author Quentin
 */
class UtilisateurController extends \F3il\Controller {

    /**
     * Constructeur de la classe
     */
    public function __construct() {
        parent::redirectIfUnauthenticated("?controller=index&action=index");
        parent::setDefaultActionName("lister");
    }

    /**
     * Fonction permettant de lister les utilisateurs
     */
    public function listerAction() {
        $page = \F3il\Page::getInstance();
        $page->setTemplate("application")->setView("utilisateur-liste");
        $model = new UtilisateursModel();
        $page->utilisateurs = $model->lister();
        $mes = \F3il\Messenger::getMessage();
        if ($mes) {
            \F3il\Messages::addMessage($mes, \F3il\Messages::MESSAGE_SUCCESS);
        }
    }

    /**
     * FOnction permettant de supprimer un utilisateur
     * @throws \F3il\Error
     */
    public static function supprimerAction() {
        $filter = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        if (is_null($filter)) {
            throw new \F3il\Error("Erreur de formulaire");
        } else if ($filter === FALSE) {
            throw new \F3il\Error("Erreur de formulaire");
        } else {
            $model = new UtilisateursModel();
            $model->supprimer($filter);
            \F3il\Messenger::setMessage("Suppression effectuée");
            \F3il\HttpHelper::redirect('?controller=utilisateur&action=lister');
        }
    }

    /**
     * Fonction permettant de créer un utilisateur 
     * @return type
     */
    public function creerAction() {

        //Récupérer l'instance de la page 
        $page = \F3il\Page::getInstance();

        //Créer l'instance du model
        $model = new UtilisateursModel();

        //Régler le template et la vue 
        $page->setTemplate("application")->setView("utilisateur-form");
        $page->setPageTitle("Créer utilisateur");
        //Créer l'ojet formulaire
        $form = new UtilisateurForm("?controller=utilisateur&action=creer");
        $form->id = 0;
        //Rattacher l'objet formulaire à la page
        $page->form = $form;

        //Si le formulaire n'a pas été envoyé
        if (!$form->isSubmitted()) {
            return;
        }

        //Charger les données depuis POST
        $form->loadData(INPUT_POST);
        if (!\F3il\CsrfHelper::checkTocken()) {
            \F3il\Messenger::setMessage("Données de formulaire refusées");
            $mes = \F3il\Messenger::getMessage();
            if ($mes) {
                \F3il\Messages::addMessage($mes, \F3il\Messages::MESSAGE_ERROR);
            }
            return;
        }
        $formData = $form->getData();

        //Si le formulaire n'est pas valide
        if ($form->isValid()) {
            $model->creer($formData);
            \F3il\Messenger::setMessage("Le formulaire est valide");
            \F3il\Messenger::setMessage("L'utilisateur " . $formData['nom'] . " " . $formData['prenom'] . " a bien été enregisté");
            \F3il\HttpHelper::redirect('?controller=utilisateur&action=lister');
        } else {
            \F3il\Messenger::setMessage("Le formulaire n'est pas valide");
        }
    }

    /**
     * Fonction permettant d'éditer un utilisateur
     * @return type
     */
    public function editerAction() {
        //Récupérer l'instance de la page 
        $page = \F3il\Page::getInstance();

        //Créer l'instance du model
        $model = new UtilisateursModel();

        //Régler le template et la vue 
        $page->setTemplate("application")->setView("utilisateur-form");
        $page->setPageTitle("Modifier utilisateur");
        //Créer l'ojet formulaire
        $form = new UtilisateurForm("?controller=utilisateur&action=editer");

        $fieldmdp = $form->getField('motdepasse');
        $fieldmdp->required = FALSE;
        $fieldconfirmation = $form->getField('confirmation');
        $fieldconfirmation->required = FALSE;

        $form->loadData(INPUT_POST);
        $id = $form->id;

        if (!\F3il\CsrfHelper::checkTocken()) {
            \F3il\Messenger::setMessage("Données de formulaire refusées");
            $mes = \F3il\Messenger::getMessage();
            if ($mes) {
                \F3il\Messages::addMessage($mes, \F3il\Messages::MESSAGE_ERROR);
            }
            return;
        }

        //Rattacher l'objet formulaire à la page
        $page->form = $form;

        //Si le formulaire n'a pas été envoyé
        if (!$form->isSubmitted()) {
            $newFormData = $model->lire($id);
            $form->loadData($newFormData);
            $fieldmdp->value = "";
            $fieldconfirmation->value = "";
        }

        $formData = $form->getData();
        //Si le formulaire n'est pas valide
        if ($form->isValid()) {
            $model->mettreAJour($formData);
            \F3il\Messenger::setMessage("Le formulaire est valide");
            \F3il\Messenger::setMessage("L'utilisateur " . $formData['nom'] . " " . $formData['prenom'] . " a bien été modifié");
            if ($form->isSubmitted())
                \F3il\HttpHelper::redirect('?controller=utilisateur&action=lister');
        } else {
            \F3il\Messenger::setMessage("Le formulaire n'est pas valide");
            $mes = \F3il\Messenger::getMessage();
            if ($mes) {
                \F3il\Messages::addMessage($mes, \F3il\Messages::MESSAGE_ERROR);
            }
        }
    }

    /**
     * Fonction permettant de déconnecter un utilisateur
     */
    public function deconnecterAction() {
        $auth = \F3il\Authentication::getInstance();
        $auth->logout();
        \F3il\HttpHelper::redirect('?controller=suivi&action=lister');
    }

}
