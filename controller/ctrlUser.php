<?php
//Perfil do Usuario --------------------------------------
$user = array(
    "email" => trim(""),
    "senha" => trim("")
);

//Action -------------------------------------------------
if (!empty($_REQUEST["action"])) {

    switch ($_REQUEST["action"]) {
        case "log":
            $user["email"] = trim($_POST["email"]);
            $user["senha"] = crypt(trim($_POST["pws"]), $user["email"]);
            login($user);
            break;

        case "off":
            logout();
            break;

        case "getUser":
            $user = get($_GET['id']);
            break;

        case "edit":
            pojo();
            if (edit()) {
                aviso("Usuario atualizado!");
                $user = get($_POST['id']);
            } else {
                erro("Erro ao atualizar!");
            }
            break;
    }
}

//Functions ----------------------------------------------
function login($usuario)
{
    $sql = "select id_user, nome, email from usuario where email = '$usuario[email]' and senha = md5('$usuario[senha]') and ativo";
    $conn = mysqli_connect(LOCAL, USER, PASS, BASE);
    mysqli_set_charset($conn, "utf8");
    $result = mysqli_query($conn, htmlspecialchars($sql)) or die(mysqli_error($conn));
    if (mysqli_num_rows($result) == 1) {
        //aviso("Usuario encontrado");

        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        $_SESSION["user"] = mysqli_fetch_array($result);

        header('Location: index.php');
    } else {
        erro("Usuario não encontrado");
    }
    mysqli_close($conn);
}

function logout()
{
    // if(session_status() !== PHP_SESSION_ACTIVE){
    //     session_start();
    // }
    //Ternarios
    session_status() !== PHP_SESSION_ACTIVE ? session_start() : "";
    session_destroy();
    header('Location: index.php');
}

function get($id)
{
    $sql = "select * from usuario, endereco where id_user = $id and ativo";
    $conn = mysqli_connect(LOCAL, USER, PASS, BASE);
    mysqli_set_charset($conn, "utf8");
    $result = mysqli_query($conn, htmlspecialchars($sql)) or die(mysqli_error($conn));
    return mysqli_fetch_array($result);
}

function edit()
{
    $sql = "update usuario set
                nome = '$_POST[nome]',
                email = '$_POST[email]',
                tel = '$_POST[tel]',
                numero = '$_POST[numero]',
                complemento = '$_POST[complemento]',
                cep = '$_POST[cep]'
                where id_user = $_POST[id] and ativo;";
    $conn = mysqli_connect(LOCAL, USER, PASS, BASE);
    mysqli_set_charset($conn, "utf8");
    $result = mysqli_query($conn, htmlspecialchars($sql)) or die(mysqli_error($conn));
    return $result;
}

function buscacep($cep)
{
    $sqlBuscaCep = "select cep from endereco where cep = $cep";
    $sqlCep = "insert into endereco (cep, logradouro, bairro, cidade, uf) values ('$user[cep]' , '$user[logradouro]', '$user[bairro]', '$user[cidade]', '$user[uf]')";
    //Conecta o banco de dados
    $conn = mysqli_connect(LOCAL, USER, PASS, BASE);
    mysqli_set_charset($conn, "utf8");
    //Busca do CEP (Endereco) e guarda no $result
    $result = mysqli_query($conn, htmlspecialchars($sqlBuscaCep)) or die(mysqli_error($conn));
    //Se o resultado da busca do CEP for igual a 0
    if (mysqli_num_rows($result) == 0) {
        //Cadastro do CEP (Endereco)
        mysqli_query($conn, htmlspecialchars($sqlCep)) or die(mysqli_error($conn));
    }
}

function pojo()
{
    $user['nome'] = trim(addslashes($_POST["nome"]));
    $user['email'] = trim(addslashes($_POST["email"]));
    $user['tel'] = trim(addslashes($_POST["tel"]));
    $user['numero'] = trim(addslashes($_POST["numero"]));
    $user['complemento'] = trim(addslashes($_POST["complemento"]));
    //$user['senha'] = crypt(trim(addslashes($_POST["senha"]), $email));
    //$confsenha = trim(addslashes($_POST["confsenha"]));
    $user['cep'] = trim(addslashes($_POST["cep"]));
    $user['logradouro'] = trim(addslashes($_POST["logradouro"]));
    $user['bairro'] = trim(addslashes($_POST["bairro"]));
    $user['cidade'] = trim(addslashes($_POST["cidade"]));
    $user['uf'] = trim(addslashes($_POST["uf"]));
}
