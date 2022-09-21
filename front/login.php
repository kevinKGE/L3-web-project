<?php
require_once 'source/header.php';
?>

<div class="container-fluid bg-secondary">
    <div class="row">
        <div class="col">
            <form action="./login.php" method="POST">
                <h1 class="text-white">Connexion</h1>

                <label for="email"><b>Nom d'utilisateur *</b></label>
                <input class="form-control" type="email" placeholder="Entrer l'email utilisateur" name="email" required>

                <label for="password"><b>Mot de passe *</b></label>
                <input class="form-control" type="text" placeholder="Entrer le mot de passe" name="password" required>

                <input class="btn btn-primary" type="submit" id='submit' value='CONNEXION'>
            </form>
        </div>
    </div>
</div>

<?php
require_once 'source/footer.php';
?>