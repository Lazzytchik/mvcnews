<?php


require_once ROOT.'/models/News.php';
require_once ROOT.'/components/Db.php';

class NewsController
{
    public function actionIndex($page = 1){

        $groups = News::getGroups();
        $categories = News::getCategories();
        $newsList = News::getNews($page);
        $count = News::getNewsCount();

        require_once ROOT.'/views/news/index.php';

    }

    public function actionGroup($group, $page = 1){

        $groups = News::getGroups();
        $categories = News::getCategories();
        $newsList = News::getGroupedNews($group, $page);
        $count = News::getGNewsCount($group);

        require_once ROOT.'/views/news/index.php';
    }

    public function actionCategory($group, $category, $page = 1){

        $groups = News::getGroups();
        $categories = News::getCategories();
        $newsList = News::getGCNews($group, $category, $page);
        $count = News::getGCNewsCount($group, $category);

        require_once ROOT.'/views/news/index.php';
    }

    public function actionArticle($id){

        $groups = News::getGroups();
        $categories = News::getCategories();
        $article = News::getArticle($id);

        require_once ROOT.'/views/news/article.php';

    }

    public static function showNews($newsList){
        if (!empty($newsList)){
            foreach ($newsList as $article){
                $newsCatList = News::getNewsCategories($article['id']);

                require ROOT.'/views/news/newsForm.php';
            }
        } else{
            // Message for no articles
        }

    }

}