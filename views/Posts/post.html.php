<div class="text-light">
    <div class="container m-2">
        <h1><?= $post['title'] ?></h1>
        <small>Ecrit le : <?= $post['date'] ?></small>
        <p><?= $post['chapo'] ?></p>
        <?= $post['content'] ?>
    </div>
<hr>
<form action="save-comment.php" method="POST">
    <h3>Vous voulez réagir ? N'hésitez pas les bros !</h3>
    <input type="text" name="author" placeholder="Votre pseudo !">
    <textarea name="content" id="" cols="30" rows="10" placeholder="Votre commentaire ..."></textarea>
    <input type="hidden" name="article_id" value="<?= $article_id ?>">
    <button>Commenter !</button>
</form>

<?php if (count($commentaires) === 0) : ?>
    <h2>Il n'y a pas encore de commentaires pour cet article ... SOYEZ LE PREMIER ! :D</h2>
<?php else : ?>
    <h2>Il y a déjà <?= count($commentaires) ?> réactions : </h2>
    <?php foreach ($commentaires as $commentaire) : ?>
        <h3>Commentaire de <?= $commentaire['author'] ?></h3>
        <small>Le <?= $commentaire['created_at'] ?></small>
        <blockquote>
            <em><?= $commentaire['content'] ?></em>
        </blockquote>
        <a href="delete-comment.php?id=<?= $commentaire['id'] ?>" onclick="return window.confirm(`Êtes vous sûr de vouloir supprimer ce commentaire ?!`)">Supprimer</a>
    <?php endforeach ?>
<?php endif ?>
</div>
