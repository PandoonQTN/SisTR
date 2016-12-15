<?php

namespace Sistr;

defined('SISTR') or die("Accès interdit");

use F3il\Form;

class LoginForm extends Form {
    
        public function __construct($action) {
        parent::__construct($action, 'login-form');
        $this->addFormField(new \F3il\Field('login', 'Login', NULL, TRUE));
        $this->addFormField(new \F3il\Field('motdepasse', 'Mot de Passe', NULL, TRUE));
    }
}
