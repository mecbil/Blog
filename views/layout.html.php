<?php
if (\session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?></title>
    <link rel="shortcut icon" type="image/png" href="images/mn.png">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Charm&family=Lato&display=swap" rel="stylesheet">
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <header>
        <nav class="navbar navbar-expand-md navbar-dark  bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Nabil MECILI </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link <?php if($_SERVER['REQUEST_URI'] == "/"){echo 'active';} ?>" aria-current="page" href="/">Acceuil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if($_SERVER['REQUEST_URI'] == "/index.php?controller=MainController&task=showPosts"){echo 'active';} ?>" href="index.php?controller=MainController&task=showPosts">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if($_SERVER['REQUEST_URI'] == "index.php"){echo 'active';} ?>" href="cv/MeciliNabil_CDev_CV.pdf " target='_blanck'>CV</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if($_SERVER['REQUEST_URI'] == "/index.php?controller=ContactController&task=verif"){echo 'active';} ?>" href="index.php?controller=MainController&task=showContact">Contact</a>
                        </li>
                        <?php if (isset($_SESSION['user'])): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if($_SERVER['REQUEST_URI'] == "/index.php?controller=UserController&task=disconnect"){echo 'active';} ?>" href="index.php?controller=UserController&task=disconnect">Disconnect</a>
                        </li>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['user']) && $_SESSION['role'] == true ): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if($_SERVER['REQUEST_URI'] == "/index.php?controller=UserController&task=showConnect"){echo 'active';} ?>" href="index.php?controller=UserController&task=showConnect" tabindex="-1">Administrer</a>
                        </li>
                        <?php endif; ?>
                        <?php if (!isset($_SESSION['user'])): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if($_SERVER['REQUEST_URI'] == "/index.php?controller=UserController&task=showConnect"){echo 'active';} ?>" href="index.php?controller=UserController&task=showConnect">Connect</a>
                        </li>
                        <?php endif; ?>
                    </ul>
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-dark btn-outline-light" type="submit">Rechercher</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>
    <main class="container-Fluid bg-dark">
      <?= "{$pageContent}" ?>
    </main>
    <footer class="container-Fluid text-white bg-dark text-center">
      <p>&copy; 2021 Mecili, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a> 
      <a href="https://www.linkedin.com/in/nabil-mecili-3b0b7527" target="_blank"><i class="fab fa-linkedin-in"></i></a> &middot; <a href="https://github.com/mecbil/" target="_blank"><i class="fab fa-github"></i></a> &middot; <a href="/index.php?controller=UserController&task=showConnect"><i class="fas fa-users-cog"></i></a></p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" ></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" ></script>
    <script src="https://kit.fontawesome.com/dbbb09a020.js" crossorigin="anonymous"></script>
</body>

</html>