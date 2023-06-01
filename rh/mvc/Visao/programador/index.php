<div class="container chefe">
    
<h2>Convites</h2>

    <?php if ($mensagemFlash) : ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?= $mensagemFlash ?>
        </div>
    <?php endif ?>


    <br>

<div class="row row-cols-1 row-cols-md-4 g-4 justify-content-md-center">



    
        
    
    
    <?php if ($objeto && $objeto->getSituacao() == 'convidado'): ?>
    <div class="col">
        <div class="card" style="width: 20rem;">
            <div class="card-body">

                    <h5 class="card-title"><?= $objeto->getNome();?></h5>
                    <h6 class="card-subtitle mb-2 text-body-secondary">Status: <?= $objeto->getSituacao();?></h6>
                    <h6 class="card-subtitle mb-2 text-body-secondary">Ocupação: <?= $objeto->getTipo();?></h6>
                    
                    <hr>
                    
                    <span>
                        
                            <form action="<?= URL_RAIZ . 'programador/' . $objeto->getId() .'/aceitar'?>" method="post">
                                <input name="acao" type="submit" class="btn btn-success" value="Aceitar">
                            </form>
                            <form action="<?= URL_RAIZ . 'programador/' . $objeto->getId() .'/recusar'?>" method="post">
                                <input  name="acao" type="submit" class="btn btn-danger" value="Recusar">
                            </form>
                            
                        </span>
                        
                    </div>
                </div>
            </div>
            <?php endif ?>

        
    

</div>




</div>