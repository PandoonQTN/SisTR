<?php

namespace Sistr;

defined('SISTR') or die("Accès interdit");

use F3il\Field;
use F3il\Form;

class UtilisateurForm extends Form {

    public function __construct($action) {
        parent::__construct($action, 'utilisateur-form');

        $this->addFormField(new \F3il\Field('id', 'ID', NULL, TRUE));
        $this->addFormField(new \F3il\Field('nom', 'Nom', NULL, TRUE));
        $this->addFormField(new \F3il\Field('prenom', 'Prénom', NULL, TRUE));
        $this->addFormField(new \F3il\Field('email', 'Email', NULL, TRUE));
        $this->addFormField(new \F3il\Field('login', 'Login', NULL, TRUE));
        $this->addFormField(new \F3il\Field('motdepasse', 'Mot de Passe', NULL, TRUE));
        $this->addFormField(new \F3il\Field('confirmation', 'Confirmation', NULL, TRUE));
    }

    public function nomFilter($data) {
        return filter_var($data, FILTER_SANITIZE_STRING);
    }

    public function prenomFilter($data) {
        return filter_var($data, FILTER_SANITIZE_STRING);
    }

    public function emailFilter($data) {
        return filter_var($data, FILTER_SANITIZE_STRING);
    }

    public function loginFilter($data) {
        return filter_var($data, FILTER_SANITIZE_STRING);
    }

    public function motdepasseFilter($data) {
        return filter_var($data, FILTER_SANITIZE_STRING);
    }

    public function confirmationFilter($data) {
        return filter_var($data, FILTER_SANITIZE_STRING);
    }

    public function emailValidator($data) {
        $nb = filter_var($data, FILTER_VALIDATE_EMAIL);
        if (empty(trim($nb))) {
            $this->addMessage('email', "L'email n'est pas valide");
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function loginValidator($data) {
        $model = new UtilisateursModel();
        $nb = filter_var($data, FILTER_SANITIZE_STRING);        
        $nb2 = $this->getField('id')->value;
        if ($model->loginExistant($nb,$nb2)) {
            $this->addMessage('login', "Ce login existe déjà");
            return FALSE;
        } else {
            if (strlen($nb) < 6) {
                $this->addMessage('login', "le login doit faire au moins 6 caractères");
                return FALSE;
            }
            if (strstr($nb, " ")) {
                $this->addMessage('login', "le login ne doit pas contenir d'espaces");
                return FALSE;
            }
        }
        return TRUE;
    }

    public function motdepasseValidator($data) {
        $nb = filter_var($data, FILTER_SANITIZE_STRING);
        if (strlen($nb) <= 4) {
            $this->addMessage('motdepasse', "le mot de passe doit faire au moins 4 caractères");
            return FALSE;
        }
        return TRUE;
    }

    public function confirmationValidator($data) {
        $nb = filter_var($data, FILTER_SANITIZE_STRING);
        $nb2 = $this->getField('motdepasse');
        if ($nb === $nb2->value) {
            return TRUE;
        } else {
            $this->addMessage('confirmation', "les deux mots de passe ne sont pas identique");
            return FALSE;
        }
    }

    public function isValid() {
        $valid = parent::isValid();
        if($this->id == 0) return $valid;
        if($this->motdepasse != '' && $this->confirmation == ''){
            $valid = $this->confirmationValidator($this->confirmation) && $valid;
        }
        return $valid;
    }
}