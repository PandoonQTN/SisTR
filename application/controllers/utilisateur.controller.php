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
        $page->setTemplate("template-a")->setView("vue1");
        $page->titre = "liste des utilisateurs";
        \F3il\Messages::addMessage("Premier Message",\F3il\Messages::MESSAGE_SUCCESS);
        $model = new UtilisateursModel();
        
        $page->utilisateurs = $model->lister();
       
    }

}
