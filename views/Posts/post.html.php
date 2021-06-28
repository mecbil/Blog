<div class="text-light">
    <div class="container m-2">
        <h1 class="text-warning"><?= $post->getTitle() ?></h1>
        
        <p class='changefont'><?= $post->getChapo() ?></p>
        <p class='changefont'><?= nl2br($post->getContent()) ?></p>
        <small>Modifié le : <?php $datef= strtotime($post->getDate_modify()); echo(date('d-m-Y'.' à '.' H:i:s', $datef)) ?></small>
        <div >Auteur : <small class="text-warning"><?= $post->getAuthor() ?></small></div>
        <?php if (!isset($user)): ?>
            <h3>Veuillez vous connecter pour réagir !</h3>
            <?php endif; ?>
        <?php if (isset($user) && $role == true ): ?>        
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
<?php  if (isset($user)): ?>
    <form class="m-2" action="index.php?controller=Commentcontroller&task=insertComment" method="POST">
        <h3>Réagir ? N'hésitez pas !</h3>
        <input type="text" name="pseudo" value ="<?= $user ?>"" placeholder="Votre pseudo !">
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
            
            <blockquote>
                <br>
                <h3 class='changefont'><?= nl2br($commentaire->getComment()) ?></h3>
            </blockquote>            
            <small>Le <?= $commentaire->getDate_modify() ?></small>

            <div>Auteur : <small class="text-warning"><?= $commentaire->getAuthor() ?></small></div>
            <?php if (isset($user) && $role == true): ?> 
                <a class="btn btn-danger btn-outline-light" href="/?controller=commentcontroller&task=deleteComment&uuid=<?= $post->getUuid() ?>&commentid=<?= $commentaire->getComment_id() ?>" onclick="return window.confirm(`Êtes vous sûr de vouloir supprimer ce commentaire ?!`)">Supprimer</a>
            <?php endif; ?>
            <?php if (isset($user)  && $role == Null && ($user_id === $commentaire->getUser_id() )): ?>
                <a class="btn btn-danger btn-outline-light" href="/?controller=commentcontroller&task=deleteComment&uuid=<?= $commentaire->getUuid() ?>" onclick="return window.confirm(`Êtes vous sûr de vouloir supprimer ce commentaire ?!`)">Supprimer</a>
            <?php endif; ?>
        <?php endforeach ?>
    <?php endif ?>
</div>
</div>