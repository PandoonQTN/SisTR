<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of classe
 *
 * @author Quentin
 */
class AppelDynamique {

    public function maSuperMethode() {
        echo __METHOD__;
    }

}

$nomClasse = 'AppelDynamique';
$nomMethode = 'maSuperMethode';

$objet = new $nomClasse();
$objet->$nomMethode();