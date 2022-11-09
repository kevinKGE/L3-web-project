<?php
require_once 'source/head.php';
require_once 'source/header.php';
require_once '../public/functions.php';
require_once '../public/users.inc.php';
require_once '../public/users.inc.php';

if (isset($_POST['submit'])) {
    echo $_POST['submit'];
    $name = htmlspecialchars(trim($_POST['name']));
    $firstName = htmlspecialchars(trim($_POST['firstName']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    $repeatPassword = htmlspecialchars(trim($_POST['repeatPassword']));
    $birthDate = htmlspecialchars(trim($_POST['birthDate']));
    $sex = htmlspecialchars(trim($_POST['sex']));

    $userToAdd = array(
        'name' => $name,
        'firstname' => $firstName,
        'email' => $email,
        'password' => $password,
        'sex' => $sex,
        'birthDate' => $birthDate
    );

    if ($email && $password && $repeatPassword) {
        if (strlen($password) >= 1) { // ICI 6
            if ($password == $repeatPassword) {

                // Hash password
                //$password = md5($password);

                //var_dump($users);
                user_signup($users, $userToAdd);
                
            } else echo "Les mots de passe ne sont pas identiques";
        } else echo "Le mot de passe est trop court !";
    } else echo "Veuillez saisir tous les champs obligatoires !";
}

?>

<h1>Inscription</h1>
<div class="container-fluid bg-light">
    <!-- zone de connexion -->
    <div class="row">
        <div class="col">
            <form class="container-fluid justify-content-start" action=# method="POST">
                <p>Nom</p>
                <input type="text" name="name">

                <p>Prenom</p>
                <input type="text" name="firstName">

                <p>email*</p>
                <input type="email" name="email" required="required">

                <p>Password*</p>
                <input type="password" name="password" required="required">
                <p>Répetez votre password*</p>

                <input type="password" name="repeatPassword" required="required"><br>

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