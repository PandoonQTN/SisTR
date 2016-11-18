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

}
