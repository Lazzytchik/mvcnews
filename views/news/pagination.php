<div class="pagination">
    <?php

    if($count > 0 && $page <= $count){
        if($page > 1){
            echo '<a href="page-'.((int)$page - 1).'"><div class="arrow block">«</div></a>';
        }

        if($page > 3){
            echo '<a href="page-1"><div class="block">1</div></a>';
            echo '<div class="block">...</div>';
        }

        for ($i = $page-2; $i < $page + 3; $i += 1){
            if($i == $page){
                echo '<a href="page-'.$i.'"><div class="block selected">'.$i.'</div></a>';
            }
            else if($i > 0 && $i <= $count){
                echo '<a href="page-'.$i.'"><div class="block">'.$i.'</div></a>';
            }

        }
        //echo '<a href="'.$page.'"><div class="block">'.$page.'</div></a>';

        if($count - $page > 2){
            echo '<div class="block">...</div>';
            echo '<a href="page-'.$count.'"><div class="block">'.$count.'</div></a>';
        }

        if($page < $count){
            echo '<a href="page-'.((int)$page + 1).'"><div class="arrow block">»</div></a>';
        }
    }


    ?>
</div>