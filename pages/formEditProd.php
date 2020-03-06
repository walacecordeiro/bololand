<?php
require_once("./controller/ctrlProduto.php");
?>
<section class="container bg-branco">
    <h3 class="center">Dados do produto</h3>
    <form method="post" action="admin.php?pag=editProd" enctype="multipart/form-data">
        <input type="hidden" name="action" value="edit">
        <input type="hidden" name="id_produto" value="<?= $prod['id_produto'] ?>">

        <div class="form-group">
            <label>Nome</label>
            <input type="text" class="form-control" name="nome" value="<?= $prod['nome'] ?>">
        </div>
        <div class="form-group">
            <label>Descrição</label>
            <input type="text" class="form-control" name="descricao" value="<?= $prod['descricao'] ?>">
        </div>
        <div class="form-group">
            <label>Quantidade</label>
            <input type="text" class="form-control" name="quant" value="<?= $prod['quant'] ?>">
        </div>
        <div class="form-group">
            <label>Valor</label>
            <input type="text" class="form-control" name="valor" value="<?= $prod['valor'] ?>">
        </div>
        <div class="form-group">
            <label for="file">Foto1</label>
            <input type="file" class="form-control-file" name="foto1" id="file">
        </div>
        <div class="form-group">
            <label for="file">Foto2</label>
            <input type="file" class="form-control-file" name="foto2" id="file">
        </div>
        <div class="form-group">
            <label for="file">Foto3</label>
            <input type="file" class="form-control-file" name="foto3" id="file">
        </div>
        <div class="form-group">
            <label for="file">Foto4</label>
            <input type="file" class="form-control-file" name="foto4" id="file">
        </div>
        <div class="form-group">
            <label for="file">Foto5</label>
            <input type="file" class="form-control-file" name="foto5" id="file">
        </div>

        

        <div class="form-group text-right">
            <button type="submit" class="btn bg-azul branco">Enviar</button>
            <button type="reset" class="btn btn-danger branco">Cancelar</button>
        </div>
    </form>
</section>