<?php
    echo "déconnexion PHP</br>";
    session_start();
    session_destroy();
    $_SESSION = array();

    header("Refresh:0");
?>