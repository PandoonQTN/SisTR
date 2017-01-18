<?php

namespace F3il;

defined('F3IL') or die("Accès interdit");

/**
 * Classe Application
 */
class Application {

    private static $_instance;
    protected $controllerName;
    protected $actionName;
    protected $defaultControllerName;

    /**
     * Constructeur
     * 
     * @param string $iniFile : chemin du fichier INI de confuration
     */
    private function __construct($inifile) {
        Configuration::getInstance($inifile);
    }

    /**
     * Retourne l'instance de l'application
     * @param type $inifile : chenin du fichier INI de configuration
     * @return Application
     */
    public static function getInstance($inifile = "") {
        if (is_null(self::$_instance)) {
            self::$_instance = new Application($inifile);
        }
        return self::$_instance;
    }

    /**
     * Méthode principale d'exécution de l'application Web
     * - Analyse l'URL de la requête
     * - Route la requête vers l'action de contrôleur demandéé
     * - Affiche la page.
     */
    public function run() {


        if (filter_has_var(INPUT_GET, 'controller')) {
            $this->controllerName = filter_input(INPUT_GET, 'controller');
            $controllerClass = "\\" . APPLICATION_NAMESPACE . "\\" . ucfirst($this->controllerName . "Controller");
        } else if (!is_null($this->getDefaultControllerName())) {
            $controllerClass = "\\" . APPLICATION_NAMESPACE . "\\" . ucfirst($this->getDefaultControllerName() . "Controller");
        } else {
            throw new Error("Pas de controleur par défaut");
        }

        $controller = new $controllerClass();
        if (filter_has_var(INPUT_GET, 'action')) {
            $this->actionName = filter_input(INPUT_GET, 'action');
            $controller->setDefaultActionName($this->actionName);
            $actionMethod = $controller->getDefaultActionName();
        } else {
            $actionMethod = $controller->getDefaultActionName();
        }
        if (method_exists($controllerClass, $controller->getDefaultActionName())) {
            $controller->$actionMethod();
        } else {
            throw new ControllerError("ControllerError", $controllerClass, $controller->getDefaultActionName());
        }

        $page = Page::getInstance();
        $page->render();
    }

    /**
     * Getter pour récupérer l'instance de la Page
     * Equivalent à Page::getInstance()
     * 
     * @return Page
     */
    public function getPage() {
        return Page::getInstance();
    }

    /**
     * Getter pour récupérer l'instance de la Configuration
     * Equivalent à Configuration::getInstance()
     * 
     * @return Configuration
     */
    public function getConfiguration() {
        return Configuration::getInstance();
    }

    /**
     * Setter amélioré permettant de définir le controlleur par défaut 
     * @throws ControllerError
     */
    public function setDefaultControllerName($name) {
        if (!is_readable(APPLICATION_PATH . "\\controllers\\" . $name . ".controller.php")) {
            throw new Error("Le fichier " . APPLICATION_PATH . "\\controllers\\" . $name . ".controller.php n'est pas lisible");
        } else {
            $this->defaultControllerName = $name;
        }
    }

    /**
     * Getter permettant connaitre le nom du controleur par défaut
     * @return type 
     */
    public function getDefaultControllerName() {
        return $this->defaultControllerName;
    }

    /**
     * Getter permettant de connaitre le nom du controleur
     * @return type
     */
    public function getControllerName() {
        return $this->controllerName;
    }

    /**
     * Getter permettant de connaitre le nom de l'action
     * @return type
     */
    public function getActionName() {
        return $this->actionName;
    }

    /**
     * Getter permettant de connaitre la position courante de l'utilisateur dans l'application
     * @return type
     */
    public function getCurrentLocation() {
        return array(
            'controller' => $this->getControllerName(),
            'action' => $this->getActionName()
        );
    }

    /**
     * Setter permettant de définir le namespace de l'application pour atteindre la class passée en paramètre
     * @param type $className
     */
    public function setAuthenticationDelegate($className) {
        $class = APPLICATION_NAMESPACE . "\\" . $className;
        Authentication::getInstance(new $class());
    }

}
