<?php

require_once("dao.php");
//Dados dos Produtos --------------------------------------
$prod = array(
    "nome" => trim(""),
    "descricao" => trim(""),
    "quant" => trim(""),
    "valor" => trim(""),
    "ativo" => trim(""),
    "foto1" => trim(""),
    "foto2" => trim(""),
    "foto3"  => trim(""),
    "foto4" => trim(""),
    "foto5" => trim(""),
    "id_produto" => trim("")
);

//Action -------------------------------------------------
if (!empty($_REQUEST["action"])) {

    switch ($_REQUEST["action"]) {
        
        case "getProd":
            $prod = get($_GET['id']);
            break;
        
        case "edit":
            pojo();
            if (edit()) {
                aviso("Produto atualizado!");
                $prod = get($_POST['id_produto']);
            } else {
                erro("Erro ao atualizar!");
            }
            break;
    }
}

//Functions ------------------------------------------------------------------

function get($id){
    $sql = "select * from produto where id_produto = $id";
    $conn = mysqli_connect(LOCAL, USER, PASS, BASE);
    mysqli_set_charset($conn, "utf8");
    $result = mysqli_query($conn, htmlspecialchars($sql)) or die(mysqli_error($conn));
    return mysqli_fetch_array($result);
}

function edit()
{
    //Enviar Foto
    require_once("files.php");
    if(!empty($_FILES["foto1"])){
        $novaFoto1 = upload("img/clienteProdutos/", $_FILES["foto1"]);
        $novaFoto2 = upload("img/clienteProdutos/", $_FILES["foto2"]);
        $novaFoto3 = upload("img/clienteProdutos/", $_FILES["foto3"]);
        $novaFoto4 = upload("img/clienteProdutos/", $_FILES["foto4"]);
        $novaFoto5 = upload("img/clienteProdutos/", $_FILES["foto5"]);
    } else {
        $novaFoto1 = $prod['foto1'];
        $novaFoto2 = $prod['foto2'];
        $novaFoto3 = $prod['foto3'];
        $novaFoto4 = $prod['foto4'];
        $novaFoto5 = $prod['foto5'];
    }
    $sql = "update produto set
                nome = '$_POST[nome]',
                descricao = '$_POST[descricao]',
                quant = '$_POST[quant]',
                valor = '$_POST[valor]',
                foto1 = '$novaFoto1'
                foto2 = '$novaFoto2'
                foto3 = '$novaFoto3'
                foto4 = '$novaFoto4'
                foto5 = '$novaFoto5'
                where id_produto = $_POST[id_produto] and ativo;";
    $conn = mysqli_connect(LOCAL, USER, PASS, BASE);
    mysqli_set_charset($conn, "utf8");
    $result = mysqli_query($conn, htmlspecialchars($sql)) or die(mysqli_error($conn));
    return $result;
}

function pojo()
{
    $prod['nome'] = trim($_POST["nome"]);
    $prod['descricao'] = trim($_POST["descricao"]);
    $prod['quant'] = trim($_POST["quant"]);
    $prod['valor'] = trim($_POST["valor"]);

}
