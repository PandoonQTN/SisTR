<?php

namespace Sistr;

defined('SISTR') or die("Accès interdit");

/**
 * Classe TestForm
 */
class TestForm extends \F3il\Form {

    /**
     * Constructeur par defaut de TestForm
     * @param type $action
     */
    public function __construct($action) {
        parent::__construct($action, 'test-form');
        $this->addFormField(new \F3il\Field('email', 'Email', NULL, TRUE));
        $this->addFormField(new \F3il\Field('age', 'Age'));
    }

    /**
     * Fonction permettant de filtrer l'age
     * @param type $data
     * @return type
     */
    public function ageFilter($data) {
        return filter_var($data, FILTER_SANITIZE_STRING);
    }

    /**
     * Fonction permttant de valider l'age
     * @param type $data
     * @return boolean
     */
    public function ageValidator($data) {
        $nb = filter_var($data, FILTER_SANITIZE_NUMBER_INT);
        if (empty(trim($nb))) {
            $this->addMessage('age', "L'age doit être un nombre entier");
            $this->fMessages('age');
            return FALSE;
        } else {
            if ($nb >= 18 && $nb <= 35) {
                return TRUE;
            } else {
                $this->addMessage('age', "L'age doit être compris entre 18 et 35");
                $this->fMessages('age');
                return FALSE;
            }
        }
        return TRUE;
    }

    /**
     * Render du message
     * @param type $message
     */
    public function messageRenderer($message) {
        ?> 
        <p class="text-danger text-right"><?php echo $message; ?></p>
        <?php
    }

    /**
     * Render des champs manquants
     * @param type $field
     */
    public function missingFieldMessageRenderer($field) {
        ?> 
        <p class="text-danger text-right">Veuillez remplir le champ <?php echo $field->name; ?>.</p>
        <?php
    }

}
