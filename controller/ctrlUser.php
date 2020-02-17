<?php
//Perfil do Usuario
 $user = array(
    "email" => trim(""),
    "senha" => trim("")
 );


if (!empty($_POST["acao"])) {

    $user["email"] = trim($_POST["email"]);
    $user["senha"] = trim($_POST["pws"]);

    login($user);
}

//Functions
function login($usuario)
{
    $sql = "select * from usuario where email = '$usuario[email]' and senha = '$usuario[senha]'";
    $conn = mysqli_connect(LOCAL, USER, PASS, BASE);
    mysqli_set_charset($conn, "utf8");
    $result = mysqli_query($conn, htmlspecialchars($sql)) or die(mysqli_error($conn));
    if (mysqli_num_rows($result) == 1){
        //aviso("Usuario encontrado");

        if(session_status() !== PHP_SESSION_ACTIVE){
            session_start();
        }
        $_SESSION["user"] = mysqli_fetch_array($result);

        header('Location: index.php');
    } else {
        erro("Usuario não encontrado");
    }
    mysqli_close($conn);
}
