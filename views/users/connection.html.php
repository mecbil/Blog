<section class="conninscri text-light">
    <div class="text-light col-11 col-lg-5 col-md-9 col-sm-11 pt-5">

        <!-- zone de connexion -->
        <div class="login-form">
            <?php if (!empty($variables['erreur'])): ?>
            <div class="alert alert-danger">
            <?= $variables['erreur'] ?>
            </div>
            <?php endif; ?>
           
            <form action="index.php?controller=UserController&task=connect" method="post">
                <h2 class="text-center">Connexion</h2>
                <div class="form-group">
                    <input type="email" name="gemailconnect" value="<?= $variables['gemailconnect'] ?>" class="form-control" placeholder="Adresse mail"  autocomplete="off">
                </div>
                <div class=" form-group ">
                    <input type="password" name="gpasswordconnect" value="<?= $variables['gpasswordconnect'] ?>" class="form-control" placeholder="Mot de passe" title="Minimum 8 caractères avec au moin une lettre Majuscule et une miniscule et un caractère special " autocomplete="off">
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

            <?php if (!empty($variables['erreurAdd'])): ?>
            <div class="alert alert-danger">
            <?= $variables['erreurAdd'] ?>
            </div>
            <?php endif; ?>

            <form action="index.php?controller=UserController&task=insertUser" method="post">
                <h2 class=" text-center "> Enregistrement </h2>

                <div class=" form-group ">
                    <input type="text" name="gpseudo" value="<?= $variables['gpseudo']  ?>" class="form-control" placeholder="Pseudo" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="text" name="gmail" value="<?= $variables['gmail'] ?>" class="form-control" placeholder="Adresse mail" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="password" name="gpassword" value="<?= $variables['gpassword'] ?>" class="form-control" placeholder="Mot de passe" title="Minimum 8 caractères avec au moin une lettre Majuscule et une miniscule et un caractère special " autocomplete="off">
                </div>
                <div class=" form-group ">
                    <button type=" submit " class="btn btn-dark btn-outline-light btn-block mt-2"> Enregistrer </button>
                </div>                
            </form>
        </div>
    </div>
</section>>