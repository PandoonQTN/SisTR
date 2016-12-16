<?php

namespace Sistr;

defined('SISTR') or die('Acces interdit');
?>
<form id="utilisateur-form" method="POST" action="<?php echo $this->getAction(); ?>" class="col-lg-10 form-horizontal">

    <?php
    FormHelper::input($this, 'id', 'text');
    FormHelper::input($this, 'nom', 'text');
    FormHelper::input($this, 'prenom', 'text');
    FormHelper::input($this, 'email', 'text');
    FormHelper::input($this, 'login', 'text');
    FormHelper::input($this, 'motdepasse', 'password');
    FormHelper::input($this, 'confirmation', 'password');
    \F3il\CsrfHelper::csrf();
    ?>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Envoyer</button>
        </div>
    </div>
</form>
