<div class="row" >
    <?php foreach ($variables['posts'] as $article) : ?>
    <div class="col-lg-4" id="carte">
        <div class="card border-light mb-0">
            <div class="card-header text-center"><?= $article->getTitle() ?></div>
            <p class="text-center"> Modifié le : <?php $datefr= strtotime($article->getDate_modify()); echo(date('d-m-Y H:i:s', $datefr)) ?></p>
            <div class="card-body">
                <h5><?= strlen($article->getChapo())>=70  ? substr($article->getChapo(), 0, 70). "..." : $article->getChapo() ?></h5>
            </div>
            <div class="card-footer text-center pb-0">
                <p><a class="btn btn-outline-light btn-dark" href="/?controller=postcontroller&task=showOnePost&uuid=<?= $article->getUuid() ?>">Détails &raquo;</a></p>
            </div>
        </div>
    </div>
    <?php endforeach ?>
</div>