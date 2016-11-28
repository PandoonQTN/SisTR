<?php

namespace Sistr;

defined('SISTR') or die("Accès interdit");

class TestForm extends \F3il\Form {

    public function __construct($action) {
        parent::__construct($action);
        $this->addFormField(new \F3il\Field('email','Email',NULL,TRUE));
        $this->addFormField(new \F3il\Field('age','Age'));        
    }
    
    public function ageFilter($data) {
        return filter_var($data,FILTER_SANITIZE_STRING);
    }

}
