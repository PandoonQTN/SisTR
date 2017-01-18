<?php

namespace F3il;

defined('F3IL') or die('Acces interdit');

abstract class CsrfHelper {

    const SESSION_KEY = "f3il.csrfToken";

    /**
     * Getter permettant de connaitre le Tocken de la session
     * @return type
     */
    public static function getTocken() {
        if (!isset($_SESSION[self::SESSION_KEY])) {
            $_SESSION[self::SESSION_KEY] = hash('sha256', uniqid());
        }
        return $_SESSION[self::SESSION_KEY];
    }

    /**
     * Fonction permettant de connaitre le status du tocken
     * @return boolean
     */
    public static function checkTocken() {
        if (!isset($_SESSION[self::SESSION_KEY])) {
            return FALSE;
        }
        $filter = filter_input(INPUT_POST, $_SESSION[self::SESSION_KEY], FILTER_VALIDATE_INT);

        if ($filter != 0) {
            return FALSE;
        }
        return TRUE;
    }

    /**
     * Methode permettant de créer un champs caché sur la page avec comme name la valeur du tocken
     */
    public static function csrf() {
        $cle = self::getTocken();
        ?> <input type="hidden" name="<?php echo $cle; ?>" value="<?php echo 0; ?>" > <?php
    }

}
