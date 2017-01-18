<?php

namespace F3il;

defined('F3IL') or die("Accès interdit");

class Controller {

    protected $defaultActionName;

    /**
     * FOnction permettant de définir l'action par défaut 
     * @param type $actionName : action
     * @return Controller
     */
    public function setDefaultActionName($actionName) {
        if (!method_exists(get_class($this), $actionName . "Action")) {
            throw new ControllerError("ControllerError", get_class($this), $actionName);
        } else {
            $this->defaultActionName = $actionName . "Action";
        }
    }

    /**
     * Getter permettant de connaitre le nom de l'action par défaut 
     * @return type
     */
    public function getDefaultActionName() {
        return $this->defaultActionName;
    }

    /**
     * Fonction permettant de faire une redirection après l'authentification
     * @param type $redirect
     */
    public function redirectIfAuthenticated($redirect) {
        $auth = Authentication::getInstance();
        if ($auth->isLoggedIn()) {
            \F3il\HttpHelper::redirect($redirect);
        }
    }

    /**
     * Fonction permettant de rediriger vers une page si on n'est pas connecté
     * @param type $redirect
     */
    public function redirectIfUnauthenticated($redirect) {
        $auth = Authentication::getInstance();
        if (!$auth->isLoggedIn()) {
            \F3il\HttpHelper::redirect($redirect);
        }
    }

}
