<div class="present text-light container-fluid col-lg-12">
    <img class="rounded baniere " src="../images/me.png">
    <h3>“L'enseignement devrait être ainsi : celui qui le reçoit le recueille comme un don inestimable mais jamais comme une contrainte pénible.”</h3>
</div>

<div class="row container-fluid">
    <h2>Derinières publications</h2>

    <?php foreach ($posts as $article) : ?>
    <div class="col-lg-4" id="carte">
        <div class="card border-light">
            <div class="card-header text-light bg-success text-center"><?php print_r($article->getTitle())  ?> </div>
            <p class="text-center"> Publié le : <?php $datefr= strtotime($article->getDate_modify()); print_r(date('d-m-Y H:i:s', $datefr)) ?></p>
            <div class="card-body">
                <h5 class="card-title"><?php
                  if (strlen($article->getChapo())>=70) {
                      print_r(substr($article->getChapo(), 0, 70). "...") ;
                  } else {
                    print_r(substr($article->getChapo(), 0, 70). "...") ;
                  }
                  ?></h5>
                <p class="text-secondary">
                <p>Modifié Le : <?php print_r($article->getDate_modify() ) ?></p>
                </p>
            </div>
            <div class="card-footer bg-success text-center pb-0">
                <p><a class="btn btn-outline-light btn-dark" href="/?controller=postcontroller&task=showOnePost&uuid=<?php print_r($article->getUuid())  ?>">Détails &raquo;</a></p>
            </div>
        </div>
    </div>
    <?php endforeach ?>
</div>