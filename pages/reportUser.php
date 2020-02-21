<?php
require_once("./controller/ctrlAdmin.php");
?>
<section>
    <table class="table">
        <tr>
            <th>id</th>
            <th>nome</th>
            <th>email</th>
            <th>tel.</th>
            <th>cep</th>
            <th>
                <!-- <i class="material-icons">edit</i> -->
            </th>
            <th>
                <!-- <i class="material-icons">delete_forever</i> -->
            </th>
        </tr>
        <?php
        //for ($x = 0; $x < lenght(getAll()); $x++){
        foreach (getAll() as $c) {


            echo "
            <tr>
                <td>$c[id_user]</td>
                <td>$c[nome]</td>
                <td>$c[email]</td>
                <td>$c[tel]</td>
                <td>$c[cep]</td>
                <td>
                    <a href='admin.php?pag=editUser&action=getUser&id=" . $c['id_user']. "'>
                        <i class='material-icons'>edit</i>
                    </a>
                </td>
                <td>
                    <i class='material-icons'>delete_forever</i>
                </td>
            </tr>
            ";
        } ?>
    </table>
</section>