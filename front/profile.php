<?php
session_start();
require_once 'source/head.php';
require_once 'source/header.php';
require_once '../public/functions.inc.php';

$error = false;

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
} 
// else {
    // if user is not logged in, redirect to index.php:
    // echo '<script type="text/javascript">window.location.href = "index.php";</script>';
// }

if (isset($_POST['change'])) {
    $login = htmlspecialchars(trim($user['login']));
    $password = htmlspecialchars(trim($_POST['password']));
    $name = htmlspecialchars(trim($_POST['name']));
    $firstName = htmlspecialchars(trim($_POST['firstName']));
    $sex = htmlspecialchars(trim($_POST['sex']));
    $birthDate = htmlspecialchars(trim($_POST['birthDate']));

    $new_values = array(
        'login' => $login,
        'password' => $password,
        'name' => $name,
        'firstName' => $firstName,
        'sex' => $sex,
        'birthDate' => $birthDate
    );

    $update_status = validate_format($new_values);

    if ($update_status === true) {
        modify_user($new_values);
    } else {
        $error = true;
    }
}
?>
<h1>Inscription</h1>
<div class="container-fluid bg-light">
    <!-- zone de connexion -->
    <div class="row">
        <div class="col">
            <form class="container-fluid justify-content-start" method="POST">

                <p>Login *</p>
                <input disabled type="login" name="login" required="required" value="<?php echo $user['login'] ?>">

                <p>Password</p>
                <input type="password" name="password" value="">

                <p>Nom</p>
                <input type="text" name="name" value="<?php echo $user['firstName'] ?>">

                <p>Prenom</p>
                <input type="text" name="firstName" value="<?php echo $user['name'] ?>">

                <p>Date de naissance</p>
                <input type="date" name="birthDate" value="<?php echo $user['birthDay'] ?>">

                <p>Sexe</p>
                <input type="radio" name="sex" value="male" checked value="<?php echo $user['sex'] ?>">
                <label for="male">Homme</label>

                <input type="radio" name="sex" value="female" value="<?php echo $user['sex'] ?>">
                <label for="female">Femme</label>

                <input type="submit" name="change" onclick="" value="modifier">

                <div id="error">
                    <?php if ($error) echo $update_status; ?>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
require_once 'source/footer.php';
?>