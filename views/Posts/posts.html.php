<div class="row" >
    <?php foreach ($posts as $article) : ?>
    <div class="col-lg-4" id="carte">
        <div class="card border-light mb-0">
            <div class="card-header text-center"><?php echo($article->getTitle()) ?></div>
            <p class="text-center"> Modifié le : <?php $datefr= strtotime($article->getDate_modify()); echo(date('d-m-Y H:i:s', $datefr)) ?></p>
            <div class="card-body">
                <h5 class="card-title">
                    <?php
                    if (strlen($article->getChapo())>=70) {
                        echo(substr($article->getChapo(), 0, 70)). "...";
                    } else {
                        echo(substr($article->getChapo(), 0, 70));
                    }
                    ?>
                </h5>
            </div>
            <div class="card-footer text-center pb-0">
                <p><a class="btn btn-outline-light btn-dark" href="/?controller=postcontroller&task=showOnePost&uuid=<?php echo($article->getUuid()) ?>">Détails &raquo;</a></p>
            </div>
        </div>
    </div>
    <?php endforeach ?>
</div>