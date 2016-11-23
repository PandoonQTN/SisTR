<?php
    $saisie = "0";
    
    $data = filter_var($saisie,FILTER_SANITIZE_NUMBER_INT);
    echo "Filtre FILTER_SANITIZE_NUMBER_INT : ".$data.'<br>';
    
    $valid = filter_var($saisie,FILTER_VALIDATE_INT);
    if($valid===false){
        echo "Validateur FILTER_VALIDATE_INT false";
    } else {
        echo "Validateur FILTER_VALIDATE_INT ".$valid;
    }
    

