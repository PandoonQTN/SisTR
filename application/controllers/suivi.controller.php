<?php

namespace Sistr;

defined('SISTR') or die("Accès interdit");

class SuiviController extends \F3il\Controller {

    public function __construct() {
        parent::redirectIfUnauthenticated("?controller=index&action=index");
        parent::setDefaultActionName("lister");
    }

    public function listerAction() {

        //Récupérer l'instance de la page 
        $page = \F3il\Page::getInstance();

        //Régler le template et la vue 
        $page->setTemplate("application")->setView("vue2");
    }

}
