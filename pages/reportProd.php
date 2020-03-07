<?php
require_once("./controller/ctrlAdmin.php");
?>
<section>
    <table class="table">
        <tr>
            <th>id</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Quantidade</th>
            <th>Valor</th>
            <th>Ativo</th>
            <th>Foto1</th>
            <th>Foto2</th>
            <th>Foto3</th>
            <th>Foto4</th>
            <th>Foto5</th>
            <th>
                <!-- <i class="material-icons">edit</i> -->
            </th>
            <th>
                <!-- <i class="material-icons">delete_forever</i> -->
            </th>
        </tr>
        <?php
        //for ($x = 0; $x < lenght(getAll()); $x++){
        foreach (getAllProd() as $i) {
            echo "
            <tr>
                <td>$i[id_produto]</td>
                <td>$i[nome]</td>
                <td>$i[descricao]</td>
                <td>$i[quant]</td>
                <td>$i[valor]</td>
                <td>" . ($i['ativo'] ? 'Sim' : 'Não') . "</td>
                <td><img src='img/clienteProdutos/$i[foto1]' style=width:100px></td>
                <td><img src='img/clienteProdutos/$i[foto2]' style=width:100px></td>
                <td><img src='img/clienteProdutos/$i[foto3]' style=width:100px></td>
                <td><img src='img/clienteProdutos/$i[foto4]' style=width:100px></td>
                <td><img src='img/clienteProdutos/$i[foto5]' style=width:100px></td>
                
                <td>
                    <a href='admin.php?pag=editProd&action=getProd&id=" . $i['id_produto'] . "'>
                        <i class='material-icons'>edit</i>
                    </a>
                </td>
                <td>
                    <a href='admin.php?pag=removeProd&action=removeProd&id=" . $i['id_produto'] . "&status=$i[ativo]' onclick=\"return confirm('Apagar registro do produto $i[nome]?')\">
                    <i class='material-icons'>delete_forever</i>
                    </a>
                </td>
            </tr>
            ";
        } ?>
    </table>
</section>