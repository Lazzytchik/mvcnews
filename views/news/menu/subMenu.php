<ul class="submenu">
    <?php

    if(!empty($categories)){
        foreach($categories as $cat){
            echo '<li>';
            echo '<a href="/news/group-'.$group['name'].'/'.strtolower($cat['name']).'/">'.$cat['ru_name'].'</a>';
            echo '</li>';
        }
    }

    ?>
</ul>
