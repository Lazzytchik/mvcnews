<?php


class News
{

    const SHOW_BY_DEFAULT = 5;

    private static function toArray($query): array
    {
        $array = array();

        $i = 0;

        while ($row = $query->fetch()){
            $array[$i]['id'] = $row['id'];
            $array[$i]['title'] = $row['title'];
            $array[$i]['text'] = $row['text'];
            $array[$i]['post_date'] = $row['post_date'];
            $array[$i]['group_name'] = $row['group_name'];
            $array[$i]['cat_name'] = $row['cat_name'];
            $i++;
        }

        return $array;
    }

    //  Функция, которая возвращает результат запроса новостей
    //  Параметр page определяет на какой странице находятся данные.
    public static function getNews($page = 1){

        $db = Db::getConnection();

        $news = "SELECT id, title, text, post_date, group_name, cn.cat_name FROM news JOIN categorized_news cn ORDER by post_date DESC LIMIT :limit OFFSET :offset";

        $offset = ($page - 1)*self::SHOW_BY_DEFAULT;

        $query = $db->prepare($news);
        $query->bindValue('limit', self::SHOW_BY_DEFAULT, PDO::PARAM_INT);
        $query->bindValue('offset', $offset, PDO::PARAM_INT);
        $query->execute();

        return self::toArray($query);
    }

    //  Функция, которая возвращает результат запроса новостей по группе
    //  Параметр page определяет на какой странице находятся данные.
    public static function getGroupedNews($group, $page = 1){

        $db = Db::getConnection();

        $news = "SELECT id, title, text, post_date, group_name, cn.cat_name FROM news JOIN categorized_news cn WHERE group_name = :group ORDER by post_date DESC LIMIT :limit OFFSET :start";

        $offset = ($page - 1)*self::SHOW_BY_DEFAULT;

        $query = $db->prepare($news);
        $query->bindValue('limit', self::SHOW_BY_DEFAULT, PDO::PARAM_INT);
        $query->bindValue('start', $offset, PDO::PARAM_INT);
        $query->bindValue('group', $group, PDO::PARAM_STR);
        $query->execute();

        return self::toArray($query);
    }

    //  Функция, которая возвращает результат запроса новостей по группе и категории
    //  Параметр page определяет на какой странице находятся данные.
    public static function getGCNews($group, $category, $page = 1){

        $db = Db::getConnection();

        $news = "SELECT id, title, text, post_date, group_name, cn.cat_name FROM news JOIN categorized_news cn on news.id = cn.news_id WHERE group_name = :group and cat_name = :category ORDER by post_date DESC LIMIT :limit OFFSET :start";

        $offset = ($page - 1)*self::SHOW_BY_DEFAULT;

        $query = $db->prepare($news);
        $query->bindValue('limit', self::SHOW_BY_DEFAULT, PDO::PARAM_INT);
        $query->bindValue('start', $offset, PDO::PARAM_INT);
        $query->bindValue('group', $group, PDO::PARAM_STR);
        $query->bindValue('category', $category, PDO::PARAM_STR);
        $query->execute();

        return self::toArray($query);
    }


}