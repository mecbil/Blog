<div class="row" >
    <?php foreach ($posts as $article) : ?>
    <div class="col-lg-4" id="carte">
        <div class="card border-light mb-4">
            <div class="card-header text-light bg-success text-center"><?= $article->getTitle() ?></div>
            <p class="text-center"> Publié le : <?php $datefr= strtotime($article->getDate_modify()); echo(date('d-m-Y H:i:s', $datefr)) ?></p>
            <div class="card-body text-primary m-0 p-0">
                <h5 class="card-title">
                    <?php
                    if (strlen($article->getChapo())>=70) {
                        echo substr($article->getChapo(), 0, 70). "...";
                    } else {
                        echo substr($article->getChapo(), 0, 70);
                    }
                    ?>
                </h5>
                <p class="text-secondary">Modifié Le : <?= $article->getDate_modify() ?></p>
            </div>
            <div class="card-footer bg-success text-center pb-0">
                <p><a class="btn btn-outline-light btn-dark" href="/?controller=postcontroller&task=showOnePost&uuid=<?= $article->getUuid() ?>">Détails &raquo;</a></p>
            </div>
        </div>
    </div>
    <?php endforeach ?>
</div>