<?php

namespace Sistr;

defined('SISTR') or die('Acces interdit');

class UtilisateursModel implements \F3il\AuthenticationInterface {

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
        $auth = \F3il\Authentication::getInstance();
        $salt = $auth->hash($data['motdepasse'], $date);
        $db = \F3il\Database::getInstance();
        $sql = "INSERT INTO utilisateurs (nom, prenom, email, login, motdepasse, creation, connexion) VALUES (:nom, :prenom, :email, :login, :motdepasse, :creation, :connexion)";
        try {
            $req = $db->prepare($sql);
            $req->bindValue(':nom', $data['nom']);
            $req->bindValue(':prenom', $data['prenom']);
            $req->bindValue(':email', $data['email']);
            $req->bindValue(':login', $data['login']);
            $req->bindValue(':motdepasse', $salt);
            $req->bindValue(':creation', $date);
            $req->bindValue(':connexion', $date);
            $req->execute();
        } catch (\PDOException $ex) {
            throw new \F3il\SqlError($sql, $req, $ex);
        }
    }

    public function loginExistant($login, $id) {
        $db = \F3il\Database::getInstance();
        $sql = "SELECT count(*) as res FROM utilisateurs WHERE login =:login";

        if (intval($id) != 0) {
            $sql = $sql . " AND id = :id";
        }
        try {
            $req = $db->prepare($sql);
            $req->bindValue(':login', $login);
            if (intval($id) != 0) {
                $req->bindValue(':id', intval($id));
            }
            $req->execute();
        } catch (\PDOException $ex) {
            throw new \F3il\SqlError($sql, $req, $ex);
        }
        if ($req->fetch(\PDO::FETCH_ASSOC)['res'] != 0) {
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

    public function mettreAJour($data) {
        $db = \F3il\Database::getInstance();
        $sql = "UPDATE utilisateurs SET nom = :nom, prenom = :prenom, email = :email, login = :login ";
        if (!empty($data['motdepasse'])) {
            $sql = $sql . ", motdepasse = :motdepasse ";
        }
        $sql = $sql . " WHERE id = :id";


        $auth = \F3il\Authentication::getInstance();
        $date = $this->auth_getSalt($data['login']);
        $salt = $auth->hash($data['motdepasse'], $date);

        try {
            $req = $db->prepare($sql);
            $req->bindValue(':id', $data['id']);
            $req->bindValue(':nom', $data['nom']);
            $req->bindValue(':prenom', $data['prenom']);
            $req->bindValue(':email', $data['email']);
            $req->bindValue(':login', $data['login']);
            if (!empty($data['motdepasse'])) {
                $req->bindValue(':motdepasse', $salt);
            }
            $req->execute();
        } catch (\PDOException $ex) {
            throw new \F3il\SqlError($sql, $req, $ex);
        }
    }

    public function auth_getLoginKey() {
        return 'login';
    }

    public function auth_getPasswordKey() {
        return 'motdepasse';
    }

    public function auth_getUserById($id) {
        return $this->lire($id);
    }

    public function auth_getUserByLogin($login) {
        $db = \F3il\Database::getInstance();

        $sql = "SELECT * FROM utilisateurs WHERE login= :login";
        try {
            $req = $db->prepare($sql);
            $req->bindValue(':login', $login);
            $req->execute();
        } catch (\PDOException $ex) {
            throw new \F3il\SqlError($sql, $req, $ex);
        }

        return $req->fetch(\PDO::FETCH_ASSOC);
    }

    public function auth_getUserIdKey() {
        return 'id';
    }

    public function auth_getSalt($user) {
        $db = \F3il\Database::getInstance();

        $sql = "SELECT creation FROM utilisateurs WHERE login= :login";
        try {
            $req = $db->prepare($sql);
            $req->bindValue(':login', $user);
            $req->execute();
        } catch (\PDOException $ex) {
            throw new \F3il\SqlError($sql, $req, $ex);
        }

        return $req->fetch(\PDO::FETCH_ASSOC);
    }

}
