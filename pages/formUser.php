<?php
include_once('mensagens.php');
if (!empty($_POST)) {
    //POJO
    $nome = trim($_POST["nome"]);
    $email = trim($_POST["email"]);
    $tel = trim($_POST["tel"]);
    $numero = trim($_POST["numero"]);
    $complemento = trim($_POST["complemento"]);
    $senha = crypt(trim($_POST["senha"]), $email);
    $confsenha = trim($_POST["confsenha"]);
    $cep = trim($_POST["cep"]);
    $logradouro = trim($_POST["logradouro"]);
    $bairro = trim($_POST["bairro"]);
    $cidade = trim($_POST["cidade"]);
    $uf = trim($_POST["uf"]);
    $foto = $_FILES['foto'];
    $novaFoto = "";

    //var_dump($foto);

    //SQL - Comandos do Banco de dados
    $sqlCep = "insert into endereco (cep, logradouro, bairro, cidade, uf) values ('$cep' , '$logradouro', '$bairro', '$cidade', '$uf')";

    $sqlUser = "insert into usuario (nome, email, tel, numero, complemento, senha, cep, tipo, foto) values ('$nome', '$email', '$tel', '$numero', '$complemento', md5('$senha'), '$cep', (select id_tipo from tipo where tipo = 'cliente'), '$novaFoto')"; //ou apenas numero 2 ref. ao id do cliente no banco de dados

    $sqlBuscaCep = "select cep from endereco where cep = $cep";

    //Chama funções de validação de usuario
    $erros = validar($_POST);

    if ($erros == "") {
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

        //Enviar Foto
        require_once("./controller/files.php");
        $novaFoto = upload("img/perfil/", $foto);

        //Cadastro do Usuario com o CEP
        $salvo = mysqli_query($conn, htmlspecialchars($sqlUser)) or die(mysqli_error($conn));
        //Se o comando Query for feito a variavel $salvo retorna verdadeiro
        if ($salvo) {
            //echo "<div class='alert alert-success'> Salvo </div>";
            aviso("Salvo");
        } else {
            //echo "<div class='alert alert-danger'> Erro ao salvar! </div>";
            alerta("Erro ao Salvar");
        }
        //Fecha a conecxão do banco de dados
        mysqli_close($conn);
    } else {
        //Mosta os $erros da validação
        erro($erros);
    }
}

//Funções
function validar($user)
{
    $erros = "";
    if ($user['nome'] == "") {
        $erros .= "Nome em branco.<br>";
    }
    if ($user['email'] == "") {
        $erros .= "E-mail em branco.<br>";
    }
    if ($user['senha'] == "") {
        $erros .= "Senha em branco.<br>";
    } else if (strlen($user['senha']) < 7) {
        $erros .= "Senha muito curta. Minimo de 8 caracteres.<br>";
    } else if ($user['senha'] !== $user["confsenha"]) {
        $erros .= "Senhas diferentes.<br>";
    }
    return $erros;
}
?>

<section class="container bg-branco">
    <h3 class="center">Dados do usuário</h3>
    <form method="post" action="index.php?pag=cad" enctype="multipart/form-data">

        <div class="form-group">
            <label for="file">Fotos do Perfil</label>
            <input type="file" class="form-control-file" id="file" name="foto">
        </div>

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