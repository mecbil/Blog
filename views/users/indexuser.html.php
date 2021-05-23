mecbil
<section class="conninscri text-light">

  <div class="text-light col-11 col-lg-5 col-md-9 col-sm-11 pt-2">
    <!-- zone de Ajout Post blog -->
    <h1>Dashbord <?= $_SESSION['user']?></h1>
    <div class="">
      <?php if (!empty($erreur)): ?>
      <div class="alert alert-danger">
        <?= $erreur ?>
      </div>
      <?php endif; ?>
            
      <form action="index.php?controller=Postcontroller&task=insertpost&id=<?= $_SESSION['id'] ?>" method="post">
          <h2 class="text-center">Ajout d'un Blog Post </h2>
          <div class="form-group">
            <input type="text" name="title" value="<?php if (isset($_POST['title'])){echo $_POST['title'];} ?>" class="form-control" placeholder="Title"  autocomplete="off">
          </div>
          <div class="form-group">
            <input type="text" name="chapo" value="<?php if (isset($_POST['chapo'])){echo $_POST['chapo'];} ?>" class="form-control" placeholder="Chapo"  autocomplete="off">
          </div>
          <div class=" form-group ">
            <textarea name="content" value="<?php if (isset($_POST['content'])) {echo $_POST['content'];} ?>" class="form-control" placeholder="Content ..."  autocomplete="off"></textarea>
          </div>
          <div class=" form-group ">
              <input type="text" name="author" value="<?php if (isset($_POST['author'])){echo $_POST['author'];} ?>" class="form-control" placeholder="Author"  autocomplete="off">
          </div>
          <div class=" form-group ">
              <button type="submit" class="btn btn-dark btn-outline-light btn-block mt-2">Valider</button>
          </div>
      </form>

<div class="text-light col-6 col-lg-12 col-md-9 col-sm-6 mt-2 m-2">
  
    <h1>Dashbord <?= $_SESSION['user'] ?></h1>

    <p>
    <a class="btn btn-warning text-light" data-toggle="collapse" href="#posts" role="button" aria-expanded="false" aria-controls="collapseExample">
      Blog Posts
    </a>
    <button class="btn btn-warning text-light" type="button" data-toggle="collapse" data-target="#comments" aria-expanded="false" aria-controls="collapseExample">
      Commentaires
    </button>
  </p>
  <div class="container collapse text-dark" id="posts">
    <div class="card card-body">
      <table class="table">
        <thead>
          <tr>
            <th scope="col text-center">#</th>
            <th scope="col">Titres</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php @$i=1; ?>
          <?php foreach ($_SESSION['posts'] as $article) : ?>
          <tr>
            <td><?= @$i++ ?></td>
            <td class=""><?= $article->title ?></td>
            <td><a href="#" class="btn btn-info">Editer</a> <a href="#" class="btn btn-danger">Supprimer</a></td>
          </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
  <div class="collapse text-dark" id="comments">
    <div class="card card-body">
    <table class="table">
        <thead>
          <tr>
            <th scope="col text-center">#</th>
            <th scope="col">Titres</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php @$i=1; ?>
          <?php foreach ($_SESSION['comments'] as $article) : ?>
          <tr>
            <td><?= @$i++ ?></td>
            <td class=""><?= $article->comment ?></td>
            <!-- <td class="">
              <!-- <?php foreach ($_SESSION['posts'] as $articleP) 
                // {
                //   echo($articleP->title);
                // }
               
              ?> -->
            </td> -->
            <td><a href="/?controller=postcontroller&task=&UUid=<?= $article->uuid ?>" class="btn btn-success"> Valider</a> <a href="#" class="btn btn-info">Editer</a> <a href="#" class="btn btn-danger">Supprimer</a></td>
          </tr>
          <?php endforeach ?>
        </tbody>
      </table>

master
    </div>
  </div>

  
  
  <div class="text-light col-11 col-lg-5 col-md-9 col-sm-11 pt-2">
  <form action="index.php?controller=UserController&task=connect" method="post">
          <h2 class="text-center">Gestion :</h2>
          <div class=" form-group ">
              <button type="submit" class="btn btn-dark btn-outline-light btn-block mt-2">Blog Post Non validé</button>
          </div>
      </form>      
  </div>
</div>