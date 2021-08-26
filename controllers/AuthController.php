<?php


require_once ROOT. '/models/Auth.php';
require_once ROOT. '/components/Db.php';

class AuthController
{
    public function actionLogin(){

        session_start();

        $username = $_POST['login'];
        $password = $_POST['password'];

        Auth::login($username, $password);

        //echo "<script>window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();

    }

    public function actionLogout(){

        session_start();
        session_destroy();
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
}