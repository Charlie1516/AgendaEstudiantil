<?php

require_once __DIR__ . "/../dao/UserDao.php";

class UserController
{
    public static function getUser($user_id)
    {
        $userDao = new UserDao();
        return $userDao->find($user_id);
    }
    
    public static function removeUser($user_id)
    {
        $userDao = new UserDao();
        return $userDao->remove($user_id);
    }
    
    public static function getAllUsers()
    {
        $userDao = new UserDao();
        return $userDao->getAll();
    }
}
