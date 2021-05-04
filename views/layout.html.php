<?php if (isset($_SESSION['user'])) session_start();?>

<!DOCTYPE html>
<html lang="fr">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title><?= $pageTitle ?></title>
      <link rel="shortcut icon" type="image/png" href="images/logo/Reservia@3x.png"> 
      
      <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="css/style.css">
        
  </head>
  <body >
    <header>
      <nav class="navbar navbar-expand-md navbar-dark  bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Nabil MECILI </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="index.php?controller=Post&task=showposts">Blog</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="cv/MeciliNabil_CDev_CV.pdf">CV</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="index.php?controller=Contact&task=verif">Contact</a>
              </li>
              <?php if (isset($_SESSION['user'])) { ?>
                  <li class="nav-item">
                    <a class="nav-link" href="<?php session_destroy();?>" >Disconnect</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link " href="index.php?controller=User&task=connect" tabindex="-1" >Administrer</a>
                  </li>  
              <?php } else { ?>
                  <li class="nav-item">
                    <a class="nav-link" href="index.php?controller=User&task=showconnect" >Connect</a>
                  </li>  

                  
              <?php } ?>
            </ul>
            <form class="d-flex">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-light btn-warning" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>
    </header>
    <main class="container-Fluid bg-dark"  >
        <?= $pageContent ?>
    </main>
    <footer class="container-Fluid text-white bg-dark text-center">
        <p>&copy; 2021 Mecili, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a> <a href="#"><i class="fab fa-linkedin-in"></i></a> &middot; <a href="#"><i class="fab fa-github"></i></a>  &middot;  <a href="#"><i class="fas fa-users-cog"></i></a></p>
    </footer>
    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/dbbb09a020.js" crossorigin="anonymous"></script>
  </body>
</html>

