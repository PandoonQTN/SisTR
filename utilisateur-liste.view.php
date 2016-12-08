<?php

namespace Sistr;

defined('SISTR') or die("Accès interdit");
?>

<h2>Liste des utilisateurs</h2>

<div id="datagrid-commands">
    <a href="?controller=utilisateur&action=creer">
        <button class="btn btn-primary">Nouvel utilisateur</button>
    </a>
    <div class="col-lg-12"></div>
</div>

<table class="table table-bordered table-condensed table-hover table-striped">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Login</th>
            <th>Création</th>
            <th>Connexion</th>
            <th>ID</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($this->utilisateurs as $u) :
            ?>
            <tr>
                <td><?php echo $u['nom']; ?></td>
                <td><?php echo $u['prenom']; ?></td>
                <td><?php echo $u['email']; ?></td>
                <td><?php echo $u['login']; ?></td>
                <td><?php echo $u['creation']; ?></td>
                <td><?php echo $u['connexion']; ?></td>
                <td><?php echo $u['id']; ?></td>
                <td>
                    <button name="id" value="<?php echo $u['id']; ?>" form="edit-form" class="btn btn-default btn-xs" title="Editer">
                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                    </button>
                    <button name="id" value="<?php echo $u['id']; ?>" form="delete-form" class="btn btn-default btn-xs" title="Supprimer">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </td>
            </tr>

            <?php
        endforeach;
        ?>
    </tbody>

</table>

<form id="delete-form" action="?controller=utilisateur&action=supprimer" method="POST"></form>
<form id="edit-form" action="?controller=utilisateur&action=editer" method="POST"></form>
<?php 
