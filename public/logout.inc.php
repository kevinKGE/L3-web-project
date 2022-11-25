<?php
    echo "déconnexion PHP</br>";
    session_start();
    session_destroy();

    header("Refresh:0");
?>