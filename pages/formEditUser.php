<?php
    require_once("./controller/ctrlUser.php");
?>
<section class="container bg-branco">
    <h3 class="center">Dados do usuário</h3>
    <form method="post" action="index.php?pag=cad">
        <div class="form-group">
            <label>Nome</label>
            <input type="text" class="form-control" name="nome">
        </div>
        <div class="form-group">
            <label>E-mail</label>
            <input type="email" class="form-control" name="email">
        </div>
        <div class="form-group">
            <label>Telefone</label>
            <input type="text" class="form-control" name="tel">
        </div>
        <div class="form-group">
            <label>Numero</label>
            <input type="text" class="form-control" name="numero">
        </div>
        <div class="form-group">
            <label>Complemento</label>
            <input type="text" class="form-control" name="complemento">
        </div>

        <div class="form-group">
            <label>CEP</label>
            <input type="text" class="form-control" name="cep" maxlength="9" id="cep" onblur="pesquisacep(this.value);" required>
        </div>
        <div class="form-group">
            <label>Endereço</label>
            <input type="text" class="form-control" name="logradouro" maxlength="100" id="rua">
        </div>
        <div class="form-group">
            <label>Bairro</label>
            <input type="text" class="form-control" name="bairro" maxlength="50" id="bairro">
        </div>
        <div class="form-group">
            <label>Cidade</label>
            <input type="text" class="form-control" name="cidade" maxlength="50" id="cidade">
        </div>
        <div class="form-group">
            <label>Estado</label>
            <input type="text" class="form-control" name="uf" maxlength="2" id="uf">
        </div>

        <div class="form-group">
            <label>Senha</label>
            <input type="password" class="form-control" name="senha">
        </div>
        <div class="form-group">
            <label>Confirmar senha</label>
            <input type="password" class="form-control" name="confsenha">
        </div>

        <div class="form-group text-right">
            <button type="submit" class="btn bg-azul branco">Enviar</button>
            <button type="reset" class="btn btn-danger branco">Cancelar</button>
        </div>
    </form>
</section>