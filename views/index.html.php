
  <div class="present container col-lg-12 p-2">
    <img class="rounded baniere " src="../images/me.png">

 </div>

<div class="row container-fluid align-items-center align-self-center" >



  <h2>Last Blogs posts</h2>

  <?php foreach ($posts as $article) : ?>
        <div class="col-lg-4" id="carte" >
          <div class="card border-light mb-4">
            <div class="card-header text-light bg-success text-center"><?= $article['title'] ?> </div>
              <p class="text-center"> Publié le : <?= $article['date'] ?></p>
              <div class="card-body text-primary m-0 p-0">
                <h5 class="card-title"><?php
                  if (strlen($article['chapo'])>=70)
                  {
                    echo substr($article['chapo'],0,70). "...";
                  }else
                  {
                    echo substr($article['chapo'],0,70);
                  }
                  ?></h5>
                <p class="text-secondary"><p><?= $article['date'] ?></p></p>
              </div>
              <div class="card-footer bg-success text-center pb-0"><p><a class="btn btn-outline-light btn-warning " href="<?= str_replace(" ","-",$article['title']) ?>-<?= $article['Id'] ?>">View details &raquo;</a></p></div>
              
            </div>
        </div><!-- /.col-lg-4 -->
  <?php endforeach ?>  
</div><!-- /.row -->
<!-- </div>/.container -->