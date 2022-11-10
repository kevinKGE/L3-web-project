<header>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <form class="container-fluid justify-content-start">
                <button class="btn btn-outline-success me-2" type="button">Navigation</button>
                <button class="btn btn-outline-success me-2" type="button">Recettes <i class="bi bi-heart-fill"></i></button>
            </form>
            <form class="d-flex" role="search">
                <label class="">Recette : </label>
                <input class="form-control me-2" type="search" placeholder="" aria-label="Search">
                <button class="btn btn-outline-success" type="submit"><i class="bi bi-search"></i></button>
            </form>
            <?php
            if (isset($_SESSION['login'])) { ?>
                <form class="container-fluid justify-content-start">
                    <button class="btn btn-outline-success me-2" type="button" onclick="window.location.href='./login.php'">Profile</button>
                    <button class="btn btn-outline-success me-2" type="button" onclick="window.location.href='./login.php'">Se déconnecter</button>
                </form>
            <?php
            } else {?>
            <form class="container-fluid justify-content-start">
                <label>Login</label>
                <input></input>
                <label>Mot de passe </label>
                <input></input>
                <button class="btn btn-outline-success me-2" type="button" onclick="window.location.href='./login.php'">Connexion</button>
                <button class="btn btn-outline-success me-2" type="button" onclick="window.location.href='./signup.php'">S'inscrire</button>
            </form>
            <?php
            }
            ?>
        </div>
    </nav>
</header>