<?php

namespace Sistr;

defined('SISTR') or die('Acces interdit');
?>
<form id="login-form" method="POST" action="<?php echo $this->getAction(); ?>">
<!--    <input type="text" id="login" name="login" placeholder="Votre login"/>
    <input type="password" id="motdepasse" name="motdepasse" placeholder="Votre mot de passe"/>-->
    <?php 
    FormHelper::input($this, 'login', 'text');
    FormHelper::input($this, 'motdepasse', 'password');
    \F3il\CsrfHelper::csrf(); ?> 

    <button type="submit">Se connecter</button>
</form>