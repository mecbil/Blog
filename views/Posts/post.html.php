<?php
if (\session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<div class="text-light">
    <div class="container m-2">
        <h1><?= $post->title ?></h1>
        <small>Publié le : <?php $datef= strtotime($post->date_creat); echo(date('d-m-Y'.' à '.' H:i:s', $datef)) ?></small>
        <p><?= $post->chapo ?></p>
        <p><?= nl2br($post->content) ?></p>
        <div class="text-warning"><?= $post->author ?></div>
        <?php if (isset($_SESSION['user']) && $_SESSION['role'] == true ): ?>
        
                <a class="btn btn-danger btn-outline-light" href="/?controller=postcontroller&task=deletePost&uuid=<?= $_GET['uuid'] ?>" onclick="return window.confirm(`Êtes vous sûr de vouloir supprimer ce commentaire ?!`)" tabindex="-1">Supprimer</a>
        <?php endif; ?>
    </div>
<hr>

<?php if (!empty($erreur)): ?>
<div class="alert alert-danger">
<?= $erreur ?>
</div>
<?php endif; ?>

<form action="index.php?controller=Commentcontroller&task=insertComment" method="POST">
    <h3>Vous voulez réagir ? N'hésitez pas !</h3>
    <input type="text" name="pseudo" value ="<?php if (isset($_SESSION['user'])){echo $_SESSION['user'];} ?>"" placeholder="Votre pseudo !">
    <br>
    <textarea name="comment" cols="30" rows="2" placeholder="Votre commentaire ..."></textarea>
    <br>
    <input type="hidden" name="id" value ="<?= $post->id ?>">
    <input type="hidden" name="userid" value ="<?= $_SESSION['userid'] ?>">
    <button>Commenter !</button>
</form>

<?php if (!$comments) : ?>
    <h2>Il n'y a pas encore de commentaires pour cet article ... SOYEZ LE PREMIER ! :D</h2>
<?php else : ?>
    <h2>Il y a déjà <?= count($comments) ?> réactions : </h2>
    <?php foreach ($comments as $commentaire) : ?>
        <h3>Commentaire de : <?= $commentaire->author ?></h3>
        <small>Le <?= $commentaire->date_modify ?></small>
        <blockquote>
            <em><?= $commentaire->comment ?></em>
        </blockquote>
        <a href="delete-comment.php?uuid=<?= $commentaire->uuid ?>" onclick="return window.confirm(`Êtes vous sûr de vouloir supprimer ce commentaire ?!`)">Supprimer</a>
    <?php endforeach ?>
<?php endif ?>
</div>
