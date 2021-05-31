<section class="conninscri text-light">
    <div class="text-light col-11 col-lg-5 col-md-9 col-sm-11 pt-5">

        <!-- zone de connexion -->
        <div class="login-form">
            <?php if (!empty($erreur)): ?>
            <div class="alert alert-danger">
            <?= $erreur ?>
            </div>
            <?php endif; ?>
           
            <form action="index.php?controller=UserController&task=connect" method="post">
                <h2 class="text-center">Connexion</h2>
                <div class="form-group">
                    <input type="email" name="email" value="<?php if (isset($_POST['email'])){echo $_POST['email'];} ?>" class="form-control" placeholder="Email"  autocomplete="off">
                </div>
                <div class=" form-group ">
                    <input type="password" name="password" value="<?php if (isset($_POST['password'])){echo $_POST['password'];} ?>" class="form-control" placeholder="Password"  autocomplete="off">
                </div>
                <div class=" form-group ">
                    <button type="submit" class="btn btn-dark btn-outline-light btn-block mt-2">Connexion</button>
                </div>
            </form>
        </div>
    </div>

    <!-- zone de d'enregistrement -->
    <div class="text-light col-11 col-lg-5 col-md-9 col-sm-11 mt-5">
        <div class="login-form">

            <?php if (!empty($erreurAdd)): ?>
            <div class="alert alert-danger">
            <?= $erreurAdd ?>
            </div>
            <?php endif; ?>

            <form action="index.php?controller=UserController&task=insertUser" method="post">
                <h2 class=" text-center "> Enregistrement </h2>

                <div class=" form-group ">
                    <input type="text" name="pseudo" value="<?php if (isset($_POST['pseudo'])){echo $_POST['pseudo'];} ?>" class="form-control" placeholder="Pseudo" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="text" name="email" value="<?php if (isset($_POST['email'])){echo $_POST['email'];} ?>" class="form-control" placeholder="Email" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="password" name="password" value="<?php if (isset($_POST['password'])){echo $_POST['password'];} ?>" class="form-control" placeholder="Password" autocomplete="off">
                </div>
                <div class=" form-group ">
                    <button type=" submit " class="btn btn-dark btn-outline-light btn-block mt-2"> Enregistrer </button>
                </div>
                
            </form>
        </div>
    </div>