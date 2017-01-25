<?php

namespace Sistr;

defined('SISTR') or die("Accès interdit");

?> 

<h2> <?php echo $this->getPageTitle("note"); ?></h2>


<?php
    $this->form->render();
?>
