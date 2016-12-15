<?php

namespace Sistr;

defined('SISTR') or die('Acces interdit');
?>  
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>SisTR - Accueil</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/reset.css" />
        <link rel="stylesheet" type="text/css" href="css/sistr.css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">        
        <link rel="stylesheet" type="text/css" href="vendors/bootstrap-3.3.7-dist/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
        [%STYLESHEETS%]
        <script type="text/javascript" src="vendors/jquery-3.1.1/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="vendors/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    </head>
    <body>
        <header id="header-accueil">
            <div class="conteneur"><h1>
                    <a href="#">
                        <img src="images/logo-grand.png" alt="logo sistr"/>
                    </a>
                </h1>
                <div id="connexion">
                    <div id="validation-message">
                        [%MESSAGES%]
                    </div>
                    <?php $this->loginForm->render(); ?>
                </div>
            </div> 
        </header>

        <nav id="nav-accueil">
            <div class="conteneur" >
                <ul>
                    <li><a href="#">Accueil</a></li>
                    <li><a href="#">Découvrir</a></li>
                    <li><a href="#">Ressources TR</a></li>
                    <li><a href="#">S'inscrire</a></li>
                </ul>
            </div>  
        </nav>

        [%VIEW%]


        <footer id="pied-de-page">
            <div class="conteneur" >
                <p>SisTR (c) Groupe 3iL 2016-2017</p>
                <div class="col33">                    
                    <h4>Dev. Web</h4>
                    <ul>
                        <li><a href="#">PHP.net</a></li>
                        <li><a href="#">W3Schools</a></li>
                        <li><a href="#">Alsacréation</a></li>
                        <li><a href="#">GrafikArt</a></li>
                    </ul>                    
                </div>
                <div class="col33">                    
                    <h4>Framework / CMS</h4>
                    <ul>
                        <li><a href="#">Symfony</a></li>
                        <li><a href="#">Zend Framework</a></li>
                        <li><a href="#">Wordpress</a></li>
                        <li><a href="#">Drupal</a></li>
                        <li><a href="#">Joomla</a></li>
                    </ul>                    
                </div>
                <div class="col33">                    
                    <h4>Graphisme</h4>
                    <ul>
                        <li><a href="#">Rocket Theme</a></li>
                        <li><a href="#">Shutterstock</a></li>
                        <li><a href="#">Ligature Symbols</a></li>
                        <li><a href="#">Awesome Font</a></li>
                    </ul>                    
                </div>
                <div class="clear"></div>

            </div> 
        </footer>

    </body>
</html>

