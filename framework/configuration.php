<?php

namespace F3il;

defined('F3IL') or die("Accès interdit");

class Configuration {

    private static $_instance;
    protected $data;

    /**
     * Constructeur
     * 
     * @param string $iniFile : chemin du fichier INI de configuration
     */
    private function __construct($inifile) {
        if (!is_readable($inifile)) {
            throw new Error("Le fichier n'est pas lisible");
        }
        $this->data = parse_ini_file($inifile);

        if (!$this->data) {
            throw new Error('Fichier non lisible');
        }
    }

    /**
     * Méthode de récupération de l'instance         *
     * 
     * @param string $iniFile : chemin du fichier INI de configuration
     * @return Configuration
     */
    public static function getInstance($inifile = "") {
        if (is_null(self::$_instance)) {
            self::$_instance = new Configuration($inifile);
        }
        return self::$_instance;
    }

    /**
     * Fonction permettan de savoir si l'instance n'est pas null
     */
    public static function isLoaded() {
        return !is_null(self::$_instance);
    }

    /**
     * Getter pour les propriétés dynamiques de la configuration.
     * 
     * @param string $name : nom de la propriété dynamique
     * @return mixed
     */
    public function __get($name) {
        if (!isset($this->data[$name])) {
            throw  new Error("Propriété " . $name . " non trouvé");
        }
        return $this->data[$name];
    }

}
