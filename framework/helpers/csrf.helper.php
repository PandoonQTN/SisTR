<?php

namespace F3il;

defined('F3IL') or die('Acces interdit');

abstract class CsrfHelper {

    const SESSION_KEY = "f3il.csrfToken";

    public static function getTocken() {
        if (!isset($_SESSION[self::SESSION_KEY])) {
            $_SESSION[self::SESSION_KEY] = hash('sha256', uniqid());
        }
        return $_SESSION[self::SESSION_KEY];
    }

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

    public static function csrf() {
        $cle = self::getTocken();
        ?> <input type="hidden" name="<?php echo $cle; ?>" value="<?php echo 0; ?>" > <?php
    }

}
