<?php

require_once 'config.php';
require_once 'models/Auth.php';
require_once 'dao/UserDaoMysql.php';

$auth = new Auth($pdo, $base);
$userInfo = $auth->checkToken();
$activeMenu = 'config';

$userDao = new UserDaoMysql($pdo);



require 'partials/header.php';
require 'partials/menu.php';
?>

<section class="feed mt-10">

    <h1>Configurações</h1>

    <?php if (!empty($_SESSION['flash'])) : ?>

        <style>
            .error {
                max-width: 100%;
                font-size: 1.2em;
                background-color: red;
                color: white;
                padding: 5px 0px 5px 15px;
                margin-bottom: 10px;
                margin-top: 10px;
                border-radius: 5px;
                /*text-align: center;*/
                font-weight: 600;
                animation: aviso 0.7s infinite alternate;
            }
        </style>

        <div class="error">
            <?= $_SESSION['flash']; ?>
            <?php $_SESSION['flash'] = ''; ?>
        </div>

    <?php endif; ?>

    <form method="POST" class="config-form" enctype="multipart/form-data" action="configuracoes_action.php">

        <label for="">
            Novo avatar: <br>
            <input type="file" name='avatar' /><br>

            <img class="mini" src="<?= $base; ?>/media/avatars/<?= $userInfo->avatar; ?>" alt="">
        </label>

        <label for="">
            Nova capa: <br>
            <input type="file" name="cover" /><br>

            <img class="mini" src="<?= $base; ?>/media/covers/<?= $userInfo->cover; ?>" alt="">
        </label>

        <hr>

        <label for="">
            Nome completo: <br>
            <input type="text" name="name" value="<?= $userInfo->name; ?>" />
        </label>

        <label for="">
            Email: <br>
            <input type="email" name="email" value="<?= $userInfo->email; ?>" />
        </label>

        <label for="">
            Data de Nascimento: <br>
            <input type="text" id="birthdate" name="birthdate" value="<?= date('d/m/Y', strtotime($userInfo->birthdate)); ?>" />
        </label>

        <label for="">
            Cidade: <br>
            <input type="text" name="city" value="<?= $userInfo->city; ?>" />
        </label>

        <label for="">
            Trabalho: <br>
            <input type="text" name="work" value="<?= $userInfo->work; ?>" />
        </label>

        <hr>

        <label for="">
            Nova Senha: <br>
            <input type="password" name="password" />
        </label>

        <label for="">
            Confirmar Nova Senha: <br>
            <input type="password" name="password_confirmation" />
        </label>

        <button class="button">Salvar</button>

    </form>

</section>

<script src="https://unpkg.com/imask"></script>
<script>
    IMask(
        document.getElementById("birthdate"), {
            mask: '00/00/0000'
        }
    );
</script>

<?php
require 'partials/footer.php';
