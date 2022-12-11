<?php
session_start();
require_once 'source/head.php';
require_once 'source/header.php';
require_once '../public/functions.inc.php';

$error = false;

// Put the user information session into a variable
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
} 


if (isset($_POST['change'])) {
    // Put the user informations into variables
    $login = htmlspecialchars(trim($user['login']));
    $password = htmlspecialchars(trim($_POST['password']));
    $name = htmlspecialchars(trim($_POST['name']));
    $firstName = htmlspecialchars(trim($_POST['firstName']));
    $sex = htmlspecialchars(trim($_POST['sex']));
    $birthDate = htmlspecialchars(trim($_POST['birthDate']));

    // built a array with the new values
    $new_values = array(
        'login' => $login,
        'password' => $password,
        'name' => $name,
        'firstName' => $firstName,
        'sex' => $sex,
        'birthDate' => $birthDate
    );

    // check if the new values are valid
    $update_status = validate_format($new_values);

    // if the new values are valid, update the user
    if ($update_status === true) {
        modify_user($new_values);
    } else {
        $error = true;
    }
}
?>
<h1>Inscription</h1>
<div class="container-fluid bg-light">
    <div class="row">
        <div class="col">
            <form class="container-fluid justify-content-start" method="POST">

                <p>Login *</p>
                <input disabled type="text" name="login" required="required" value="<?php if(isset($user['login'])){echo $user['login'];} ?>">

                <p>Password</p>
                <input type="password" name="password" value="">

                <p>Nom</p>
                <input type="text" name="name" value="<?php if(isset($user['firstName'])){echo $user['firstName'];} ?>">

                <p>Prenom</p>
                <input type="text" name="firstName" value="<?php if(isset($user['name'])){echo $user['name'];} ?>">

                <p>Date de naissance</p>
                <input type="date" name="birthDate" value="<?php if(isset($user['birthDay'])){echo $user['birthDay'];} ?>">

                <p>Sexe</p>
                <input type="radio" name="sex" checked value="<?php if(isset($user['sex'])){echo $user['sex'];} ?>">
                <label>Homme</label>

                <input type="radio" name="sex" value="<?php if(isset($user['sex'])){echo $user['sex'];} ?>">
                <label>Femme</label>

                <input type="submit" name="change" onclick="" value="modifier">

                <div id="error">
                    <?php if ($error){ echo $update_status; } ?>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
require_once 'source/footer.php';
?>