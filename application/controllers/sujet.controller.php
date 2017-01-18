<?php

namespace Sistr;

defined('SISTR') or die("Accès interdit");

/**
 * Classe SujetController
 */
class SujetController extends \F3il\Controller {

    /**
     * Constructeur de la classe
     */
    public function __construct() {
        parent::redirectIfUnauthenticated("?controller=index&action=index");
        parent::setDefaultActionName("lister");
    }

    /**
     * Fonction permttant de lister les sujets
     */
    public function listerAction() {

        //Récupérer l'instance de la page 
        $page = \F3il\Page::getInstance();

        //Régler le template et la vue 
        $page->setTemplate("application")->setView("sujet-liste");

        $page->addStyleSheet("sistr");
        $page->addStyleSheet("reset");
        $page->addStyleSheet("font-awesome.min");
    }

}
