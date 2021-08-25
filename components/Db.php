<?php


class Db
{

    private static $db;

    public static function getConnection(): PDO
    {

        if (!isset(self::$db)){
            $paramsPath = ROOT . '/config/db_params.php';
            $params = include($paramsPath);

            $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
            self::$db = new PDO($dsn, $params['user'], $params['password']);
        }

        return self::$db;
    }
}