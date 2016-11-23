<?php

namespace Sistr;

defined('SISTR') or die('Acces interdit');
?>
<form method="POST" action="<?php echo $this->getAction(); ?>" class="form-horizontal">
    <div class="form-group">
        <label for="<?php echo $this->fName('email'); ?>" class="col-sm-2 control-label">
                <?php echo $this->fLabel('email'); ?> :
        </label>
        <div class="col-sm-10">
            <input type="<?php echo $this->fName('email'); ?>" class="form-control" id="<?php echo $this->fName('email'); ?>" name="<?php echo $this->fName('email'); ?>" placeholder="<?php echo $this->fLabel('email'); ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="<?php echo $this->fName('age'); ?>" class="col-sm-2 control-label"><?php echo $this->fLabel('age'); ?> : </label>
        <div class="col-sm-10">
            <input type="number" class="form-control" id="<?php echo $this->fName('age'); ?>" name="<?php echo $this->fName('age'); ?>" placeholder="<?php echo $this->fLabel('age'); ?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Envoyer</button>
        </div>
    </div>
</form>
