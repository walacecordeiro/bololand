<?php
    require_once("./controller/ctrlAdmin.php");
?>

<section class="container bg-branco">
    <div class="row justify-content-center">

        <form method="post" action="admin.php" class="col-md-6">
            <input type="hidden" name="action" value="log">

            <h2 class="p-3 text-center"> login do adminitrador</h2>

            <div class="form-group py-3">
                <label for="e-mail">e-mail</label>
                <input type="email" name="email" class="form-control p-2" value="<?=$admin['email']?>" placeholder="Ex. paulosilva@email.com">
            </div>

            <div class="form-group py-3">
                <label for="senha" class="float-left">senha na Bololand.com</label>
                <span class="float-right"><a href="#">esqueceu?</a></span>
                <div class="input-group">
                    <input type="password" name="pws" class="form-control p-2">
                    <div class="input-group-append">
                        <div class="input-group-text"> <i class="material-icons" style="font-size: 12pt">remove_red_eye</i></div>
                    </div>
                </div>
            </div>

            <div class="form-group py-3">
                <button class="btn btn-lg btn-block btn-danger p-2">continuar</button>
            </div>
        </form>
    </div>
</section>
