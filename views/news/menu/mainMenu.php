<nav>
    <ul class="topmenu">
        <li><a href="/news/" class="active">Новости<span class="fa fa-angle-down"></span></a>
            <ul class="submenu">
                <?php

                if (!empty($groups)){
                    foreach ($groups as $group){
                        echo '<li>';
                        echo '<a href="/news/group-'.$group['name'].'/">'.$group['name'].'<span class="fa fa-angle-down"></span></a>';
                        require 'subMenu.php';
                        echo '</li>';
                    }
                }

                ?>
            </ul>
        </li>
        <li><a href="../../../index.php">О нас</a></li>
        <li><a href="../../../index.php">Правила</a></li>
    </ul>
    <?php

    if(isset($_SESSION['username'])){
        echo '<form class="authorization" action="/logout.php" method="post">';
        echo '<h2>Привет, '.$_SESSION['username'].'!<h2>';
        echo '<input type="submit" class="submit" name="submit" value="Выйти">';
        echo '</form>';
    }else{
        require "authMenu.php";
    }
    ?>
</nav>
