<nav>
    <ul class="topmenu">
        <li><a href="/news/" class="active">Новости<span class="fa fa-angle-down"></span></a>
            <ul class="submenu">
                <?php

                    foreach ($groupsPreview as $group => $value){
                        echo '<li>';
                        echo '<a href="/news/group-'.$group.'/">'.$group.'<span class="fa fa-angle-down"></span></a>';
                        require 'subMenu.php';
                        echo '</li>';
                    }

                ?>
            </ul>
        </li>
        <li><a href="/about">О нас</a></li>
        <li><a href="/rules">Правила</a></li>
    </ul>
    <?php

    if(isset($_SESSION['username'])){
        require_once ROOT . "/views/menu/authMenu/loggedInForm.php";
    }else{
        require ROOT . "/views/menu/authMenu/authMenu.php";
    }
    ?>
</nav>
