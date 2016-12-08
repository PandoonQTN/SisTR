<?php

namespace Sistr;

defined('SISTR') or die('Acces interdit');

class UtilisateursModel {

    public function lister() {
        $db = \F3il\Database::getInstance();

        $sql = "SELECT * FROM utilisateurs ORDER BY nom, prenom";
        try {
            $req = $db->prepare($sql);
            $req->execute();
        } catch (\PDOException $ex) {
            throw new \F3il\SqlError($sql, $req, $ex);
        }
        return $req->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function supprimer($id) {
        $db = \F3il\Database::getInstance();
        $sql = "DELETE FROM utilisateurs WHERE id =" . $id;
        try {
            $req = $db->prepare($sql);
            $req->execute();
        } catch (\PDOException $ex) {
            throw new \F3il\SqlError($sql, $req, $ex);
        }
    }

    public function creer($data) {
        $date = date('Y-m-j H:i:s');
        $db = \F3il\Database::getInstance();
        $sql = "INSERT INTO utilisateurs (nom, prenom, email, login, motdepasse, creation) VALUES (:nom, :prenom, :email, :login, :motdepasse, :creation)";
        try {
            $req = $db->prepare($sql);
            $req->bindValue(':nom', $data['nom']);
            $req->bindValue(':prenom', $data['prenom']);
            $req->bindValue(':email', $data['email']);
            $req->bindValue(':login', $data['login']);
            $req->bindValue(':motdepasse', $data['motdepasse']);
            $req->bindValue(':creation', $date);
            $req->execute();
        } catch (\PDOException $ex) {
            throw new \F3il\SqlError($sql, $req, $ex);
        }
    }

    public function loginExistant($login, $id) {
        $db = \F3il\Database::getInstance();
        $sql = "SELECT count(*) FROM utilisateurs WHERE login =:loing";
        if ($id != 0) {
            $sql += " AND id = :id";
        }
        try {
            $req = $db->prepare($sql);
            $req->bindValue(':login', $login);
            if ($id != 0)
                $req->bindValue(':id', $id);
            $req->execute();
        } catch (\PDOException $ex) {
            throw new \F3il\SqlError($sql, $req, $ex);
        }
        if ($req->fetch() != 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function lire($id) {
        $db = \F3il\Database::getInstance();

        $sql = "SELECT * FROM utilisateurs WHERE id= :id";
        try {
            $req = $db->prepare($sql);
            $req->bindValue(':id', $id);
            $req->execute();
        } catch (\PDOException $ex) {
            throw new \F3il\SqlError($sql, $req, $ex);
        }
        return $req->fetch(\PDO::FETCH_ASSOC);
    }

}
