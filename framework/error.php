<?php

namespace F3il;

defined("F3IL") or die("Accès interdit");



/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of error
 *
 * @author Quentin
 */
class Error extends \Exception {

    const DEBUG = "debug";
    const PRODUCTION = "production";

    protected $explanation;
    protected $runMode;

    public function __construct($message) {
        parent::__construct($message);
        if (Configuration::isLoaded()) {
            $data = Configuration::getInstance();
            echo ($data->run_mode);
            if (strcmp($data->run_mode, self::DEBUG) != 0) {
                $this->runMode = self::PRODUCTION;
            } else {
                $this->runMode = self::DEBUG;
            }
        } else {
            $this->runMode = self::PRODUCTION;
        }
    }

    /**
     * Render destiné à la production
     * @return string
     */
    private function productionRender() {
        return "<h1>Oups</h1>";
    }

    /**
     * Render destiné au débugage
     */
    public function debugRender() {
        $trace = $this->getTrace();
        ?>
        <!DOCTYPE html>
        <html>
            <head>
                <title>Erreur dans l'application</title>
                <meta charset='utf-8'>
            </head>
            <body>
                <h1>Erreur</h1>
                <p><?php echo $this->message; ?></p>
                <?php if ($this->explanation): ?>
                    <p>Explications : <?php echo $this->explanation; ?></p>
                <?php endif; ?>
                <p>Fichier : <?php echo $this->file; ?></p>
                <p>Ligne : <?php echo $this->line; ?></p>
                <p>Fonction : <?php echo $trace[0]['class'] . '::' . $trace[0]['function']; ?></p>
                <pre><?php echo $this->getTraceAsString(); ?></pre>          
            </body>
        </html>        <?php
    }

    /**
     * Fonction toString qui va afficher le bon render en fonction de la configuration
     * @return type
     */
    public function __toString() {
        ob_end_clean();
        if ($this->runMode == self::DEBUG) {
            return $this->debugRender() . "";
        } elseif ($this->runMode == self::PRODUCTION) {
            return $this->productionRender() . "";
        }
    }

}

$er = new Error("mes");
