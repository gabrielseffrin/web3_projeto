<div class="container chefe">
    
<h2>Programadores Disponíveis para Contratação</h2>

    <?php if ($mensagemFlash) : ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?= $mensagemFlash ?>
        </div>
    <?php endif ?>


    <br>

<div class="row row-cols-1 row-cols-md-4 g-4 justify-content-md-center">



    <?php foreach ($programadores as $programador) : ?>
        
        <form action="<?= URL_RAIZ . 'acaoUsuario/' .  $programador->getId();?>" method="post">


        <div class="col">
            <div class="card" style="width: 20rem;">
                <div class="card-body">
                    <h5 class="card-title"><?= $programador->getNome();?></h5>
                    <h6 class="card-subtitle mb-2 text-body-secondary">Status: <?= $programador->getSituacao();?></h6>
                    <h6 class="card-subtitle mb-2 text-body-secondary">Ocupação: <?= $programador->getTipo();?></h6>
                   
                    <hr>

                    <span>
                    
                        <?php if ($programador->getSituacao() == 'convidado'): ?>
                            <input name="acao" type="submit" class="btn btn-success" value="Contratar">
                        <?php endif; ?>

                    </span>

                </div>
            </div>
        </div>

        </form>
        
    <?php endforeach ?>

</div>
</div>