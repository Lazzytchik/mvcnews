<!DOCTYPE html>

<!-- HTML форма для вывода новостей -->
<div class="newspaper">
    <a href="/news/article/<?php echo $article['id']?>"><h2><?php echo $article['title'] ?></h2></a>
    <img class="newspaper__image" src="<?php echo $article['image'] ?>">
    <div class="tags">
        <a href=<?php echo "/news/group-".$article['group_name']."/" ?>><p class="group"><?php echo $article['group_name']?></p></a>
        <?php

        foreach ($newsCatList as $cat){
            echo ('<a href="/news/group-'.$article['group_name'].'/'.$cat['name'].'/"><p class="category">'.$cat['ru_name'].'</p></a>') ;
        }
        ?>

    </div>
    <p class="date"><?php echo $article['post_date'] ?></p>
    <p class="date"><?php echo $article['views'].' просмотров' ?></p>
    <p><?php echo $article['text'] ?></p>
</div>
