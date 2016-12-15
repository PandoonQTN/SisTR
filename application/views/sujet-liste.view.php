<?php

namespace Sistr;

defined('SISTR') or die("Accès interdit");
?>


<div class="container">

    <div class="row">

        <div class="col-md-3">
            <p class="lead">Sujet</p>
            <div class="list-group">
                <a href="#" class="list-group-item">Tous les sujets</a>
                <a href="#" class="list-group-item">Non affectés</a>
                <a href="#" class="list-group-item">En cours</a>
                <a href="#" class="list-group-item">Terminés</a>
            </div>
        </div>

        <div class="col-md-9">
            <h1>Sujets : sujet terminés</h1> <hr>

            <input class="btn btn-default" type="button" value="Créer">
            <input class="btn btn-default" type="button" value="Modifier">
            <input class="btn btn-default" type="button" value="Affecter">
            <input class="btn btn-default" type="button" value="Supprimer">

            <hr>

            <table class="table table-bordered table-striped"> 
                <thead> 
                    <tr> 
                        <th><input type="checkbox"></th> 
                        <th>Titre</th> 
                        <th>Proposé</th> 
                        <th>Groupe</th> 
                        <th>Status</th> 
                    </tr> 
                </thead> 
                <tbody>
                    <tr> 
                        <th scope="row"><input type="checkbox"></th>
                        <td>Virtual Ducks</td> 
                        <td>2016-09-30</td> 
                        <td></td>
                        <td>-</td>                               
                    </tr> 
                    <tr> 
                        <th scope="row"><input type="checkbox"></th>
                        <td>Virtual Ducks</td> 
                        <td>2016-09-30</td> 
                        <td></td>
                        <td>Terminé</td>                               
                    </tr> 
                </tbody> 
            </table>
        </div>

    </div>

</div>

<div class="container">

    <hr>
    <footer>
        <div class="row">
            <div class="col-lg-12">
                <p>Copyright &copy; Your Website 2014</p>
            </div>
        </div>
    </footer>

</div>
