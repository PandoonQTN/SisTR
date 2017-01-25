<?php

namespace Sistr;

defined('SISTR') or die('Acces interdit');

/**
 * Classe  
 * Permet de gérer toutes les requêtes de BDD
 */
class NoteModel {


    public function lister() {
        $db = \F3il\Database::getInstance();

        $sql = "SELECT * FROM note";
        try {
            $req = $db->prepare($sql);
            $req->execute();
        } catch (\PDOException $ex) {
            throw new \F3il\SqlError($sql, $req, $ex);
        }
        return $req->fetchAll(\PDO::FETCH_ASSOC);
    }




    public function creer($data) {
        $date = date('Y-m-j H:i:s');
        $db = \F3il\Database::getInstance();
        $sql = "INSERT INTO note (titre, text, horodate) VALUES (:titre, :text, :horodate)";
        try {
            $req = $db->prepare($sql);
            $req->bindValue(':titre', $data['titre']);
            $req->bindValue(':text', $data['text']);
            $req->bindValue(':horodate', $date);
            $req->execute();
        } catch (\PDOException $ex) {
            throw new \F3il\SqlError($sql, $req, $ex);
        }
    }

    public function lire($id) {
        $db = \F3il\Database::getInstance();

        $sql = "SELECT * FROM note WHERE id= :id";
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
