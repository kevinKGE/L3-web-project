<?php
    session_start();
    echo "déconnexion PHP</br>";

    $_SESSION = array();
    session_destroy();

    header("Refresh:0");
?>