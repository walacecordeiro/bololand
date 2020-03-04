<?php
include_once('mensagens.php');
if (!empty($_POST)) {
    $nome = trim($_POST["nome"]);
    $descr = trim($_POST["descricao"]);
    $quant = trim($_POST["quant"]);
    $valor = trim($_POST["valor"]);
    //Ternário: condição ? verdade : falso ;
    trim($_POST["ativo"]) ? $ativo = 1 : $ativo = 0;
    $foto1 = $_FILES['foto1'];
    $foto2 = $_FILES['foto2'];
    $foto3 = $_FILES['foto3'];
    $foto4 = $_FILES['foto4'];
    $foto5 = $_FILES['foto5'];
    $novaFoto1 = "";
    $novaFoto2 = "";
    $novaFoto3 = "";
    $novaFoto4 = "";
    $novaFoto5 = "";

    require_once("./controller/files.php");
    $novaFoto1 = upload("img/clienteProdutos/", $foto1);
    $novaFoto2 = upload("img/clienteProdutos/", $foto2);
    $novaFoto3 = upload("img/clienteProdutos/", $foto3);
    $novaFoto4 = upload("img/clienteProdutos/", $foto4);
    $novaFoto5 = upload("img/clienteProdutos/", $foto5);

    $sql = "insert into produto (nome, descricao, valor, quant, ativo, foto1, foto2, foto3, foto4, foto5) values ('$nome', '$descr', $valor, $quant, $ativo, '$novaFoto1', '$novaFoto2', '$novaFoto3', '$novaFoto4', '$novaFoto5')";

    //Conecta o banco de dados
    $conn = mysqli_connect(LOCAL, USER, PASS, BASE);
    mysqli_set_charset($conn, "utf8");

    //Cadastro do Usuario
    $salvo = mysqli_query($conn, htmlspecialchars($sql)) or die(mysqli_error($conn));
    if ($salvo) {
        //echo "<div class='alert alert-success'> Salvo </div>";
        aviso("Salvo");
        //header("Location: admin.php");
        mysqli_close($conn);
        echo "<meta http-equiv='refresh' content='2;admin.php?pag=cad'>";
    } else {
        //echo "<div class='alert alert-danger'> Erro ao salvar! </div>";
        erro("Erro ao Salvar");
        mysqli_close($conn);
    }
} else {

?>

    <section class="container bg-branco">
        <h3 class="center">Dados do produto</h3>
        <form method="post" action="admin.php?pag=cad" enctype="multipart/form-data">

            <div class="form-group">
                <label for="file">Fotos do Produto</label>
                <input type="file" class="form-control-file" id="file" name="foto1">
                <input type="file" class="form-control-file" id="file" name="foto2">
                <input type="file" class="form-control-file" id="file" name="foto3">
                <input type="file" class="form-control-file" id="file" name="foto4">
                <input type="file" class="form-control-file" id="file" name="foto5">
            </div>

            <div class="form-group">
                <label>Nome</label>
                <input type="text" class="form-control" name="nome" required>
            </div>

            <div class="form-group">
                <label>Descrição</label>
                <input type="text" class="form-control" name="descricao" required>
            </div>

            <div class="form-group">
                <label>Quantidade</label>
                <input type="number" class="form-control" name="quant" required>
            </div>

            <div class="form-group">
                <label>Valor</label>
                <input type="number" class="form-control" name="valor" required>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="ativo" checked>
                <label class="form-check-label" for="">
                    Ativo
                </label>
            </div>

            <div class="form-group text-right">
                <button type="submit" class="btn bg-azul branco">Enviar</button>
                <button type="reset" class="btn btn-danger branco">Cancelar</button>
            </div>
        </form>
    </section>

<?php } ?>