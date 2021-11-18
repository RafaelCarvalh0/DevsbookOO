<?php

require_once 'config.php';
require_once 'models/Auth.php';
require_once 'dao/PostDaoMysql.php';

$auth = new Auth($pdo, $base);
$userInfo = $auth->checkToken();
$activeMenu = 'home';

$postDao = new PostDaoMysql($pdo);
$feed = $postDao->getHomeFeed($userInfo->id);

require 'partials/header.php';
require 'partials/menu.php';
?>

<section class="feed mt-10">
    <div class="row">

        <div class="column pr-5">
            
            <?php require 'partials/feed-editor.php'; ?>

            <?php foreach($feed as $item): ?>
                <?php require 'partials/feed-item.php'; ?>
            <?php endforeach; ?>

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
