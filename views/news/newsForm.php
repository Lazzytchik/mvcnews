<!DOCTYPE html>

<!-- HTML форма для вывода новостей -->
<div class="newspaper">
    <h2><?php echo $row->title ?></h2>
    <div class="tags">
        <a href=<?php echo "/news/group-".$row->group_name."/" ?>><p class="group"><?php echo $row->group_name?></p></a>
        <?php
        $ncats = $db->get_news_categories($row->id);
        while($inrow = $ncats->fetch(PDO::FETCH_OBJ)){
            echo ('<a href="/news/group-'.$row->group_name.'/'.$inrow->cat_name.'/"><p class="category">'.$inrow->ru_name.'</p></a>') ;
        }
        ?>
    </div>
    <p class="date"><?php echo $row->post_date ?></p>
    <p><?php echo $row->text ?></p>
</div>
