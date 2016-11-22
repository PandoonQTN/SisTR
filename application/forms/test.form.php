<?php

namespace Sistr;

defined('SISTR') or die("Accès interdit");

class TestForm extends \F3il\Form {

    public function __construct() {
        parent::__construct();
        parent::addFormField(new \F3il\Field('email','Email',NULL,TRUE));
        parent::addFormField(new \F3il\Field('age','Age'));
        
    }

}
