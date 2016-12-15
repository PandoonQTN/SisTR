<?php

namespace F3il;

defined('F3IL') or die('Acces interdit');

class Authentication {

    private static $_instance;
    protected $loginKey;
    protected $passwordKey;
    protected $idKey;

    /**
     * Modèle servant de délégué pour l'authentification
     * @var AuthenticationModel 
     */
    protected $authenticationModel = null;
    protected $user;

    const SESSION_KEY = 'f3il.authentication';

    /**
     * Constructeur privé 
     * 
     * @param \F3il\AuthenticationInterface $model
     */
    private function __construct(AuthenticationInterface $model) {
        $this->authenticationModel = $model;
        $this->loginKey = $this->authenticationModel->auth_getLoginKey();
        $this->passwordKey = $this->authenticationModel->auth_getPasswordKey();
        $this->idKey = $this->authenticationModel->auth_getUserIdKey();
    }

    /**
     * Récupérateur d'instance 
     * 
     * @param \F3il\AuthenticationInterface $model
     * @return Authentication
     * @throws Error
     */
    public static function getInstance(AuthenticationInterface $model = null) {
        if (is_null(self::$_instance)) {
            if (is_null($model)) {
                throw new Error("Le model est null");
            }
            self::$_instance = new Authentication($model);
        }
        return self::$_instance;
    }

    /**
     * Vérifie si des données comportent les clés nécessaires à l'authentification
     * @param array $data
     * @return boolean
     */
    public function checkAuthenticationKeys(array $data) {
        if (!is_array($data)) {
            return FALSE;
        }
        if (!$data[$this->idKey]) {
            return FALSE;
        }
        if (!$data[$this->loginKey]) {
            return FALSE;
        }
        if (!$data[$this->passwordKey]) {
            return FALSE;
        }
        return TRUE;
    }

    /**
     * Méthode appelée quand un utilisateur tente de se connecter
     * 
     * @param string $login
     * @param string $password
     * @return boolean
     * @throws Error
     */
    public function login($login, $password) {
        $this->user = $this->authenticationModel->auth_getUserByLogin($login);
        if (!$this->user) {
            return FALSE;
        }
        if (!$this->checkAuthenticationKeys($this->user)) {
            //throw new Error('Modèle authentification');
        }
        if ($this->user[$this->passwordKey] != $password) {
            return FALSE;
        }
        return TRUE;
    }
    
    

}
