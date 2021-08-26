<?php


class Auth
{

    public static  function login($username, $password) : bool{

        $user = self::getUser($username);
        $count = count($user);

        //echo $password.'<br>';
        //echo password_hash($password, PASSWORD_DEFAULT).'<br>';

        if($count > 0 && password_verify($password, $user[0]['Hash_password'])){
            $_SESSION['username'] = $username;
            return true;
        }

        return false;
    }

    private static function getUser($login): array
    {

        $db = Db::getConnection();

        $sql = "SELECT * FROM users WHERE login = :login";

        $query = $db->prepare($sql);
        $query->bindValue('login', $login, PDO::PARAM_STR);
        $query->execute();

        return $query->fetchAll();
    }

}