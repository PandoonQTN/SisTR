<?php
    $host = 'localhost';
    $dbname = 'sistr';
    $login = 'root';
    $password = '';
    
    try {
        $db = new PDO('mysql:host='.$host.';dbname='.$dbname,$login,$password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $ex) {
        die("Erreur connexion BDD ".$ex->getMessage());
    }
    
    $sql = "SELECT * FROM utilisateurs";
    try {
        $req = $db->prepare($sql);
        $req->execute();
    } catch (PDOException $ex) {
        die("Erreur requête ".$ex->getMessage());
    }
    
    $utilisateurs = $req->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <table style="font-family: courier;">
    <?php
    foreach($utilisateurs as $u) {
        $mdp = hash('sha256',hash('sha256',$u['creation']).$u['motdepasse']);
        ?>
        <tr>
            <td><?php echo $u['id'];?></td>
            <td><?php echo $u['login'];?></td>
            <td><?php echo $mdp;?></td>
        </tr>
        <?php
    }
    ?>
    </table>
