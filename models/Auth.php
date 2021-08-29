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

    private static function hadSeen($newsId, $username): bool
    {
        $db = Db::getConnection();

        $sql = "SELECT * FROM user_views WHERE username = :username and news_id = :newsId";

        $query = $db->prepare($sql);
        $query->bindValue('username', $username, PDO::PARAM_STR);
        $query->bindValue('newsId', $newsId, PDO::PARAM_INT);
        $query->execute();

        if ($row = $query->fetchAll()){
            return true;
        }

        return false;

    }

    private static function insertView($newsId, $username): void
    {

        $db = Db::getConnection();

        $sql = "INSERT INTO user_views(username, news_id) VALUES (:username, :newsId)";

        $query = $db->prepare($sql);
        $query->bindValue('username', $username, PDO::PARAM_STR);
        $query->bindValue('newsId', $newsId, PDO::PARAM_INT);
        $query->execute();

    }

    public static function setView($newsId, $username){
        if (isset($newsId)){
            if (!Auth::hadSeen($newsId, $username)){
                Auth::insertView($newsId, $username);
            }
        }
    }

}