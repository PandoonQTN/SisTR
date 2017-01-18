<?php

namespace Sistr;

defined('SISTR') or die("Accès interdit");

use F3il\Field;
use F3il\Form;

/**
 * Classe UtilisateurForm
 */
class UtilisateurForm extends Form {

    /**
     * Constructeur par defaut de la classe
     * @param type $action
     */
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

    /**
     * Fonction permettant de filtrer le nom
     * @param type $data
     * @return type
     */
    public function nomFilter($data) {
        return filter_var($data, FILTER_SANITIZE_STRING);
    }

    /**
     * Fonction permettant de filtrer le prenom
     * @param type $data
     * @return type
     */
    public function prenomFilter($data) {
        return filter_var($data, FILTER_SANITIZE_STRING);
    }

    /**
     * Fonction permettant de filtrer l'email
     * @param type $data
     * @return type
     */
    public function emailFilter($data) {
        return filter_var($data, FILTER_SANITIZE_STRING);
    }

    /**
     * Fonction permettant de filtrer le login
     * @param type $data
     * @return type
     */
    public function loginFilter($data) {
        return filter_var($data, FILTER_SANITIZE_STRING);
    }

    /**
     * Fonction permettant de filtrer le mot de passe
     * @param type $data
     * @return type
     */
    public function motdepasseFilter($data) {
        return filter_var($data, FILTER_SANITIZE_STRING);
    }

    /**
     * Fonction permettant de filtrer la confirmation du mot de passe
     * @param type $data
     * @return type
     */
    public function confirmationFilter($data) {
        return filter_var($data, FILTER_SANITIZE_STRING);
    }

    /**
     * Validateur de l'email
     * @param type $data
     * @return boolean
     */
    public function emailValidator($data) {
        $nb = filter_var($data, FILTER_VALIDATE_EMAIL);
        if (empty(trim($nb))) {
            $this->addMessage('email', "L'email n'est pas valide");
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * Validateur du login
     * @param type $data
     * @return boolean
     */
    public function loginValidator($data) {
        $model = new UtilisateursModel();
        $nb = filter_var($data, FILTER_SANITIZE_STRING);
        $nb2 = $this->getField('id')->value;
        if ($model->loginExistant($nb, $nb2)) {
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

    /**
     * Validateur du mot de passe
     * @param type $data
     * @return boolean
     */
    public function motdepasseValidator($data) {
        $nb = filter_var($data, FILTER_SANITIZE_STRING);
        if (strlen($nb) <= 4) {
            $this->addMessage('motdepasse', "le mot de passe doit faire au moins 4 caractères");

            return FALSE;
        }
        return TRUE;
    }

    /**
     * Validateur de la confirmation du mot de passe
     * @param type $data
     * @return boolean
     */
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

    /**
     * Fonction permettant de savoir si le formulaire est valide
     * @return type
     */
    public function isValid() {
        $valid = parent::isValid();
        if ($this->id == 0)
            return $valid;

        if ($this->motdepasse != '' && $this->confirmation == '') {

            $valid = $this->confirmationValidator($this->confirmation) && $valid;
        }
        return $valid;
    }

}
