<section class="conninscri text-light">
    <!-- zone de contact -->
    <div class="text-light col-11 col-lg-8 col-md-9 col-sm-11 pt-4">
        <div class="login-form">
            <?php if (!empty($erreur)): ?>
                <div class="alert alert-danger">
                    <?= $erreur ?>
                </div>
            <?php endif; ?>
           
            <form action="index.php?controller=ContactController&task=submitMail" method="post">
                <h2 class="text-center">Nous contacter</h2>
                <div class="form-group">
                    <input type="text" name="nom" value="<?php if (isset($_POST['nom'])) {echo $_POST['nom'];} ?>" class="form-control" placeholder="Name"  autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="text" name="prenom" value="<?php if (isset($_POST['prenom'])) {echo $_POST['prenom'];} ?>" class="form-control" placeholder="First name"  autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="texemailt" name="email" value="<?php if (isset($_POST['email'])) {echo $_POST['email'];} ?>" class="form-control" placeholder="Email"  autocomplete="off">
                </div>
                <br>
                <div class="form-group">
                    <input type="text" name="sujet" value="<?php if (isset($_POST['sujet'])) {echo $_POST['sujet'];} ?>" class="form-control" placeholder="Subject"  autocomplete="off">
                </div>
                <div class=" form-group ">
                    <textarea name="msg" value="<?php if (isset($_POST['msg'])) {echo $_POST['msg'];} ?>" class="form-control" placeholder="Your message"  autocomplete="off"></textarea>
                </div>
                <div class=" form-group ">
                    <button type="submit" class="btn btn-dark btn-outline-light btn-block mt-2">Envoyer le Mail</button>
                </div>
            </form>
        </div>
    </div>
</section>