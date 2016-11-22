<?php

namespace F3il;

defined('F3IL') or die("Accès interdit");

abstract class Form {

    protected static $_html;
    protected static $_fields = array();

    public function __construct() {
        $this->getHtmlFile();
    }

    public function render() {
        require self::$_html;
    }

    public function getHtmlFile() {
        $pos = strpos(get_class($this), "\\");
        $ch = substr(get_class($this), $pos);
        $pos = strpos($ch, "F");
        $ch = substr($ch, 1, $pos - strlen($ch));
        if (is_readable(APPLICATION_PATH . "\\forms\\html\\" . strtolower($ch) . ".form-html.php")) {
            self::$_html = APPLICATION_PATH . "\\forms\\html\\" . strtolower($ch) . ".form-html.php";
        } else {
            throw new Error("Erreur avec la variable \$_html");
        }
    }

    public function addFormField(Field $field) {
       /* if (\array_key_exists($field, self::$_fields)) {
            throw new Error("Champs du formulaire déjà existant");
        }*/
        self::$_fields[] = $field;
        var_dump(self::$_fields);
    }
    
    

}
