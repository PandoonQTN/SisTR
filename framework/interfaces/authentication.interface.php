<?php
namespace F3il;
defined('F3IL') or die('Acces interdit');

interface AuthenticationInterface
{
    /**
     * Retourne le nom de la propriété login
     * @return string
     */
    public function auth_getLoginKey();
    
    /**
     * Retourne le nom de la propriété password
     * @return string
     */
    public function auth_getPasswordKey();
    
    /**
     * Retourne la propriété qui contient l'id de l'utilisateur
     * @return integer
     */
    public function auth_getUserIdKey();
           
    
    /**
     * Retourne l'utilisateur à partir de son login
     * @param string $login
     * @return array Utilisateur
     */
    public function auth_getUserByLogin($login);
    
    /**
     * Retourne l'utilisateur à partir de son id     * 
     * @param string $id
     * @return array Utilisateur
     */
    public function auth_getUserById($id);
}