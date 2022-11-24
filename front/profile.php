<?php
require_once 'source/head.php';
require_once 'source/header.php';
require_once '../public/functions.php';

?>

<h1>Inscription</h1>
<div class="container-fluid bg-light">
    <!-- zone de connexion -->
    <div class="row">
        <div class="col">
            <form class="container-fluid justify-content-start" action=# method="POST">

                <p>Login*</p>
                <input type="login" name="login" required="required" value="<?php $_SESSION('login')?>>

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

                <input type="submit" name="submit" onclick="" value="modifier">

            </form>
        </div>
    </div>
</div>

<?php
require_once 'source/footer.php';
?>