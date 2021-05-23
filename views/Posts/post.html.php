<div class="text-light">
    <div class="container m-2">
        <h1><?= $post->title ?></h1>
        <small>Publié le : <?php $datef= strtotime($post->date_creat); echo(date('d-m-Y'.' à '.' H:i:s', $datef)) ?></small>
        <p><?= $post->chapo ?></p>
        <p><?= $post->content ?></p>
        <div class="text-warning"><?= $post->author ?></div>
    </div>
<hr>
<form action="save-comment.php" method="POST">
    <h3>Vous voulez réagir ? N'hésitez pas !</h3>
    <input type="text" name="" placeholder="Votre pseudo !">
    <br>
    <textarea name="content" id="" cols="30" rows="2" placeholder="Votre commentaire ..."></textarea>
    <input type="hidden" name="article_id" value="<?= $article_id ?>">
    <br>
    <button>Commenter !</button>
</form>

<?php if (!$comments) : ?>
    <h2>Il n'y a pas encore de commentaires pour cet article ... SOYEZ LE PREMIER ! :D</h2>
<?php else : ?>
    <h2>Il y a déjà <?= count($comments) ?> réactions : </h2>
    <?php foreach ($comments as $commentaire) : ?>
        <h3>Commentaire de : <?= $commentaire->Author ?></h3>
        <small>Le <?= $commentaire->date ?></small>
        <blockquote>
            <em><?= $commentaire->comment ?></em>
        </blockquote>
        <a href="delete-comment.php?uuid=<?= $commentaire->uuid ?>" onclick="return window.confirm(`Êtes vous sûr de vouloir supprimer ce commentaire ?!`)">Supprimer</a>
    <?php endforeach ?>
<?php endif ?>
</div>
