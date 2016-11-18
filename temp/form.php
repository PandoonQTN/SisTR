<?php 
    defined('SECURITE') or die("Accès interdit");
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>form.php</title>
    </head>
    <body>
        <h1>Formulaire HTML</h1>
           
        <form action="test.php" method="GET">
            <input type="text" placeholder="Votre message" name="message"/>
            <input type="hidden" name="interne" value="formulaire"/>
            <button type="submit">Envoyer</button>
            
            
        </form>
        <?php
         
        ?>
    </body>
</html>
