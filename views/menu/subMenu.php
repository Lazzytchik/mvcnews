<ul class="submenu">
    <?php

        foreach($categoriesPreview[$group] as $category => $value){
            echo '<li>';
            echo '<a href="/news/group-'.$group.'/'.strtolower($category).'/">'.$categories[$category]['ru_name'].'</a>';
            echo '</li>';
        }

    ?>
</ul>
