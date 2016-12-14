<?php

namespace Sistr;

defined('SISTR') or die('Acces interdit');

use \F3il\Form;

abstract class FormHelper {

    public static function input(Form $form, $fieldName, $type) {
        ?>
        <div class="form-group">
            <label for="<?php echo $form->fName($fieldName); ?>" class="col-sm-2 control-label">
                <?php echo $form->fLabel($fieldName); ?> :
            </label>
            <div class="col-sm-10">
                <input type="<?php echo $type ?>" 
                       class="form-control" id="<?php echo $form->fName($fieldName); ?>" 
                       name="<?php echo $form->fName($fieldName); ?>" 
                       placeholder="<?php echo $form->fLabel($fieldName); ?>">
            </div>
            <?php 
            echo $form->missingFieldMessageRenderer($form->getField($fieldName));
            echo $form->fMessages($fieldName); ?>
        </div>
        <?php
    }

}
