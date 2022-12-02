<?php
require_once 'source/head.php';
require_once 'source/header.php';
require_once '../public/functions.inc.php';
require_once '../public/regex.php';

if (isset($_POST['submit'])) {
    $name = htmlspecialchars(trim($_POST['name']));
    $firstName = htmlspecialchars(trim($_POST['firstName']));
    $login = htmlspecialchars(trim($_POST['login']));
    $password = htmlspecialchars(trim($_POST['password']));
    $birthDate = htmlspecialchars(trim($_POST['birthDate']));
    $sex = htmlspecialchars(trim($_POST['sex']));

    
    // hash of password:
    $password = password_hash($password, PASSWORD_DEFAULT);
    
    $userToAdd = array(
        'login' => $login,
        'password' => $password,
        'name' => $name,
        'firstname' => $firstName,
        'sex' => $sex,
        'birthDate' => $birthDate,
        'favorites' => array()
    );

    $signUp = validate_format($userToAdd);
    if ($signUp != true){
        echo $signUp;
    };

    if ($login && $password) {
        if ($password != "") {

            user_signup($userToAdd);
            echo 'Inscription réussie';

        } else echo "Le mot de passe est trop court !";
    } else echo "Veuillez saisir tous les champs obligatoires !";
}
?>


<h1>Inscription</h1>
<div class="container-fluid bg-light">
    <div class="row">
        <div class="col">
            <form class="container-fluid justify-content-start" action=# method="POST">

                <p>Login*</p>
                <input type="login" name="login" required="required">

                <p>Password*</p>
                <input type="password" name="password" required="required">

                <p>Nom</p>
                <input type="text" name="name">

                <p>Prenom</p>
                <input type="text" name="firstName">

                <p>Date de naissance</p>
                <input type="date" name="birthDate">

                <p>Sexe</p>
                <input type="radio" name="sex" value="male" checked>
                <label for="male">Homme</label>

                <input type="radio" name="sex" value="female">
                <label for="female">Femme</label>

                <input type="submit" name="submit" onclick="user_signup($_POST)" value="inscription">

            </form>
        </div>
    </div>
</div>

<?php
require_once 'source/footer.php';
?>