<?php


require_once ROOT.'/models/News.php';
require_once ROOT.'/models/Auth.php';
require_once ROOT.'/components/Db.php';

class NewsController
{
    public function actionIndex($page = 1){

        session_start();

        $groups = News::getGroups();
        $categories = News::getCategories();

        $categoriesPreview = News::getNewsPreview();
        $groupsPreview = News::getGroupsPreview();

        $newsList = News::getNews($page);
        $count = News::getNewsCount();

        require_once ROOT.'/views/news/index.php';

    }

    public function actionGroup($group, $page = 1){

        session_start();

        $groups = News::getGroups();
        $categories = News::getCategories();

        $categoriesPreview = News::getNewsPreview();
        $groupsPreview = News::getGroupsPreview();

        $newsList = News::getGroupedNews($group, $page);
        $count = News::getGNewsCount($group);

        require_once ROOT.'/views/news/index.php';
    }

    public function actionCategory($group, $category, $page = 1){

        session_start();

        $groups = News::getGroups();
        $categories = News::getCategories();

        $categoriesPreview = News::getNewsPreview();
        $groupsPreview = News::getGroupsPreview();

        $newsList = News::getGCNews($group, $category, $page);
        $count = News::getGCNewsCount($group, $category);

        require_once ROOT.'/views/news/index.php';
    }

    public function actionArticle($id){

        session_start();

        $groups = News::getGroups();
        $categories = News::getCategories();

        $categoriesPreview = News::getNewsPreview();
        $groupsPreview = News::getGroupsPreview();

        $article = News::getArticle($id);

        Auth::setView($id, $_SESSION['username']);

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