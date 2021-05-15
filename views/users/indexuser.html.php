
<?php
require_once('../application/autoload.php');
use Controllers\UserController;
use Models\Post;
$modelpost= new Post();

$posts= $modelpost->update(123,['Rule'=>1, 'id'=>123, 'title'=>'les oiseaux']);



?>
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
            <td><a href="/?controller=postcontroller&task=&UUid=<?= $article->uuid ?>" class="btn btn-success"> Valider</a> <a href="#" class="btn btn-info">Editer</a> <a href="#" class="btn btn-danger">Supprimer</a></td>
          </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
  <div class="collapse text-dark" id="comments">
    <div class="card card-body">
      les comments
      <br>
      la suite
    </div>
  </div>

  
</div>