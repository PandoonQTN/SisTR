<?php

namespace F3il;

defined("F3IL") or die("Accès interdit");

abstract class Messenger {

    const SESSION_KEY = 'f3Il.messenger';

    /**
     * permet de définir le message dans la variable de session 
     * @param type $message
     */
    public static function setMessage($message) {
        $_SESSION[self::SESSION_KEY] = $message;
    }

    /**
     * permet de connaitre le message, il est supprimé ensuite 
     * @return boolean
     */
    public static function getMessage() {
        if (!isset($_SESSION[self::SESSION_KEY])) {
            return false;
        }
        $message = $_SESSION[self::SESSION_KEY];
        unset($_SESSION[self::SESSION_KEY]);
        return $message;
    }

}
