<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>News</title>
    <link href="/template/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>

<?

require ROOT . '/views/menu/mainmenu.php';

?>

<div id='main'>
    <h1>О нас</h1>
    <p>На этом небольшом новостном портале вы можете найти новости в сфере веб-технологий на различные темы. Здесь представлены следующие группы и категории:</p>
    <h3>Группы новостей</h3>
    <ul class="groups-list">
        <?php


        foreach ($groupsPreview as $group => $gAmount){
            //echo $group.' => '.$gAmount.'<br>';
            echo '<li><a href="/news/group-'.$group.'/">'.$group.'('.$gAmount.')</br> - '.$groups[$group]['description'].'</a>';

            echo '<ul class="cat-list">';

            foreach ($categoriesPreview[$group] as $category => $cAmount){
                echo '<li><a href="/news/group-'.$group.'/'.strtolower($category).'/">'.$categories[$category]['ru_name'].'('.$cAmount.')'.'</a>';
                echo '</li>';
            }

            echo '</ul>';
            echo '</li>';
        }

        ?>
    </ul>
</div>

</body>

</html>
