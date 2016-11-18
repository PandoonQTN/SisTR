<?php

namespace Sistr;

defined('SISTR') or die("Accès interdit");
$this->setPageTitle("vue 1");
\F3il\Messages::setMessageRenderer('\Sistr\MessagesHelper::messagesRenderer');
?>

<div> 
    <h2>Vue 1</h2>
    <p><?php echo __FILE__;
?>
        <br>
        <?php echo $this->titre; ?>
        <br>
        <?php var_dump($this->utilisateurs); ?>
        <br>

    </p>

</div>

