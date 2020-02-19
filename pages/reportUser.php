<?php
require_once("./controller/ctrlAdmin.php");
?>
<section>
    <table class="table">
        <tr>
            <th>id</th>
            <th>nome</th>
            <th>email</th>
            <th>cep</th>
        </tr>
        <?php

        foreach (getAll() as $c) {
            echo "
            <tr>
                <td>$c[id_user]</td>
                <td>$c[nome]</td>
                <td>$c[email]</td>
                <td>$c[cep]</td>
            </tr>
            ";
        } ?>
    </table>
</section>