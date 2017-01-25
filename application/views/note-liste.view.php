<?php

namespace Sistr;

defined('SISTR') or die("Accès interdit");
?>

<h2>Liste des Notes</h2>

<div id="datagrid-commands">
    <a href="?controller=note&action=creer">
        <button class="btn btn-primary">Nouvelle note</button>
    </a>
    <div class="col-lg-12"></div>
</div>

<table class="table table-bordered table-condensed table-hover table-striped">
    <thead>
        <tr>
            <th>Titre</th>
            <th>Text</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($this->notes as $u) :
            ?>
            <tr>
                <td><?php echo $u['titre']; ?></td>
                <td><?php echo $u['text']; ?></td>
                <td>
                    <button name="id" value="<?php echo $u['id']; ?>" form="voir-form" class="btn btn-default btn-xs" title="Voir">
                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                    </button>

                </td>
            </tr>

            <?php
        endforeach;
        ?>
    </tbody>

</table>

<form id="voir-form" action="?controller=note&action=voir" method="POST"></form>
<?php 
