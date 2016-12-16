<?php

namespace Sistr;

defined('SISTR') or die("Accès interdit");

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of utilisateur
 *
 * @author Quentin
 */
class UtilisateurController extends \F3il\Controller {

    public function __construct() {
        parent::redirectIfUnauthenticated("?controller=index&action=index");
        parent::setDefaultActionName("lister");
    }

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
        if (!\F3il\CsrfHelper::checkTocken()) {
            \F3il\Messenger::setMessage("Données de formulaire refusées");
            $mes = \F3il\Messenger::getMessage();
            if ($mes) {
                \F3il\Messages::addMessage($mes, \F3il\Messages::MESSAGE_ERROR);
            }
            return;
        }

        $fieldid = $form->getField('id');
        $fieldid->value = 0;

        //Rattacher l'objet formulaire à la page
        $page->form = $form;

        //Si le formulaire n'a pas été envoyé
        if (!$form->isSubmitted()) {
            return;
        }

        //Charger les données depuis POST
        $form->loadData(INPUT_POST);
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
        if (!\F3il\CsrfHelper::checkTocken()) {
            \F3il\Messenger::setMessage("Données de formulaire refusées");
            $mes = \F3il\Messenger::getMessage();
            if ($mes) {
                \F3il\Messages::addMessage($mes, \F3il\Messages::MESSAGE_ERROR);
            }
            return;
        }

        $form->loadData(INPUT_POST);
        $formData = $form->getData();
        $id = $formData['id'];

        $fieldmdp = $form->getField('motdepasse');
        $fieldmdp->required = FALSE;
        $fieldconfirmation = $form->getField('confirmation');
        $fieldconfirmation->required = FALSE;

        //Rattacher l'objet formulaire à la page
        $page->form = $form;

        //Si le formulaire n'a pas été envoyé
        if (!$form->isSubmitted()) {
            $newFormData = $model->lire($id);
            var_dump($newFormData);
            var_dump(TRUE && FALSE);
            $form->loadData($newFormData);
            $form->getField('id')->value;
            $form->getField('nom')->value;
            $form->getField('prenom')->value;
            $form->getField('email')->value;
            $form->getField('login')->value;
            $fieldmdp->value = "";
            $fieldconfirmation->value = "";
        }


        //Si le formulaire n'est pas valide
        if ($form->isValid()) {
            \F3il\Messenger::setMessage("Le formulaire est valide");
            \F3il\Messenger::setMessage("L'utilisateur " . $formData['nom'] . " " . $formData['prenom'] . " a bien été modifié");
            \F3il\HttpHelper::redirect('?controller=utilisateur&action=lister');
        } else {
            \F3il\Messenger::setMessage("Le formulaire n'est pas valide");
            $mes = \F3il\Messenger::getMessage();
            if ($mes) {
                \F3il\Messages::addMessage($mes, \F3il\Messages::MESSAGE_ERROR);
            }
        }
    }

    public function deconnecterAction() {
        $auth = \F3il\Authentication::getInstance();
        $auth->logout();
        \F3il\HttpHelper::redirect('?controller=suivi&action=lister');
    }

}
