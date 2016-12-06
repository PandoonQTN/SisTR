<?php

namespace Sistr;

defined('SISTR') or die("Accès interdit");

class FormController extends \F3il\Controller {

    public function formAction() {
        //Récupérer l'instance de la page 
        $page = \F3il\Page::getInstance();
        
        //Régler le template et la vue 
        $page->setTemplate("template-bt")->setView("form");
        
        //Créer l'ojet formulaire
        $form = new TestForm("?controller=form&action=form");        
        
        //Rattacher l'objet formulaire à la page
        $page->form = $form;        
               
        //Si le formulaire n'a pas été envoyé
        if(!$form->isSubmitted()){
            return;
        }
        
        //Charger les données depuis POST
        $form->loadData(INPUT_POST);   
        
        $page->formData = $form->getData();
        
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
