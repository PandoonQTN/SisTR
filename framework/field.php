<?php

namespace F3il;

defined('F3IL') or die("Accès interdit");

class Field {

    public $name;
    public $label;
    public $required;
    public $value;
    public $defaultValue;

    public function __construct($name, $label, $defaultValue = null, $required = false) {
        $this->name = $name;
        $this->label = $label;
        $this->defaultValue = $defaultValue;
        $this->required = $required;
    }

}
