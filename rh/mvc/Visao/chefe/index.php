<div class="container chefe">
    
<h2>Programadores para Invite</h2>

    <form method="POST" action="<?= URL_RAIZ . 'chefe/buscar'?>"> 
        <input type="text" data-bs-toggle="modal" data-bs-target="#buscarPorNome" class="bi bi-box-arrow-in-right" name="buscarPorNome" value="">
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>

    <?php if ($mensagemFlash) : ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?= $mensagemFlash ?>
        </div>
    <?php endif ?>


    <br>

<div class="row row-cols-1 row-cols-md-4 g-4 justify-content-md-center">



    <?php foreach ($programadores as $programador) : ?>
        
        
        
        <div class="col">
            <div class="card" style="width: 20rem;">
                <div class="card-body">
                    <h5 class="card-title"><?= $programador->getNome();?></h5>
                    <h6 class="card-subtitle mb-2 text-body-secondary">Status: <?= $programador->getSituacao();?></h6>
                    <h6 class="card-subtitle mb-2 text-body-secondary">Ocupação: <?= $programador->getTipo();?></h6>
                    
                    <hr>
                    
                    <span>
                        
                        <?php if ($programador->getSituacao() == 'disponivel'): ?>
                            <form action="<?= URL_RAIZ . 'chefe/' . $programador->getId() .'/convidar'?>" method="post">
                                <input name="acao" type="submit" class="btn btn-success" value="Convidar">
                            </form>
                            
                            <?php elseif ($programador->getSituacao() == 'convidado'): ?>
                            <form action="<?= URL_RAIZ . 'chefe/' . $programador->getId() .'/desconvidar'?>" method="post">
                                <input  name="acao" type="submit" class="btn btn-danger" value="Remover Convite">
                            </form>
                        <?php endif; ?>
                        
                    </span>

                </div>
            </div>
        </div>

        
    <?php endforeach ?>

</div>




</div>