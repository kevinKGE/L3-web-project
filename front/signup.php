<?php
require_once 'source/head.php';
require_once 'source/header.php';
require_once '../public/functions.php';

if (isset($_POST['submit'])) {
    echo $_POST['submit'];
    // ajout de isset de chaque attribut (ICI demander confirmation au prof)
    $name = htmlspecialchars(trim($_POST['name']));
    $firstName = htmlspecialchars(trim($_POST['firstName']));
    $login = htmlspecialchars(trim($_POST['login']));
    $password = htmlspecialchars(trim($_POST['password']));
    $repeatPassword = htmlspecialchars(trim($_POST['repeatPassword']));
    $birthDate = htmlspecialchars(trim($_POST['birthDate']));
    $sex = htmlspecialchars(trim($_POST['sex']));

    $userToAdd = array(
        'login' => $login,
        'password' => $password,
        'name' => $name,
        'firstname' => $firstName,
        'sex' => $sex,
        'birthDate' => $birthDate
    );
    // ICI vérifications à effectuer
    if ($login && $password && $repeatPassword) {
        if (strlen($password) >= 1) {
            if ($password == $repeatPassword) {
                // if (preg_match($loginRegex, $userToAdd['login'])) {
                //     if (preg_match('$([A-Z][a-z][0-9] -\')+$', $userToAdd['name'])) {
                //         if (preg_match('$([A-Z][a-z][0-9] -\')+$', $userToAdd['firstname'])) {
                //             if (preg_match('$([A-Z][a-z][0-9])+$', $userToAdd['birthDate'])) {
                                user_signup($userToAdd);

                                echo 'Inscription réussie';
                //             } else echo "Votre date de naissance doit être anterieure à 18 ans de la date du jour à  et des chiffres";
                //         } else echo "Votre prenom doit contenir uniquement des lettres et des chiffres";
                //     } else echo "Votre nom doit contenir uniquement des lettres et des chiffres";
                // } else echo "Votre login doit contenir uniquement des lettres et des chiffres";
            } else echo "Les mots de passe ne sont pas identiques";
        } else echo "Le mot de passe est trop court !";
    } else echo "Veuillez saisir tous les champs obligatoires !";
}

// check if user is already logged in
if (isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}
// validate a login regular expression
$loginRegex = '/^[a-zA-Z0-9]{3,20}$/';
?>


<h1>Inscription</h1>
<div class="container-fluid bg-light">
    <!-- zone de connexion -->
    <div class="row">
        <div class="col">
            <form class="container-fluid justify-content-start" action=# method="POST">

                <p>Login*</p>
                <input type="login" name="login" required="required">

                <p>Password*</p>
                <input type="password" name="password" required="required">
                <p>Répetez votre password*</p>

                <input type="password" name="repeatPassword" required="required"><br>

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