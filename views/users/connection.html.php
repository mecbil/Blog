
<section class="conninscri text-light">
    <div class="text-light col-11 col-lg-5 col-md-9 col-sm-11 mt-2">

        <!-- zone de connexion -->

        <div class="login-form">
            <?php if (isset($_SESSION['erreur'])) : ?>
                <div class="alert alert-danger">
                <?= $_SESSION['erreur'] ; ?>
                </div>
            <?php endif; ?>
            <form action="index.php?Controller=User&task=Connect" method="post">
                <h2 class="text-center">Connexion</h2>
                <div class="form-group">
                    <input type="email" name="email" value="<?php if (isset($_POST['email'])){echo $_POST['email'];} ?>" class="form-control" placeholder="Email"  autocomplete="off">
                </div>
                <div class=" form-group ">
                    <input type="password" name="password" value="<?php if (isset($_POST['password'])){echo $_POST['password'];} ?>" class="form-control" placeholder="Password"  autocomplete="off">
                </div>
                <div class=" form-group ">
                    <button type="submit" class="btn btn-warning text-light btn-block mt-2">Connexion</button>
                </div>
            </form>
        </div>
    </div>

    <!-- zone de d'enregistrement -->

    <div class="text-light col-11 col-lg-5 col-md-9 col-sm-11 mt-2">
        <div class="login-form">
            <form action="" method="post">
                <h2 class=" text-center "> Enregistrement </h2>

                <div class=" form-group ">
                    <input type="text" name="pseudo" class="form-control" placeholder="Pseudo" required="required"
                        autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Email" required="required"
                        autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password"
                        required="required" autocomplete="off">
                </div>
                <div class=" form-group ">
                    <button type=" submit " class="btn btn-warning text-light btn-block mt-2"> Enregistrer </button>
                </div>
                
            </form>
        </div>
    </div>