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
            
        // + mettre le coeur rouge si il y en a un 
        //faire une verification dans ce type la pour filtrer la gestion des cookie et de favori
        ?>
    </main>

<?php
        }
require_once 'source/footer.php';
?>