<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профиль</title>
    <link rel="stylesheet" href="/sakura/style/style.css">
    <link rel="stylesheet" href="/sakura/style/chief-slider.css">
    <link rel="stylesheet" href="/sakura/style/animate.css">
    <link rel="shortcut icon" href="/sakura/img/sakurashortneutral.png" type="image/png">
</head>
<body>
    <?php 
        include $_SERVER['DOCUMENT_ROOT']."/sakura/database/config.php";
        include $_SERVER['DOCUMENT_ROOT'].'/sakura/assets/header.php';
        include $_SERVER['DOCUMENT_ROOT'].'/sakura/database/autharization.php';
    ?>  
    <main class="lower">
        <p class="metka">Мой адрес</p>
        <?php
            global $auth;
            $auth->ReturnToAuth();
            if (isset($_POST['submit_story'])) {
                $auth->deleteCookie();
            }
        ?>
        <div class="background">
            <div class="story-order__main">
                <?php include $_SERVER['DOCUMENT_ROOT']."/sakura/assets/profile_left.php"; ?>
                <div class="story-order__right">
                <?php
                    global $profile;
                    $profile->addAddress();
                ?>
                </div>
            </div>
        </div>
    </main>

    <?php 
        include $_SERVER['DOCUMENT_ROOT'].'/sakura/assets/footer.php';
    ?>  

    <script src="/sakura/script/jquery-3.6.0.min.js"></script>
    <script src="/sakura/script/animation/buttonsanimate.js"></script>
    <script src="/sakura/pages/js/pagginator.js"></script>
</body>
</html>