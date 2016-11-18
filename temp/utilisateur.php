<?php 
    defined('SECURITE') or die("Accès interdit");

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of utilisateur
 *
 * @author Quentin
 */
class Utilisateur {
    protected $nom; 
    protected $prenom;
    
    public function __construct($nom, $prenom) {
        $this->nom = $nom;
        $this->prenom = $prenom;
    }
    
    public function direBonjour(){
        echo "Bonjour ".$this->nom." ".$this->prenom;
    }
}
