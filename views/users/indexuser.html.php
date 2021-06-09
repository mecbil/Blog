<section class="conninscri text-light">

  <div class="text-light col-11 col-lg-5 col-md-9 col-sm-11 pt-2">
    <!-- zone de Ajout Post blog -->
    <h1>Dashbord <?= htmlspecialchars($_SESSION['user']) ?></h1>
    <div class="">
      <?php if (!empty($erreur)): ?>
      <div class="alert alert-danger">
        <?= htmlspecialchars($erreur) ?>
      </div>
      <?php endif; ?>
            
      <form 
      <?php if ($edit == false ): ?>
        action="index.php?controller=Postcontroller&task=insertpost"
      <?php endif; ?>
      <?php if ($edit == true ): ?>
        action="index.php?controller=Postcontroller&task=updatePost"
      <?php endif; ?>

      method="post">
          <h2 class="text-center">Ajout d'un Blog Post </h2>
          <div class="form-group">
            <input type="text" name="title" value="<?php if (isset($_POST['title'])){if (is_string($_POST['title'])) echo $_POST['title'] ;} ?>" class="form-control" placeholder="Title"  autocomplete="off">
          </div>
          <div class="form-group">
            <input type="text" name="chapo" value="<?php if (isset($_POST['chapo'])){if (is_string($_POST['chapo'])) echo $_POST['chapo'];} ?>" class="form-control" placeholder="Chapo"  autocomplete="off">
          </div>
          <div class=" form-group ">
            <textarea name="content" value="" class="form-control" placeholder="Content ..."  autocomplete="off"><?php if (isset($_POST['content'])) {echo htmlspecialchars($_POST['content']);} ?></textarea>
          </div>
          <div class=" form-group ">
              <input type="text" name="author" value="<?php if (isset($_POST['author'])){echo htmlspecialchars($_POST['author']);} ?>" class="form-control" placeholder="Author"  autocomplete="off">
          </div>
          <div class=" form-group ">
              <input type="hidden" name="post_id" value="<?php if (isset($_POST['post_id'])){echo htmlspecialchars($_POST['post_id']);} ?>" class="form-control" >
          </div>
          <div class=" form-group ">
            <?php if ($edit == false ): ?>
            <button type="submit" class="btn btn-dark btn-outline-light btn-block mt-2">Valider</button>
            <?php endif; ?>
            <?php if ($edit == true ): ?>
            <button type="submit" class="btn btn-dark btn-outline-light btn-block mt-2">Modifier</button>
            <?php endif; ?>
          </div>
      </form>
    </div>
  </div>

  <div class="text-light col-11 col-lg-5 col-md-9 col-sm-11 pt-2">
    <h2 class="text-center">Gestion :</h2>
    <form action="index.php?controller=Postcontroller&task=validposts" method="post">
      <div class="form-group">
        <button type="submit" class="btn btn-dark btn-outline-light btn-block mt-2">Commentaires Non validé</button>
      </div>
      <div class="valider">
        <?php foreach ($comments as $comment) : ?>
          <br>
          <div class=""><?= $comment->getComment() ?> </div>
          <a class="btn btn-success btn-outline-light"href="delete-comment.php?uuid=<?= $comment->getUuid() ?>" >Valider</a>
        <?php endforeach ?>
      </div> 
    </form>      
  </div>
</div>