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
        parent::setDefaultActionName("lister");
    }

    public function listerAction() {
        $page = \F3il\Page::getInstance();
        $page->setTemplate("template-bt")->setView("utilisateur-liste");
        $model = new UtilisateursModel();
        $page->utilisateurs = $model->lister();
        $mes = \F3il\Messenger::getMessage();
        if ($mes) {
            \F3il\Messages::addMessage($mes, \F3il\Messages::MESSAGE_SUCCESS);
        }
    }

    public static function editerAction() {
        echo __METHOD__;
        print_r($_POST);
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
        
        //Régler le template et la vue 
        $page->setTemplate("template-bt")->setView("form");
        
        //Créer l'ojet formulaire
        $form = new UtilisateurForm("?controller=utilisateur&action=creer");        
        //$form->id = 0;
        //Rattacher l'objet formulaire à la page
        $page->form = $form;        
               
        //Si le formulaire n'a pas été envoyé
        if(!$form->isSubmitted()){
            return;
        }
        
        //Charger les données depuis POST
        $form->loadData(INPUT_POST);   
        
        
        //Si le formulaire n'est pas valide
        if($form->isValid()){           
            $page->message = "Valide";
            \F3il\Messenger::setMessage("Le formulaire est valide");
        }else{           
            $page->message = "Non valide";
            \F3il\Messenger::setMessage("Le formulaire n'est pas valide");
        }
    }

}
