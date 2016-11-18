<?php

namespace F3il;

defined("F3IL") or die("Accès interdit");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of message
 *
 * @author Quentin
 */
class Messages {

    const MESSAGE_SUCCESS = 0;
    const MESSAGE_WARNING = 1;
    const MESSAGE_ERROR = 2;

    private static $_messages = array();
    private static $_renderer = '\F3il\Messages::defaultRenderer';

    /**
     * Ajoute un message dans la liste
     * @param type $message
     * @param type $type
     * @throws Error
     */
    public static function addMessage($message, $type) {
        if ($type != self::MESSAGE_ERROR && $type != self::MESSAGE_WARNING && $type != self::MESSAGE_SUCCESS) {
            throw new Error("Mauvais type");
        }
        self::$_messages[] = array("message" => $message, "type" => $type);
    }

    /**
     * Retourne le nombre de message 
     * @return type
     */
    public static function getMessageCount() {
        return count(self::$_messages);
    }

    /**
     * Récupère un message à l'index dans le tableau
     * @param type $num
     * @return type
     * @throws Error
     */
    public static function getMessage($num = 0) {
        if (!isset(self::$_messages[$num])) {
            throw new Error("Index hors tableau");
        }
        return self::$_messages[$num];
    }

    /**
     * Setter de renderer
     * @param type $renderer
     */
    public static function setMessageRenderer($renderer) {
        self::$_renderer = $renderer;
    }

    /**
     * Appel la méthode du renderer
     * @return type
     */
    public static function render() {
        ob_start();
        call_user_func(self::$_renderer);
        return ob_get_clean();
    }

    /**
     * Permet de voir si tout ce passe bien 
     */
    public static function defaultRenderer() {
        foreach (self::$_messages as $m) :
            ?>
            <div><?php
                $res = "";
                if ($m['type'] == self::MESSAGE_SUCCESS) {
                    $res = "Succès : ";
                } else if ($m['type'] == self::MESSAGE_WARNING) {
                    $res = "Attention : ";
                } else if ($m['type'] == self::MESSAGE_ERROR) {
                    $res = "Erreur : ";
                }

                echo $res.$m["message"];
                ?></div>
            <?php
        endforeach;
    }

}
