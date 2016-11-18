<?php  namespace Sistr;
    defined('SISTR') or die('Acces interdit');
?>
<!DOCTYPE>
<html>
    <head>
        [%STYLESHEETS%][%TITLE%]
        <meta charset="UTF-8">        
    </head>
    <body>        
        <h1>Template Simple</h1>
        <p><?php echo __FILE__;?></p>
        <!-- Afffichage de la vue -->
        <?php $this->insertView(); ?>        
    </body>
</html>
