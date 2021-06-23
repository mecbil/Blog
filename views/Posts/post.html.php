<?php
if (isset($_SESSION['user'])) {
    $user = filter_var($_SESSION['user']);
    $role = filter_var($_SESSION['role']);
    $user_id = filter_var($_SESSION['user_id']);
}
?>
<div class="text-light">
    <div class="container m-2">
        <h1><?php echo($post->getTitle()) ?></h1>
        <small>Modifié le : <?php $datef= strtotime($post->getDate_modify()); echo(date('d-m-Y'.' à '.' H:i:s', $datef)) ?></small>
        <p><?php echo($post->getChapo()) ?></p>
        <p><?php echo(nl2br($post->getContent())) ?></p>
        <div >Auteur : <small class="text-warning"><?php echo($post->getAuthor()) ?></small></div>
        <?php if (!isset($user)): ?>
            <h3>Veuillez vous connecter pour réagir !</h3>
            <?php endif; ?>
        <?php if (isset($user) && $role == true ): ?>        
            <a class="btn btn-danger btn-outline-light" href="/?controller=postcontroller&task=deletePost&uuid=<?php echo($post->getUuid()) ?>" onclick="return window.confirm(`Êtes vous sûr de vouloir supprimer ce Blog Post ?!`)" tabindex="-1">Supprimer</a>
            <a class="btn btn-secoundary btn-outline-light" href="/?controller=postcontroller&task=editPost&uuid=<?= filter_input(INPUT_GET, 'uuid') ?>" tabindex="-1">Editer</a>
        <?php endif; ?>
    </div>
<hr>

<?php if (!empty($erreur)): ?>
<div class="alert alert-danger">
<?php echo($erreur) ?>
</div>
<?php endif; ?>
<?php  if (isset($user)): ?>
    <form class="m-2" action="index.php?controller=Commentcontroller&task=insertComment" method="POST">
        <h3>Réagir ? N'hésitez pas !</h3>
        <input type="text" name="pseudo" value ="<?php if (isset($user)){echo($user);} ?>"" placeholder="Votre pseudo !">
        <br>
        <textarea name="comment" cols="30" rows="2" placeholder="Votre commentaire ..."></textarea>
        <br>
        <input type="hidden" name="post_id" value ="<?php echo($post->getPost_id()) ?>">
        <input type="hidden" name="user_id" value ="<?php echo($post->getUser_id()) ?>">
        <input type="hidden" name="uuid" value ="<?php echo($post->getUuid()) ?>">
        <br>
        <button type="submit" class="btn btn-dark btn-outline-light">Commenter !</button>
    </form>
<?php endif; ?>
<div class="m-2">
    <?php if (!$comments) : ?>
        <p>Il n'y a pas encore de commentaires... SOYEZ LE PREMIER ! :D</p>
    <?php else : ?>
        <h2>Il y a déjà <?= count($comments) ?> réactions : </h2>
        <?php foreach ($comments as $commentaire) : ?>
            <h3>Commentaire de : <?php echo($commentaire->getAuthor()) ?></h3>
            <small>Le <?php echo($commentaire->getDate_modify()) ?></small>
            <blockquote>
                <em><?php echo(nl2br($commentaire->getComment())) ?></em>
            </blockquote>
            <?php if (isset($user) && $role == true): ?> 
                <a class="btn btn-danger btn-outline-light" href="/?controller=commentcontroller&task=deleteComment&uuid=<?php echo($post->getUuid()) ?>&commentid=<?php echo($commentaire->getComment_id()) ?>" onclick="return window.confirm(`Êtes vous sûr de vouloir supprimer ce commentaire ?!`)">Supprimer</a>
                <a class="btn btn-secoundary btn-outline-light" href="/?controller=commentcontroller&task=deleteComment&uuid=<?= filter_input(INPUT_GET, 'uuid') ?>" tabindex="-1">Editer</a>
            <?php endif; ?>
            <?php if (isset($user)  && $role == false && ($user_id === $commentaire->getUser_id() )): ?>
                <a class="btn btn-danger btn-outline-light" href="/?controller=commentcontroller&task=deleteComment&uuid=<?php echo($commentaire->getUuid()) ?>" onclick="return window.confirm(`Êtes vous sûr de vouloir supprimer ce commentaire ?!`)">Supprimer</a>
            <?php endif; ?>
        <?php endforeach ?>
    <?php endif ?>
</div>
</div>