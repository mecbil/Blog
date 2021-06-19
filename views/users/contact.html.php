<section class="conninscri text-light">
    <!-- zone de contact -->
    <div class="text-light col-11 col-lg-8 col-md-9 col-sm-11 pt-4">
        <div class="login-form">
            <?php if (!empty($erreur)): ?>
                <div class="alert alert-danger">
                    <?php print_r($erreur) ?>
                </div>
            <?php endif; ?>
           
            <form action="index.php?controller=ContactController&task=submitMail" method="post">
                <h2 class="text-center">Nous contacter</h2>
                <div class="form-group">
                    <input type="text" name="nom" value="<?php $nom = filter_input(INPUT_POST, 'nom'); if (isset($nom)) {echo $nom ;} ?>" class="form-control" placeholder="Votre Nom"  autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="text" name="prenom" value="<?php $prenom = filter_input(INPUT_POST, 'prenom'); if (isset($prenom)) {echo $prenom;} ?>" class="form-control" placeholder="Votre prénom"  autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="texemailt" name="email" value="<?php $email = filter_input(INPUT_POST, 'email'); if (isset($email)) {echo $email;} ?>" class="form-control" placeholder="Adrese mail"  autocomplete="off">
                </div>
                <br>
                <div class="form-group">
                    <input type="text" name="sujet" value="<?php $sujet = filter_input(INPUT_POST, 'sujet'); if (isset($sujet)) {echo $sujet;} ?>" class="form-control" placeholder="Votre sujet"  autocomplete="off">
                </div>
                <div class=" form-group ">
                    <textarea name="msg" value="<?php $msg = filter_input(INPUT_POST, 'msg');  if (isset($msg)) {echo $msg ;} ?>" class="form-control" placeholder="Votre message"  autocomplete="off"></textarea>
                </div>
                <div class=" form-group ">
                    <button type="submit" class="btn btn-dark btn-outline-light btn-block mt-2">Envoyer le Mail</button>
                </div>
            </form>
        </div>
    </div>
</section>