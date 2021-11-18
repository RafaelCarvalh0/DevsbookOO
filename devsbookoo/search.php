<?php

require_once 'config.php';
require_once 'models/Auth.php';
require_once 'dao/UserDaoMysql.php';

$auth = new Auth($pdo, $base);
$userInfo = $auth->checkToken();
$activeMenu = 'search';

$userDao = new UserDaoMysql($pdo);

$searchTerm = filter_input(INPUT_GET, 's');

if (empty($searchTerm)) {
    header('Location: ./'); //index.php
    exit;
}

$userList = $userDao->findByName($searchTerm);

require 'partials/header.php';
require 'partials/menu.php';
?>

<section class="feed mt-10">
    <div class="row">

        <div class="column pr-5">

            <div>
                <h2><b>Pesquisa por:</b> </h2>
                <p><?= ($searchTerm); ?></p>
            </div>

            <hr>

            <?php if (!empty($userList)) : ?>

                <?php foreach ($userList as $item) : ?>

                    <div class="friend-icon-search friend-box-show">

                        <a href="<?= $base; ?>/perfil.php?id=<?= $item->id; ?>">
                            <div class="friend-icon-avatar friend-avatar-box">
                                <img src="<?= $base; ?>/media/avatars/<?= $item->avatar; ?>" />

                                <!-- Exibindo dados formatados -->
                                <div class="box-friend-info">

                                    <?php if($item->work): ?>

                                    <div style="float:left;">
                                        <img src="<?= $base; ?>/assets/images/work.png" alt="">
                                        <p style="color: black;"><?= $item->work; ?></p>
                                    </div>

                                    <?php endif; ?>

                                    <?php if($item->city): ?>

                                    <div>
                                        <img src="<?= $base; ?>/assets/images/home-run.png" alt="">
                                        <p style="color: black; max-width:400px;"><?= $item->city; ?></p>
                                    </div>

                                    <?php endif; ?>

                                    <br>

                                    <div>
                                        <p>
                                        <img src="<?= $base; ?>/assets/images/calendar.png" alt="">
                                        </p>

                                        <p style="color: black;">
                                            <?php

                                            $dataNascimento = $item->birthdate;
                                            $data = new DateTime($dataNascimento);
                                            $resultado = $data->diff(new DateTime(date('Y-m-d')));
                                            echo $resultado->format('%Y anos');

                                            ?>
                                        </p>
                                    </div>

                                </div>
                                <!--/Fim exibindo dados formatados -->

                            </div>
                            <div class="friend-icon-name">
                                <?= $item->name; ?>
                            </div>


                        </a>
                    </div>

                <?php endforeach; ?>

            <?php else : ?>

                <p style="margin-top: 10px;">
                    Nenhum usuário encontrado.
                </p>

            <?php endif; ?>

        </div>


        <div class="column side pl-5">
            <div class="box banners">
                <div class="box-header">
                    <div class="box-header-text">Patrocinios</div>
                    <div class="box-header-buttons">

                    </div>
                </div>
                <div class="box-body">
                    <a href=""><img src="https://www.gamerview.com.br/wp-content/uploads/2021/07/nintendo_64_25_anos.jpg" /></a>
                    <a href=""><img src="https://3.bp.blogspot.com/-NCJB1QdLuhE/Ww-3q0UWC8I/AAAAAAAAAMk/wxjNLxNri_03XqSVm27ymT_GgikrODSxwCLcBGAs/s1600/maxresdefault%2B%25281%2529.jpg" /></a>
                </div>
            </div>
            <div class="box">
                <div class="box-body m-10">
                    Criado com ❤️ por B7Web
                </div>
            </div>
        </div>

    </div>
</section>

<?php
require 'partials/footer.php';
