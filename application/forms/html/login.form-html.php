<?php

namespace Sistr;

defined('SISTR') or die('Acces interdit');
$login = 'login';
$password = 'motdepasse';
?>
<form id="login-form" method="POST" action="<?php echo $this->getAction(); ?>">
<!--    <input type="text" id="login" name="login" placeholder="Votre login"/>
    <input type="password" id="motdepasse" name="motdepasse" placeholder="Votre mot de passe"/>-->
    <br>
    <input type="text" 
           class="form-control" id="<?php echo $this->fName($login); ?>" 
           name="<?php echo $this->fName($login); ?>" 
           value="<?php echo $this->fValue($login); ?>"
           placeholder="<?php echo $this->fLabel($login); ?>">
    <input type="password" 
           class="form-control" id="<?php echo $this->fName($password); ?>" 
           name="<?php echo $this->fName($password); ?>" 
           value="<?php echo $this->fValue($password); ?>"
           placeholder="<?php echo $this->fLabel($password); ?>">

    <?php
    \F3il\CsrfHelper::csrf();
    ?> 

    <button type="submit">Se connecter</button>
</form>