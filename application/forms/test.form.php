<?php

namespace Sistr;

defined('SISTR') or die("Accès interdit");

class TestForm extends \F3il\Form {

    public function __construct($action) {
        parent::__construct($action);
        $this->addFormField(new \F3il\Field('email', 'Email', NULL, TRUE));
        $this->addFormField(new \F3il\Field('age', 'Age'));
    }

    public function ageFilter($data) {
        return filter_var($data, FILTER_SANITIZE_STRING);
    }

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
                $this->addMessage('age', "L'age doit être compris entre 18 et 35");$this->fMessages('age');
                return FALSE;
            }
        }
        
        return TRUE;
    }

    public function messageRenderer($message) {
        ?> 
        <p class="text-danger text-right"><?php echo $message; ?></p>
        <?php
    }

}
