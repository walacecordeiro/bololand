<?php
function edit()
{
    //Enviar Foto
    require_once("files.php");
    if(!empty($_FILES["foto"])){
        $novaFoto = upload("img/perfil/", $_FILES["foto"]);
    } else {
        $novaFoto = $user['foto'];
    }
    //busca do cep
    buscaCep($_POST);
    $sql = "update usuario set
                nome = '$_POST[nome]',
                email = '$_POST[email]',
                tel = '$_POST[tel]',
                numero = '$_POST[numero]',
                complemento = '$_POST[complemento]',
                cep = '$_POST[cep]',
                foto = '$novaFoto'
                where id_user = $_POST[id_user] and ativo;";
    $conn = mysqli_connect(LOCAL, USER, PASS, BASE);
    mysqli_set_charset($conn, "utf8");
    $result = mysqli_query($conn, htmlspecialchars($sql)) or die(mysqli_error($conn));
    return $result;
}
