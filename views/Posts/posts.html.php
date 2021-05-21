<div class="row" >
<?php foreach ($posts as $article) : ?>
        <div class="col-lg-4" id="carte" >
          <div class="card border-light mb-4">
            <div class="card-header text-light bg-success text-center"><?= $article->title ?> </div>
              <p class="text-center"> Publié le : <?php $datef= strtotime($article->date_creat); echo(date('d-m-Y H:i:s', $datef)) ?></p>
              <div class="card-body  m-1 p-0">
                <h5 class="card-title"><?php
                  if (strlen($article->chapo)>=70) {
                      echo substr($article->chapo, 0, 70). "...";
                  } else {
                      echo substr($article->chapo, 0, 70);
                  }
                  ?></h5>
                <p class="text-secondary"><p>Modifié le : <?= $article->date_modify ?></p></p>
              </div>
              <div class="card-footer bg-success text-center pb-0"><p><a class="btn btn-outline-light btn-dark " href="/?controller=postcontroller&task=showOnePost&UUid=<?= $article->uuid ?>">View details &raquo;</a></p></div>
              
            </div>
        </div>
  <?php endforeach ?>  
</div>