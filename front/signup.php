<?php
require_once 'source/head.php';
require_once 'source/header.php';
require_once '../public/functions.inc.php';
require_once '../public/regex.inc.php';

$error = false;
$sign_up_done = false;


if (isset($_POST['submit'])) {
    // put the user informations into variables
    $name = htmlspecialchars(trim($_POST['name']));
    $firstName = htmlspecialchars(trim($_POST['firstName']));
    $login = htmlspecialchars(trim($_POST['login']));
    $password = htmlspecialchars(trim($_POST['password']));
    $birthDate = htmlspecialchars(trim($_POST['birthDate']));
    $sex = htmlspecialchars(trim($_POST['sex']));

    // hash of password
    $password = sha1($password, false);

    // array of user to add
    $userToAdd = array(
        'login' => $login,
        'password' => $password,
        'name' => $name,
        'firstName' => $firstName,
        'sex' => $sex,
        'birthDate' => $birthDate
    );

    // check the validation of the user to add
    $sign_up_status = validate_format($userToAdd);

    // if validation is ok, add user:
    if ($sign_up_status === "ok") {
        user_signup($userToAdd);
        $sign_up_done = true;
    } else { // else, display error:
        $error = true;
    }
}

?>

<h1>Inscription</h1>
<div class="container-fluid bg-light">
    <div class="row">
        <div class="col">
            <form class="container-fluid justify-content-start" action=# method="POST">

                <p>Login *</p>
                <input type="text" name="login" required="required">

                <p>Password *</p>
                <input type="password" name="password" required="required">

                <p>Nom</p>
                <input type="text" name="name">

                <p>Prenom</p>
                <input type="text" name="firstName">

                <p>Date de naissance</p>
                <input type="date" name="birthDate">

                <p>Sexe</p>
                <input type="radio" name="sex" value="male" checked>
                <label>Homme</label>

                <input type="radio" name="sex" value="female">
                <label>Femme</label>

                <input type="submit" name="submit" onclick="user_signup($_POST)" value="inscription">

                <div id="error">
                    <?php if($error) {echo $sign_up_status; } ?>
                </div>

            </form>
        </div>
    </div>
</div>

<?php
require_once 'source/footer.php';
?>