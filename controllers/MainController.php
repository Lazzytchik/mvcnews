<?php

require_once ROOT.'/models/News.php';
require_once ROOT.'/models/Auth.php';
require_once ROOT.'/components/Db.php';

class MainController
{
    public function actionIndex(){

        session_start();

        $groups = News::getGroups();
        $categories = News::getCategories();

        $categoriesPreview = News::getNewsPreview();
        $groupsPreview = News::getGroupsPreview();

        require_once ROOT . "/views/index.php";
    }
}