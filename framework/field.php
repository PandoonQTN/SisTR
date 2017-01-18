<?php

namespace F3il;

defined('F3IL') or die("Accès interdit");

class Field {

    public $name;
    public $label;
    public $required;
    public $value;
    public $defaultValue;
    protected $message = array();

    /**
     * Constructeur par défaut de la class Field
     * @param type $name
     * @param type $label
     * @param type $defaultValue
     * @param type $required
     */
    public function __construct($name, $label, $defaultValue = null, $required = false) {
        $this->name = $name;
        $this->label = $label;
        $this->defaultValue = $defaultValue;
        $this->required = $required;
    }

    /**
     * Fonction permettant d'ajouter un message
     * @param type $message
     */
    public function addMessage($message) {
        $this->message[] = $message;
    }

    /**
     * Getter permettant de récupérer un tableau de message
     * @return array()
     */
    public function getMessage() {
        return $this->message;
    }

}
