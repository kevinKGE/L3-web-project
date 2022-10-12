<?php
require_once 'source/head.php';
require_once 'source/header.php';

if (isset($_POST['submit'])) {

    $name = htmlspecialchars(trim($_POST['Nom']));
    $firstName = htmlspecialchars(trim($_POST['Prenom']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    $repeatPassword = htmlspecialchars(trim($_POST['repeatpassword']));

    if ($name && $firstName && $email && $password && $repeatpassword) {
        if (strlen($password) >= 6) {
            if ($password == $repeatpassword) {
                // On crypte le mot de passe
                $password = md5($password);

                // on se connecte à MySQL et on sélectionne la base
                $c = new mysqli("localhost", "root", "", "ecobank");

                //On créé la requête
                $sql = "INSERT INTO newclient VALUES ('','$Nom','$Prenom','email','$password')";

                // On envoie la requête
                $res = $c->query($sql);
                // on ferme la connexion
                mysqli_close($c);
            } else echo "Les mots de passe ne sont pas identiques";
        } else echo "Le mot de passe est trop court !";
    } else echo "Veuillez saisir tous les champs !";
}

?>

<h1>Inscription</h1>
<div class="container-fluid bg-light">
    <!-- zone de connexion -->
    <div class="row">
        <div class="col">
            <form class="container-fluid justify-content-start" action="./login.php" method="POST">
                <p>Nom</p>
                <input type="text" name="name">

                <p>Prenom</p>
                <input type="text" name="firstName">

                <p>email*</p>
                <input type="email" name="email" required="required">

                <p>Password*</p>
                <input type="password" name="password" required="required">
                <p>Répetez votre password*</p>

                <input type="password" name="repeatpassword" required="required"><br>

                <p>Date de naissance</p>
                <input type="date" name="password" required="required">

                <p>Sexe</p>
                <input type="radio" name="sexe" value="homme" checked>
                <label for="huey">Homme</label>

                <input type="radio" name="sexe" value="femme">
                <label for="dewey">Femme</label>

                <input type="submit" name="submit" value="Valider">

            </form>
        </div>
    </div>
</div>

<?php
require_once 'source/footer.php';
?>