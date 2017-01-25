<?php

namespace Sistr;

defined('SISTR') or die("Accès interdit");

class NoteController extends \F3il\Controller {

    /**
     * Constructeur de la classe
     */
    public function __construct() {
        parent::setDefaultActionName("lister");
    }

    public function listerAction() {
        $page = \F3il\Page::getInstance();
        $page->setTemplate("application")->setView("note-liste");
        $model = new NoteModel();
        $page->notes = $model->lister();
        $mes = \F3il\Messenger::getMessage();
        if ($mes) {
            \F3il\Messages::addMessage($mes, \F3il\Messages::MESSAGE_SUCCESS);
        }
    }

    public function creerAction() {

        //Récupérer l'instance de la page 
        $page = \F3il\Page::getInstance();

        //Créer l'instance du model
        $model = new NoteModel();

        //Régler le template et la vue 
        $page->setTemplate("application")->setView("note-form");
        $page->setPageTitle("Note utilisateur");
        //Créer l'ojet formulaire
        $form = new NoteForm("?controller=note&action=creer");

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
            \F3il\HttpHelper::redirect('?controller=note&action=lister');
        } else {
            \F3il\Messenger::setMessage("Le formulaire n'est pas valide");
        }
    }

    public function voirAction() {
        $filter = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        if (is_null($filter)) {
            throw new \F3il\Error("Erreur de formulaire");
        } else if ($filter === FALSE) {
            throw new \F3il\Error("Erreur de formulaire");
        } else {
            //Récupérer l'instance de la page 
            $page = \F3il\Page::getInstance();
            
            //Créer l'instance du model
            $model = new NoteModel();

            //Régler le template et la vue 
            $page->setTemplate("application")->setView("note-voir");
            $page->setPageTitle("Note utilisateur");

            $page->note = $model->lire($filter);
            $mes = \F3il\Messenger::getMessage();
            if ($mes) {
                \F3il\Messages::addMessage($mes, \F3il\Messages::MESSAGE_SUCCESS);
            }
        }
    }

}
