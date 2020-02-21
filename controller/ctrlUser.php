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
    }
}

//Functions ----------------------------------------------
function login($usuario)
{
    $sql = "select id_user, nome, email from usuario where email = '$usuario[email]' and senha = md5('$usuario[senha]')";
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

function get($id){
    $sql = "select * from usuario where id_user = $id";
    $conn = mysqli_connect(LOCAL, USER, PASS, BASE);
    mysqli_set_charset($conn, "utf8");
    $result = mysqli_query($conn, htmlspecialchars($sql)) or die(mysqli_error($conn));
    return mysqli_fetch_array($result);
}
