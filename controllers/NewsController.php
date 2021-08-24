<?php


require_once ROOT.'/models/News.php';
require_once ROOT.'/components/Db.php';

class NewsController
{
    public function actionIndex($page = 1){

        $groups = News::getGroups();
        $categories = News::getCategories();
        $newsList = News::getNews($page);

        //$this->viewNews($groups);
        require_once ROOT.'/views/news/index.php';

    }

    public function actionGroup($group, $page = 1){

    }

    public function actionCategory($group, $category, $page = 1){

    }

    private function viewGroups($array){
        foreach ($array as $group){
            echo $group['name'].'<br>';
        }
    }

}