<?php
$user = $_SESSION['user'];
?>
<section class="container bg-branco py-3">
    <div class="row">
        <div class="col-12 col-md-4 text-center">
            <div class="card p-3">
                <div class="card-body">
                    <img src="img/perfil/<?= $user['foto'] ?>"  alt="" class="img-fluid">
                </div>
            </div>
            <div class="card p-3">
                <div class="card-body">
                    <h3>Status</h3>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-8">
            <h3>Nome</h3>
            <p> <?= $user['nome'] ?></p>

            <h3>E-mail</h3>
            <p> <?= $user['email'] ?></p>
        </div>
    </div>
</section>