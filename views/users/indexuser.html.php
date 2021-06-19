<section class="conninscri text-light">

  <div class="text-light col-11 col-lg-5 col-md-9 col-sm-11 pt-2">
    <!-- zone de Ajout Post blog -->
    <h1>Tableau de bord : <?php print_r($_SESSION['user']) ?></h1>
    <div class="">
      <?php if (!empty($erreur)): ?>
      <div class="alert alert-danger">
        <?php print_r($erreur) ?>
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
      <?php if ($edit == false ): ?>
          <h2 class="text-center">Ajout d'un Blog Post </h2>
          <div class="form-group">
            <input type="text" name="title" value="<?php $title = filter_input(INPUT_POST, 'title'); if (isset($title)){ print_r($title) ;} ?>" class="form-control" placeholder="Title"  autocomplete="off">
          </div>
          <div class="form-group">
            <input type="text" name="chapo" value="<?php $chapo = filter_input(INPUT_POST, 'chapo'); if (isset($chapo)){ print_r($chapo) ;} ?>" class="form-control" placeholder="Chapo"  autocomplete="off">
          </div>
          <div class=" form-group ">
            <textarea name="content" value="" class="form-control" placeholder="Content ..."  autocomplete="off"><?php $content = filter_input(INPUT_POST, 'content'); if (isset($content)) {print_r($content);} ?></textarea>
          </div>
          <div class=" form-group ">
              <input type="text" name="author" value="<?php $author = filter_input(INPUT_POST, 'author'); if (isset($author)){ print_r($author);} ?>" class="form-control" placeholder="Author"  autocomplete="off">
          </div>
          <div class=" form-group ">
              <input type="hidden" name="post_id" value="<?php $post_id = filter_input(INPUT_POST, 'post_id'); if (isset($post_id)) { print_r($post_id);} ?>" class="form-control" >
          </div>
          <div class=" form-group ">
            <?php if ($edit == false ): ?>
            <button type="submit" class="btn btn-dark btn-outline-light btn-block mt-2">Valider</button>
            <?php endif; ?>
            <?php if ($edit == true ): ?>
            <button type="submit" class="btn btn-dark btn-outline-light btn-block mt-2">Modifier</button>
            <?php endif; ?>
          </div>
        <?php endif; ?>
        <?php if ($edit == true ): ?>
          <h2 class="text-center">Ajout d'un Blog Post </h2>
          <div class="form-group">
            <input type="text" name="title" value="<?php print_r($post->getTitle()) ; ?>" class="form-control" placeholder="Title"  autocomplete="off">
          </div>
          <div class="form-group">
            <input type="text" name="chapo" value="<?php print_r($post->getChapo()) ; ?>" class="form-control" placeholder="Chapo"  autocomplete="off">
          </div>
          <div class=" form-group ">
            <textarea name="content" value="" class="form-control" placeholder="Content ..."  autocomplete="off"><?php print_r($post->getcontent()); ?></textarea>
          </div>
          <div class=" form-group ">
              <input type="text" name="author" value="<?php print_r($post->getAuthor()); ?>" class="form-control" placeholder="Author"  autocomplete="off">
          </div>
          <div class=" form-group ">
              <input type="hidden" name="post_id" value="<?php print_r($post->getPost_id()); ?>" class="form-control" >
          </div>
          <div class=" form-group ">
            <?php if ($edit == false ): ?>
            <button type="submit" class="btn btn-dark btn-outline-light btn-block mt-2">Valider</button>
            <?php endif; ?>
            <?php if ($edit == true ): ?>
            <button type="submit" class="btn btn-dark btn-outline-light btn-block mt-2">Modifier</button>
            <?php endif; ?>
          </div>
        <?php endif; ?>
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
          <div class=""><?php print_r($comment->getComment()) ?> </div>
          <a class="btn btn-success btn-outline-light"href="index.php?controller=Commentcontroller&task=validecomment&uuid=<?php print_r($comment->getUuid()) ?>" >Valider</a>
        <?php endforeach ?>
      </div> 
    </form>      
  </div>
</div>