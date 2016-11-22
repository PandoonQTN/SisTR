<?php
namespace Sistr;
defined('SISTR') or die('Acces interdit');
?>
<form method="POST" action="?controller=form&action=form" class="form-horizontal">
    <div class="form-group">
        <label for="email" class="col-sm-2 control-label">Email : </label>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
        </div>
    </div>
    <div class="form-group">
        <label for="age" class="col-sm-2 control-label">Age : </label>
        <div class="col-sm-10">
            <input type="number" class="form-control" id="age" name="age" placeholder="Age">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Envoyer</button>
        </div>
    </div>
</form>
