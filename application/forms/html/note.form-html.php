<?php

namespace Sistr;

defined('SISTR') or die('Acces interdit');
?>
<form id="note-form" method="POST" action="<?php echo $this->getAction(); ?>" class="col-lg-10 form-horizontal">

    <?php
    FormHelper::input($this, 'titre', 'text');
    FormHelper::input($this, 'text', 'text');
    \F3il\CsrfHelper::csrf();
    ?>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Envoyer</button>
        </div>
    </div>
</form>
