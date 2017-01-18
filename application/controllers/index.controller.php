<?php

namespace Sistr;

defined('SISTR') or die("Accès interdit");

/**
 * Classe IndexController
 */
class IndexController extends \F3il\Controller {

    /**
     * Constructeur de la classe
     */
    public function __construct() {
        parent::redirectIfAuthenticated("?controller=suivi&action=lister");
        parent::setDefaultActionName("index");
    }

    /**
     * Fonction permettant de gérer la connexion à l'index
     * @return type
     */
    public function indexAction() {

        //Récupérer l'instance de la page 
        $page = \F3il\Page::getInstance();

        //Régler le template et la vue 
        $page->setTemplate("index")->setView("index");

        $loginForm = new LoginForm("?controller=index&action=index");
        $page->loginForm = $loginForm;

        //Si le formulaire n'a pas été envoyé
        if (!$loginForm->isSubmitted()) {
            return;
        }
        //Charger les données depuis POST
        $loginForm->loadData(INPUT_POST);
        if (!\F3il\CsrfHelper::checkTocken()) {
            \F3il\Messenger::setMessage("Données de formulaire refusées");
            $mes = \F3il\Messenger::getMessage();
            if ($mes) {
                \F3il\Messages::addMessage($mes, \F3il\Messages::MESSAGE_ERROR);
            }
            //return;
        }

        $formData = $loginForm->getData();

        //Si le formulaire n'est pas valide
//        if ($loginForm->isValid()) {
//            $page->message = "Valide";
//            \F3il\HttpHelper::redirect('?controller=utilisateur&action=lister');
//        } else {
//            \F3il\Messenger::setMessage("Login/Mot de passe incorrect");
//            if (\F3il\Messenger::getMessage()) {
//                \F3il\Messages::addMessage(\F3il\Messenger::getMessage(), \F3il\Messages::MESSAGE_ERROR);
//            }
//        }

        $auth = \F3il\Authentication::getInstance();
        if (!$auth->login($formData['login'], $formData['motdepasse'])) {
            \F3il\Messenger::setMessage("Login/Mot de passe incorrect");
            $mes = \F3il\Messenger::getMessage();
            if ($mes) {
                \F3il\Messages::addMessage($mes, \F3il\Messages::MESSAGE_ERROR);
                return;
            }
        }
        \F3il\Messenger::setMessage("Authentification réussie");
        $mes = \F3il\Messenger::getMessage();
        if ($mes) {
            \F3il\Messages::addMessage($mes, \F3il\Messages::MESSAGE_SUCCESS);
        }
        \F3il\HttpHelper::redirect('?controller=suivi&action=lister');
    }

}
