<?php


class News
{

    const SHOW_BY_DEFAULT = 2;

    //
    private static function newsToArray($query): array
    {
        $array = array();

        $i = 0;

        if ($query){
            while ($row = $query->fetch()){
                $array[$i]['id'] = $row['id'];
                $array[$i]['title'] = $row['title'];
                $array[$i]['text'] = $row['text'];
                $array[$i]['post_date'] = $row['post_date'];
                $array[$i]['group_name'] = $row['group_name'];
                $array[$i]['image'] = $row['image'];
                $i++;
            }
        }

        return $array;
    }

    private static function groupsToArray($query): array
    {

        $array = array();

        $i = 0;

        if ($query){
            while ($row = $query->fetch()){
                $array[$i]['name'] = $row['name'];
                $array[$i]['ru_name'] = $row['ru_name'];
                $i++;
            }
        }


        return $array;
    }

    //  Функция, которая возвращает результат запроса новостей
    //  Параметр page определяет на какой странице находятся данные.
    public static function getNews($page = 1): array
    {

        $db = Db::getConnection();

        $news = "SELECT * FROM news ORDER by post_date DESC LIMIT :limit OFFSET :offset";

        $offset = ($page - 1)*self::SHOW_BY_DEFAULT;

        $query = $db->prepare($news);
        $query->bindValue('limit', self::SHOW_BY_DEFAULT, PDO::PARAM_INT);
        $query->bindValue('offset', $offset, PDO::PARAM_INT);
        $query->execute();

        return self::newsToArray($query);
    }

    //  Функция, которая возвращает результат запроса новостей по группе
    //  Параметр page определяет на какой странице находятся данные.
    public static function getGroupedNews($group, $page = 1): array
    {

        $db = Db::getConnection();

        $news = "SELECT * FROM news WHERE group_name = :group ORDER by post_date DESC LIMIT :limit OFFSET :start";

        $offset = ($page - 1)*self::SHOW_BY_DEFAULT;

        $query = $db->prepare($news);
        $query->bindValue('limit', self::SHOW_BY_DEFAULT, PDO::PARAM_INT);
        $query->bindValue('start', $offset, PDO::PARAM_INT);
        $query->bindValue('group', $group, PDO::PARAM_STR);
        $query->execute();

        return self::newsToArray($query);
    }

    //  Функция, которая возвращает результат запроса новостей по группе и категории
    //  Параметр page определяет на какой странице находятся данные.
    public static function getGCNews($group, $category, $page = 1): array
    {

        $db = Db::getConnection();

        $news = "SELECT * FROM news JOIN categorized_news cn on news.id = cn.news_id WHERE group_name = :group and cat_name = :category ORDER by post_date DESC LIMIT :limit OFFSET :start";

        $offset = ($page - 1)*self::SHOW_BY_DEFAULT;

        $query = $db->prepare($news);
        $query->bindValue('limit', self::SHOW_BY_DEFAULT, PDO::PARAM_INT);
        $query->bindValue('start', $offset, PDO::PARAM_INT);
        $query->bindValue('group', $group, PDO::PARAM_STR);
        $query->bindValue('category', $category, PDO::PARAM_STR);
        $query->execute();

        return self::newsToArray($query);
    }


    //  Функция, которая возвращает результат запроса групп новостей
    public static function getGroups(): array
    {

        $db = Db::getConnection();

        $groups = "SELECT * FROM `groups`";
        $query = $db->query($groups);

        return self::groupsToArray($query);

    }

    //  Функция, которая возвращает результат запроса категорий новостей
    public static function getCategories(): array
    {

        $db = Db::getConnection();

        $cat = "SELECT * FROM categories ORDER by name";
        $query = $db->query($cat);

        return self::groupsToArray($query);
    }

    public static function getArticle($id){

        $db = Db::getConnection();

        $sql = "SELECT * FROM news WHERE id = :id";
        $query = $db->prepare($sql);
        $query->bindValue('id', $id, PDO::PARAM_INT);
        $query->execute();

        return self::newsToArray($query);
    }

    public static function getNewsCategories($newsId): array
    {

        $db = Db::getConnection();

        $sql = "SELECT name, ru_name FROM `news`
                JOIN `categorized_news` cn ON news.id = cn.news_id
                JOIN `categories` c ON cn.cat_name = c.name
                WHERE id = :id";
        $query = $db->prepare($sql);
        $query->bindValue('id', $newsId, PDO::PARAM_INT);
        $query->execute();

        return self::groupsToArray($query);
    }

    public static function getNewsCount(){

        $db = Db::getConnection();

        $news = "SELECT COUNT(id) as amount FROM news ORDER by post_date DESC";

        $query = $db->prepare($news);
        $query->execute();

        return floor($query->fetch()['amount'] / self::SHOW_BY_DEFAULT);
    }

    public static function getGNewsCount($group){

        $db = Db::getConnection();

        $news = "SELECT COUNT(id) as amount FROM news
                 WHERE group_name = :group
                 ORDER by post_date DESC";

        $query = $db->prepare($news);
        $query->bindValue('group', $group, PDO::PARAM_STR);
        $query->execute();

        return floor($query->fetch()['amount'] / self::SHOW_BY_DEFAULT);
    }

    public static function getGCNewsCount($group, $category){

        $db = Db::getConnection();

        $news = "SELECT COUNT(id) as amount FROM news
                 JOIN categorized_news cn on cn.news_id = news.id 
                 WHERE cat_name = :category and group_name = :group
                 ORDER by post_date DESC";

        $query = $db->prepare($news);
        $query->bindValue('group', $group, PDO::PARAM_STR);
        $query->bindValue('category', $category, PDO::PARAM_STR);
        $query->execute();

        return floor($query->fetch()['amount'] / self::SHOW_BY_DEFAULT);
    }

    public static function getNewsPreview(){

        $db = Db::getConnection();

        $news = "SELECT group_name, cat_name, Count(news_id) as amount FROM categorized_news cn
                 JOIN news on news.id = cn.news_id
                 GROUP BY group_name, cat_name";

        $query = $db->prepare($news);
        $query->execute();

    }

}