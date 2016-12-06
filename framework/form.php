<?php

namespace F3il;

defined('F3IL') or die("Accès interdit");

abstract class Form {

    protected $_html;
    protected $_fields = array();
    protected $_action;
    protected $_missingFields = array();
    private $_formId;

    public function __construct($action, $formId) {
        $this->_action = $action;
        $this->_formId = $formId;
        $this->getHtmlFile();
    }

    public function render() {
        require $this->_html;
        $this->insertFormId();
    }

    public function getHtmlFile() {
        $pos = strpos(get_class($this), "\\");
        $ch = substr(get_class($this), $pos);
        $pos = strpos($ch, "F");
        $ch = substr($ch, 1, $pos - strlen($ch));
        if (is_readable(APPLICATION_PATH . "\\forms\\html\\" . strtolower($ch) . ".form-html.php")) {
            $this->_html = APPLICATION_PATH . "\\forms\\html\\" . strtolower($ch) . ".form-html.php";
            if (!strpos(file_get_contents($this->_html), $this->_formId)) {
                throw new Error("Erreur le formId est manquant");
            }
        } else {
            throw new Error("Erreur avec la variable \$_html");
        }
    }

    public function addFormField(Field $field) {

        if (array_key_exists($field->name, $this->_fields)) {
            throw new Error("Champs du formulaire déjà existant");
        }
        $this->_fields[$field->name] = $field;
    }

    public function fLabel($fieldName) {
        if (!array_key_exists($fieldName, $this->_fields)) {
            throw new Error("Champs du formulaire inexistant");
        }
        echo $this->_fields[$fieldName]->label;
    }

    public function fName($fieldName) {
        if (!array_key_exists($fieldName, $this->_fields)) {
            throw new Error("Champs du formulaire inexistant");
        }
        echo $this->_fields[$fieldName]->name;
    }

    public function fValue($fieldName) {
        if (!array_key_exists($fieldName, $this->_fields)) {
            throw new Error("Champs du formulaire inexistant");
        }
        if (!is_null($this->_fields[$fieldName]->value)) {
            echo $this->_fields[$fieldName]->value;
        } else {
            echo $this->_fields[$fieldName]->defaultValue;
        }
    }

    public function getAction() {
        return $this->_action;
    }

    public function loadData($source) {
        $this->_missingFields = array();
        switch (gettype($source)) {
            case 'integer':
                $this->loadDataFromInput($source);
                break;
            case 'array':
                $this->loadDataFromArray($source);
                break;
            default:
                throw new Error("Sources incorrecte");
        }
    }

    /**
     * Chargement des données depuis une sources comme GET ou POST
     * @param type $source
     */
    public function loadDataFromInput($source) {
        foreach ($this->_fields as $field) {
            $field->value = $this->applyFilter($field->name, trim(filter_input($source, $field->name)));
            if (empty(trim($field->value)) && $field->required) {
                $this->_missingFields[] = $field->name;
            } else {
                
            }
        }
    }

    /**
     * Chargement des données depuis une sources comme une Array
     * @param type $source
     * @return type
     */
    public function loadDataFromArray($source) {
        foreach ($this->_fields as $field) {
            if (array_key_exists($field->name, $source)) {
                var_dump(filter_var($source[$field->name]));
                if (!empty(trim($source[$field->name]))) {
                    $field->value = $this->applyFilter($field->name, filter_var($source[$field->name]));
                } else {
                    if ($field->required) {
                        $this->_missingFields[] = $field->name;
                    }
                }
            }
        }
    }

    protected function applyFilter($fieldName, $rawValue) {
        $nom = str_replace('-', '', lcfirst(ucwords($fieldName, '-'))) . 'Filter';

        if (method_exists($this, $nom)) {
            return $this->$nom($rawValue);
        } else {
            return $rawValue;
        }
    }

    public function isValid() {
        $valid = TRUE;
        foreach ($this->_fields as $f) {
            if (in_array($f->name, $this->_missingFields)) {
                $valid = FALSE;
                $this->missingFieldMessageRenderer($f);
            }
            if (!empty(trim($f->name)) || !in_array($f->name, $this->_missingFields)) {
                $nom = str_replace('-', '', lcfirst(ucwords($f->name, '-'))) . 'Validator';
                if (method_exists($this, $nom)) {
                    $valid = $this->$nom($f->value) && $valid;
                }
            }
        }
        return $valid;
    }

    public function addMessage($fieldName, $message) {
        if (!array_key_exists($fieldName, $this->_fields)) {
            throw new Error("Champs du formulaire inexistant");
        }
        $this->_fields[$fieldName]->addMessage($message);
    }

    public function getValidationMessage($fieldName) {
        if (!array_key_exists($fieldName, $this->_fields)) {
            throw new Error("Champs du formulaire inexistant");
        }
        return $this->_fields[$fieldName]->getMessage();
    }

    public function messageRenderer($message) {
        ?> 
        <p><?php echo $message; ?></p>
        <?php
    }

    public function fMessages($fieldName) {
        if (!array_key_exists($fieldName, $this->_fields)) {
            throw new Error("Champs du formulaire inexistant");
        }
        foreach ($this->_fields[$fieldName]->getMessage() as $m) {
            $this->messageRenderer($m);
        }
    }

    public function missingFieldMessageRenderer($field) {
        ?> 
        <p class="text-danger text-right">Le champs <?php echo $field->name; ?> est manquant.</p>
        <?php
    }

    public function getData() {
        $tab = array();
        foreach ($this->_fields as $f) {
            $tab[$f->name] = $f->value;
        }
        return $tab;
    }

    public function insertFormId() {
        ?><input type="hidden" name="<?php echo $this->_formId; ?>" value="1" form="<?php echo $this->_formId ?>"><?php
    }

    public function isSubmitted() {
        $serv = filter_input(INPUT_SERVER, 'REQUEST_METHOD');
        $post = filter_input(INPUT_POST, $this->_formId);
        if ($serv == 'POST' && $post == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function __get($fieldName) {
        if (!array_key_exists($fieldName, $this->_fields)) {
            throw new Error("Champs du formulaire inexistant");
        }
        return $this->_fields[$fieldName];
    }
    public function __set($fieldName, $value) {
        $this->data[$fieldName] = $value;
    }

    public function __isset($fieldName) {
        return isset($this->_fields[$fieldName]);
    }
    
    
    public function getField($fieldName) {
        if (!array_key_exists($fieldName, $this->_fields)) {
            throw new Error("Champs du formulaire inexistant");
        }
        return $this->_fields[$fieldName];
    }
}
