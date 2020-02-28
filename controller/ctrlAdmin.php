<?php
//Perfil do Adminstrador -----------------------------------
$admin = array(
    "email" => trim(""),
    "senha" => trim("")
);

//Action -------------------------------------------------
if (!empty($_REQUEST["action"])) {

    switch ($_REQUEST["action"]) {
        case "log":
            $admin["email"] = trim($_POST["email"]);
            $admin["senha"] = crypt(trim($_POST["pws"]), $admin["email"]);
            login($admin);
            break;

        case "off":
            logout();
            break;

        case "remove":
            remover($_GET['id'], $_GET['status']);
            break;
    }
}

//Functions ----------------------------------------------
function login($usuario)
{
    $sql = "select id_user, nome, email, tipo from usuario where email = '$usuario[email]' and senha = md5('$usuario[senha]') and tipo = 1";
    $conn = mysqli_connect(LOCAL, USER, PASS, BASE);
    mysqli_set_charset($conn, "utf8");
    $result = mysqli_query($conn, htmlspecialchars($sql)) or die(mysqli_error($conn));
    if (mysqli_num_rows($result) == 1) {
        //aviso("Usuario encontrado");

        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        $_SESSION["admin"] = mysqli_fetch_array($result);

        header('Location: admin.php');
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

function getAll()
{
    $sql = "select * from usuario, endereco where usuario.cep = endereco.cep and tipo != 1"; // and ativo";
    $conn = mysqli_connect(LOCAL, USER, PASS, BASE);
    mysqli_set_charset($conn, "utf8");
    $result = mysqli_query($conn, htmlspecialchars($sql)) or die(mysqli_error($conn));

    mysqli_close($conn);

    return $result;
}


function cryptar($texto, $chave)
{
    $texto;
    $ivlen = openssl_cipher_iv_length($cipher = "AES-128-CBC");
    $iv = openssl_random_pseudo_bytes($ivlen);
    $ciphertext_raw = openssl_encrypt($texto, $cipher, $chave, $options = OPENSSL_RAW_DATA, $iv);
    $hmac = hash_hmac('sha256', $ciphertext_raw, $chave, $as_binary = true);
    return htmlspecialchars(base64_encode($iv . $hmac . $ciphertext_raw));
}

function remover($id, $status)
{
    //$sql = "DELETE FROM usuario WHERE id_user = $id";
    $sql = "update usuario set ativo = !$status WHERE id_user = $id";
    $conn = mysqli_connect(LOCAL, USER, PASS, BASE);
    mysqli_set_charset($conn, "utf8");
    $result = mysqli_query($conn, htmlspecialchars($sql)) or die(mysqli_error($conn));
    if ($result) {
        aviso("Removido!");
    } else {
        erro("Não foi possivel remover o Usuário!");
    }

    mysqli_close($conn);

    header('Location: admin.php?pag=repUser');
}
