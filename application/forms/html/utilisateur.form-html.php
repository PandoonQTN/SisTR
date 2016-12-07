<?php

namespace Sistr;

defined('SISTR') or die('Acces interdit');
?>
<form id="utilisateur-form" method="POST" action="<?php echo $this->getAction(); ?>" class="form-horizontal">

    <?php FormHelper::input($this, 'id', 'text') ?>
    <?php FormHelper::input($this, 'nom', 'text') ?>
    <?php FormHelper::input($this, 'prenom', 'text') ?>
    <?php FormHelper::input($this, 'email', 'text') ?>
    <?php FormHelper::input($this, 'login', 'text') ?>
    <?php FormHelper::input($this, 'motdepasse', 'password') ?>
    <?php FormHelper::input($this, 'confirmation', 'password') ?>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Envoyer</button>
        </div>
    </div>
</form>
