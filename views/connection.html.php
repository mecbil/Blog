<section class="conninscri">
<div class=" bg-dark text-light">

            <!-- zone de connexion -->
            
            <form action="verification.php" method="POST">
                <h1>Connexion</h1>
                
                <label><b>Nom d'utilisateur</b></label>
                <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>

                <label><b>Mot de passe</b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="password" required>

                <input class="btn btn-warning" type="submit" id='submit' value='Login' >
                <?php
                if(isset($_GET['erreur'])){
                    $err = $_GET['erreur'];
                    if($err==1 || $err==2)
                        echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
                }
                ?>
            </form>
</div>


<div class=" bg-dark text-light">

<!-- zone de connexion -->

<form action="verification.php" method="POST">
    <h1>Inscription</h1>
    
    <label><b>Nom d'utilisateur</b></label>
    <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>

    <label><b>Mot de passe</b></label>
    <input type="password" placeholder="Entrer le mot de passe" name="password" required>

    <input class="btn btn-warning" type="submit" id='submit' value='Register' >
    <?php
    if(isset($_GET['erreur'])){
        $err = $_GET['erreur'];
        if($err==1 || $err==2)
            echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
    }
    ?>
</form>
</div>
</section>


