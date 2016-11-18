<?php

namespace F3il;

defined('F3IL') or die("Accès interdit");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of page
 *
 * @author Quentin
 */
class Page {

    private static $_instance;
    protected $templateFile;
    protected $templateHTML;
    protected $viewFile;
    protected $data;
    protected $pageTitle;
    protected $viewHTML;
    protected $cssFiles = array();

    /**
     * Constructeur 
     * 
     */
    private function __construct() {
        
    }

    /**
     * Méthode de récupération de l'instance de Page
     * 
     * @return Page
     */
    public static function getInstance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new Page();
        }
        return self::$_instance;
    }

    /**
     * Précise le template à utiliser
     * 
     * @param string $templateName : racine du nom du template à utiliser
     * @return $this
     */
    public function setTemplate($templateName) {
        $chemain = APPLICATION_PATH . "\\templates\\" . $templateName . ".template.php";
        if (is_readable($chemain)) {
            $this->templateFile = $chemain;
        } else {
            throw new Error("Erreur de template");
        }
        return $this;
    }

    /**
     * Précise la vue à utiliser
     * 
     * @param string $viewName : racine du nom de la vue à utiliser
     * @return $this
     */
    public function setView($viewName) {
        $chemin = APPLICATION_PATH . "\\views\\" . $viewName . ".view.php";
        if (is_readable($chemin)) {
            $this->viewFile = $chemin;
        } else {
            throw new Error("Erreur de views");
        }
        return $this;
    }

    /**
     * Permet d'insérer la vue dans le template
     */
    private function insertView() {
        /* if (!isset($this->viewFile)) {
          die("vue non renseignée");
          }
          require $this->viewFile; */

        return $this->viewHTML;
    }

    /**
     * Effectue le rendu du template et de la vue
     * 
     */
    public function render() {
        if (!isset($this->templateFile) && !isset($this->viewFile)) {
            die("template et vue non renseignés");
        }
        ob_start();
        require $this->viewFile;
        $this->viewHTML = ob_get_clean();        
         $this->viewHTML = preg_replace_callback('/\[%\w+\%]/is', array($this, 'renderCallback'), $this->viewHTML);
        ob_start();
        require $this->templateFile;
        $this->templateHTML = ob_get_clean();
        echo preg_replace_callback('/\[%\w+\%]/is', array($this, 'renderCallback'), $this->templateHTML);
    }

    /**
     * Getter pour les propriétés dynamiques de Page
     * 
     * @param string $name : nom de la propriété dynamique
     * @return mixed
     */
    public function __get($name) {
        if (!isset($this->data[$name])) {
            throw new Error("Propriété " . $name . " non trouvé");
        }
        return $this->data[$name];
    }

    /**
     * Setter pour les propriétés dynamiques de Page
     * 
     * @param string $name : nom de la propriété dynamique
     * @param mixed $value : valeur de la propriété dynamique
     */
    public function __set($name, $value) {
        $this->data[$name] = $value;
    }

    /**
     * Méthode permettant d'appeler la fonction isset() sur les prorpriétés dynamiques
     * 
     * @param string $name : nom de la propriété dynamique
     * @return boolean
     */
    public function __isset($name) {
        return isset($this->data[$name]);
    }

    /**
     * Setter de Titre 
     */
    public function setPageTitle($titre) {
        $this->pageTitle = $titre;
    }

    /**
     * Getter de titre
     */
    public function getPageTitle() {
        return $this->pageTitle;
    }

    /**
     * Ajoute dans un tableau les liens des fichiers CSS
     * @param type $cssFile : nom du fichier 
     * @return type : le tableau de liens 
     * @throws Error : si le fichier n'existe pas ou n'est pas accessible. 
     */
    public function addStyleSheet($cssFile) {
        $chemin = APPLICATION_NAMESPACE . "\\..\\css\\" . $cssFile . ".css";
        var_dump($chemin);
        if (is_readable($chemin)) {
            foreach ($this->cssFiles as $css) {
                if (strcmp($css, $chemin) == 1) {
                    return;
                }
            }
            $this->cssFiles[] = "css\\" . $cssFile . ".css";
        } else {
            throw new Error("Fichier css manquant");
        }
    }

    /**
     * Fonction permettant de créer une chaine de caractère qui va permettre d'inserer les fichiers css
     * @return string : chaine conenant les liens css
     */
    public function insertStyleSheets() {
        ob_start();
        foreach ($this->cssFiles as $css) :
            ?>
            <link rel="stylesheet" type="text/css" href="<?php echo $css; ?>" />
            <?php
        endforeach;
        return ob_get_clean();
    }

    /**
     * Permet d'afficher les vues et d'ajouter les css
     * @param type $matches
     * @return string
     */
    public function renderCallback($matches) {
        switch ($matches[0]) {
            case '[%VIEW%]':
                return $this->viewHTML;
            case '[%STYLESHEETS%]':
                return $this->insertStyleSheets();
            case '[%TITLE%]':
                return $this->insertPageTitle();
            case '[%MESSAGES%]':
                return Messages::render();
            default:
                return '';
        }
    }

    public function insertPageTitle() {
        ob_start();
        ?>
        <title><?php echo $this->getPageTitle();?></title>
        <?php
        return ob_get_clean();
    }

}
