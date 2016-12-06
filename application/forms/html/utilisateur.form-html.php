<?php

namespace Sistr;

defined('SISTR') or die('Acces interdit');
?>
<form id="utilisateur-form" method="POST" action="<?php echo $this->getAction(); ?>" class="form-horizontal">
    <div class="form-group">
        <label for="<?php echo $this->fName('id'); ?>" class="col-sm-2 control-label">
            <?php echo $this->fLabel('id'); ?> :
        </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="<?php echo $this->fName('id'); ?>" name="<?php echo $this->fName('id'); ?>" placeholder="<?php echo $this->fLabel('id'); ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="<?php echo $this->fName('nom'); ?>" class="col-sm-2 control-label"><?php echo $this->fLabel('nom'); ?> : </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="<?php echo $this->fName('nom'); ?>" name="<?php echo $this->fName('nom'); ?>" placeholder="<?php echo $this->fLabel('nom'); ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="<?php echo $this->fName('prenom'); ?>" class="col-sm-2 control-label">
            <?php echo $this->fLabel('prenom'); ?> :
        </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="<?php echo $this->fName('prenom'); ?>" name="<?php echo $this->fName('prenom'); ?>" placeholder="<?php echo $this->fLabel('prenom'); ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="<?php echo $this->fName('email'); ?>" class="col-sm-2 control-label">
            <?php echo $this->fLabel('email'); ?> :
        </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="<?php echo $this->fName('email'); ?>" name="<?php echo $this->fName('email'); ?>" placeholder="<?php echo $this->fLabel('email'); ?>">
        </div>
    </div>  
    <div class="form-group">
        <label for="<?php echo $this->fName('login'); ?>" class="col-sm-2 control-label"><?php echo $this->fLabel('login'); ?> : </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="<?php echo $this->fName('login'); ?>" name="<?php echo $this->fName('login'); ?>" placeholder="<?php echo $this->fLabel('login'); ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="<?php echo $this->fName('motdepasse'); ?>" class="col-sm-2 control-label"><?php echo $this->fLabel('motdepasse'); ?> : </label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="<?php echo $this->fName('motdepasse'); ?>" name="<?php echo $this->fName('motdepasse'); ?>" placeholder="<?php echo $this->fLabel('motdepasse'); ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="<?php echo $this->fName('confirmation'); ?>" class="col-sm-2 control-label">
            <?php echo $this->fLabel('confirmation'); ?> :
        </label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="<?php echo $this->fName('confirmation'); ?>" name="<?php echo $this->fName('confirmation'); ?>" placeholder="<?php echo $this->fLabel('confirmation'); ?>">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Envoyer</button>
        </div>
    </div>
</form>
