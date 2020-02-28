<?php
//Adicione no form: enctype="multipart/form-data"
function upload($caminho, $arquivo)
{
    //$arquivo = $_FILES
    $novoArquivo = md5($arquivo['name']) . ".jpg";
    $uploaddir = $caminho;
    $uploadfile = $uploaddir . basename($novoArquivo);
    if (move_uploaded_file($arquivo['tmp_name'], $uploadfile)) {
        //aviso("Arquivo válido e enviado com sucesso.\n");
        return $novoArquivo;
    } else {
        //alerta("Possível ataque de upload de arquivo!\n");     
    }
}
