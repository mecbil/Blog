<div class="text-light">
    <div class="container m-2">
        <h1><?= $post->getTitle() ?></h1>
        <small>Publié le : <?php $datef= strtotime($post->getDate_creat()); echo(date('d-m-Y'.' à '.' H:i:s', $datef)) ?></small>
        <p><?= $post->getChapo() ?></p>
        <p><?= nl2br($post->getContent()) ?></p>
        <div >Auteur : <small class="text-warning"><?= $post->getAuthor() ?></small></div>
        <?php if (!isset($_SESSION['user'])): ?>
            <h3>Veuillez vous connecter pour réagir !</h3>
            <?php endif; ?>
        <?php if (isset($_SESSION['user']) && $_SESSION['role'] == true ): ?>        
            <a class="btn btn-danger btn-outline-light" href="/?controller=postcontroller&task=deletePost&uuid=<?= $post->getUuid() ?>" onclick="return window.confirm(`Êtes vous sûr de vouloir supprimer ce Blog Post ?!`)" tabindex="-1">Supprimer</a>
            <a class="btn btn-secoundary btn-outline-light" href="/?controller=postcontroller&task=editPost&uuid=<?= filter_input(INPUT_GET, 'uuid') ?>" tabindex="-1">Editer</a>
        <?php endif; ?>
    </div>
<hr>

<?php if (!empty($erreur)): ?>
<div class="alert alert-danger">
<?= $erreur ?>
</div>
<?php endif; ?>
<?php if (isset($_SESSION['user'])): ?>
    <form class="m-2" action="index.php?controller=Commentcontroller&task=insertComment" method="POST">
        <h3>Réagir ? N'hésitez pas !</h3>
        <input type="text" name="pseudo" value ="<?php if (isset($_SESSION['user'])){echo $_SESSION['user'];} ?>"" placeholder="Votre pseudo !">
        <br>
        <textarea name="comment" cols="30" rows="2" placeholder="Votre commentaire ..."></textarea>
        <br>
        <input type="hidden" name="post_id" value ="<?= $post->getPost_id() ?>">
        <input type="hidden" name="user_id" value ="<?= $_SESSION['user_id'] ?>">
        <input type="hidden" name="uuid" value ="<?= $post->getUuid() ?>">
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
            <h3>Commentaire de : <?= $commentaire->getAuthor() ?></h3>
            <small>Le <?= $commentaire->getDate_modify() ?></small>
            <blockquote>
                <em><?= nl2br($commentaire->getComment()) ?></em>
            </blockquote>
            <?php if (isset($_SESSION['user']) && $_SESSION['role'] == true): ?> 
                <a class="btn btn-danger btn-outline-light" href="/?controller=commentcontroller&task=deleteComment&uuid=<?= $post->getUuid() ?>&commentid=<?= $commentaire->getComment_id() ?>" onclick="return window.confirm(`Êtes vous sûr de vouloir supprimer ce commentaire ?!`)">Supprimer</a>
                <a class="btn btn-secoundary btn-outline-light" href="/?controller=commentcontroller&task=deleteComment&uuid=<?= filter_input(INPUT_GET, 'uuid') ?>" tabindex="-1">Editer</a>
            <?php endif; ?>
            <?php if (isset($_SESSION['user'])  && $_SESSION['role'] == false && ($_SESSION['user_id'] === $commentaire->getUser_id() )): ?>
                <a class="btn btn-danger btn-outline-light" href="/?controller=commentcontroller&task=deleteComment&uuid=<?= $commentaire->getUuid() ?>" onclick="return window.confirm(`Êtes vous sûr de vouloir supprimer ce commentaire ?!`)">Supprimer</a>
            <?php endif; ?>
        <?php endforeach ?>
    <?php endif ?>
</div>
</div>