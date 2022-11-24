<?php
require_once '../public/functions.php';
require_once '../public/regex.php';
require_once '../public/Donnees.inc.php';
require_once '../front/search.php';

if (isset($_POST['submit2'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    // vérifie que les champs ne sont pas vides
    if ($login && $password) {
        // vérifie que le login et le mot de passe correspondent à ceux de la base de données
        echo 'champs non vides</br>';
        $user = login($login, $password);
        echo "user:".$user."</br>";
        if ($user) {
            $_SESSION['user'] = $user;
            echo "session OK</br>";
        } else {
            echo 'Mauvais login ou mot de passe !</br>';
        }
    }
}
?>

<header>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <form class="container-fluid justify-content-start">
                <button class="btn btn-outline-success me-2" type="button">Navigation</button>
                <button class="btn btn-outline-success me-2" type="button">Recettes <i class="bi bi-heart-fill"></i></button>
            </form>
            <form class="d-flex" role="search" action=# method="POST">
                <label class="">Recette : </label>
                <input class="form-control me-2" name="search" type="search" placeholder="" aria-label="Search">
                <button class="btn btn-outline-success" name="submit3" type="submit"><i class="bi bi-search"></i></button>
            </form>
            <?php
            if (isset($_SESSION['user'])) { ?>
                <form class="container-fluid justify-content-start">
                    <button class="btn btn-outline-success me-2" type="button" onclick="window.location.href='./login.php'">Profile</button>
                    <button class="btn btn-outline-success me-2" type="button" onclick="() => {<?php logout() ?>}">Se déconnecter</button>
                </form>
            <?php
            } else { ?>
                <form class="container-fluid justify-content-start" action=# method="POST">
                    <label>Login</label>
                    <input name="login"></input>
                    <label>Mot de passe </label>
                    <input name='password'></input>
                    <button class="btn btn-outline-success me-2" type="submit" name="submit2">Connexion</button>
                </form>
                <button class="btn btn-outline-success me-2" type="button" onclick="window.location.href='./signup.php'">S'inscrire</button>
            <?php
            }
            ?>
        </div>
    </nav>
</header>