<?php


class Db
{
    public static function getConnection(): PDO
    {
        $paramsPath = ROOT . '/config/db_params.php';
        $params = include($paramsPath);

        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";

        return new PDO($dsn, $params['user'], $params['password']);
    }
}