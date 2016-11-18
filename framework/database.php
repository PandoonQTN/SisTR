<?php

namespace F3il;
use \PDO;
defined('F3IL') or die("Accès interdit");

class Database {

    private static $_instance;

    public static function getInstance() {
        if (!Configuration::isLoaded()) {
            throw new Error("Pas de configuration");
        } else {
            $conf = Configuration::getInstance();
            
            if (is_null(self::$_instance)) {                
                try {
                    self::$_instance = new \PDO('mysql:host=' . $conf->mysql_host . ';dbname=' . $conf->mysql_dbname, $conf->mysql_login, $conf->mysql_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
                    self::$_instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                } catch (PDOException $ex) {
                    throw new Error("Erreur de BD");
                }
            }
            return self::$_instance;
        }
    }

}
