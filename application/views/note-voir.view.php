<?php
defined('SISTR') or die("Accès interdit");
?>

<h2>Détail de la note : <small>
        <?php echo $this->note['titre']; ?>
    </small>
</h2>

<div id="datagrid-commands">
    <a href="?controller=note&action=lister">
        <button class="btn btn-primary"><</button>
    </a>
    <div class="col-lg-12"></div>
</div>

<p>Titre : <?php echo $this->note['titre']; ?> </p>
<p>Texte :   <?php echo $this->note['text']; ?></p>
<p>Date/Heure :   <?php echo $this->note['horodate']; ?> </p>
