<?php

namespace Sistr;

defined('SISTR') or die('Acces interdit');

/**
 * Classe UtilisateurModel 
 * Permet de gérer toutes les requêtes de BDD
 */
class UtilisateursModel implements \F3il\AuthenticationInterface {

    /**
     * Fonction permettant de récupérer tous les utilisateurs
     * @return type
     * @throws \F3il\SqlError
     */
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

    /**
     * Fonction permettant de supprimer un utilisateur en fonction de son identifiant
     * @param type $id
     * @throws \F3il\SqlError
     */
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

    /**
     * Fonction permettant de créer un utilisateur
     * @param type $data
     * @throws \F3il\SqlError
     */
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

    /**
     * Fonction permettant de savoir si un login existe déjà
     * @param type $login
     * @param type $id
     * @return boolean
     * @throws \F3il\SqlError
     */
    public function loginExistant($login, $id) {
        $db = \F3il\Database::getInstance();
        $sql = "SELECT count(*) as res FROM utilisateurs WHERE login =:login";

        if (intval($id) != 0) {
            $sql = $sql . " AND id != :id";
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

    /**
     * Fonction permettant de récupérer un utilisateur en fonction de son identifiant
     * @param type $id
     * @return type
     * @throws \F3il\SqlError
     */
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

    /**
     * Fonction permetttant de mettre à jour un utilisateur
     * @param type $data
     * @throws \F3il\SqlError
     */
    public function mettreAJour($data) {
        $db = \F3il\Database::getInstance();
        $sql = "UPDATE utilisateurs SET nom = :nom, prenom = :prenom, email = :email, login = :login ";
        if (!empty($data['motdepasse'])) {
            $sql = $sql . ", motdepasse = :motdepasse ";
        }
        $sql = $sql . " WHERE id = :id";


        $auth = \F3il\Authentication::getInstance();
        $date = $this->auth_getSalt($data['login']);
        $salt = $auth->hash($data['motdepasse'], $date['creation']);

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

    /**
     * Fonction permettant de connaitre la LoginKey de l'utilisateur connecté
     * @return string
     */
    public function auth_getLoginKey() {
        return 'login';
    }

    /**
     *  Fonction permettant de connaitre la PasswordKey de l'utilisateur connecté
     * @return string
     */
    public function auth_getPasswordKey() {
        return 'motdepasse';
    }

    /**
     * Fonction permettant de connaitre les informations de l'utilisateur connecté en fonction de son identifiant
     * @param type $id
     * @return type
     */
    public function auth_getUserById($id) {
        return $this->lire($id);
    }

    /**
     * Fonction permettant de connaitre les informations de l'utilisateur connecté en fonction de son login
     * @param type $login
     * @return type
     * @throws \F3il\SqlError
     */
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

    /**
     *  Fonction permettant de connaitre la IDKey de l'utilisateur connecté
     * @return string
     */
    public function auth_getUserIdKey() {
        return 'id';
    }

    /**
     * Fonction permettant de connaitre le grain de sel pour le motdepasse
     * @param type $user
     * @return type
     * @throws \F3il\SqlError
     */
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
