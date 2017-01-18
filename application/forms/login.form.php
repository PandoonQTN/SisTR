<?php

namespace Sistr;

defined('SISTR') or die("Accès interdit");

use F3il\Form;

/**
 * Class LoginForm
 */
class LoginForm extends Form {

    /**
     * Constructeur de la classe 
     * @param type $action
     */
    public function __construct($action) {
        parent::__construct($action, 'login-form');
        $this->addFormField(new \F3il\Field('login', 'Login', NULL, TRUE));
        $this->addFormField(new \F3il\Field('motdepasse', 'Mot de Passe', NULL, TRUE));
    }

}
