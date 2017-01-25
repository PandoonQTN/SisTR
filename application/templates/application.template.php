<?php

namespace Sistr;

defined('SISTR') or die('Acces interdit');
\F3il\Messages::setMessageRenderer('\Sistr\MessagesHelper::messagesRenderer');

$auth = \F3il\Authentication::getInstance();
$user = $auth->getLoggedUser();
?>  

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        [%TITLE%]
        <title>Maquette application</title>
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
        <header>
            <nav class="navbar navbar-inverse navbar-static-top" role="navigation">
                <div class="container">
                    <div class="navbar-header">
                        <a class="navbar-brand"  href="#"><img src="images/logo-blanc.png" alt="logo" id="logo"/> <br/></a>
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse">            
                        <?php NavigationHelper::render(); ?>

                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="drop3" role="button" aria-haspopup="true" >
                                    <?php echo $user['prenom'] . " " . strtoupper($user['nom']); ?> 
                                    <span class="caret"></span> </a>
                                <ul class="dropdown-menu" aria-labelledby="drop3"> 
                                    <li><a href="?controller=utilisateur&action=deconnecter">Deconnexion</a></li> 
                            </li>
                        </ul>   

                    </div>

                </div>
            </nav>            
        </header> 
        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xs-push-1 col-sm-push-1 col-md-push-1 col-lg-push-1">

            [%VIEW%]

        </div>

    </body>

</html>