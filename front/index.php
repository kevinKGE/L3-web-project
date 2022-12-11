<?php

session_start();
require_once 'source/head.php';
require_once 'source/header.php';


if(isset($_POST['search'])){
            require_once 'search.php';
        }else {
?>
    <nav id="nav_index">
        <?php
                require_once 'navigation.php';
        ?>
    </nav>

    <main>
        <?php
                require_once 'main.php';
        ?>
    </main>

<?php
        }
require_once 'source/footer.php';
?>