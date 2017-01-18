<?php

namespace Sistr;

defined('SISTR') or die("Accès interdit");

/**
 * Classe SuiviController
 */
class SuiviController extends \F3il\Controller {

    /**
     * COnstructeur de la classe
     */
    public function __construct() {
        parent::redirectIfUnauthenticated("?controller=index&action=index");
        parent::setDefaultActionName("lister");
    }

    /**
     * Fonction permettant de lister les suivis
     */
    public function listerAction() {

        //Récupérer l'instance de la page 
        $page = \F3il\Page::getInstance();

        //Régler le template et la vue 
        $page->setTemplate("application")->setView("vue2");
    }

}
