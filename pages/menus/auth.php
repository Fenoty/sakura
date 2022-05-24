<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
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
        <p class="metka">Авторизация</p>
        <div class="background">
            <div class="auth__main">
                <form method="POST">
                    <div class="block">
                        <label>Логин<p class="null">*</p><input value="<?php echo (isset($_POST["login"])) ? $_POST["login"] : null;?>" name="login" onkeyup='checkAuth()' class="auth__login" type="email"></label>
                    </div>
                    <div class="block">
                        <label>Пароль<p class="null">*</p><input name="password" onkeyup='checkAuth()' class="auth__pass" type="password"></label>
                    </div>
                    <input class="auth__button" type="submit" name="auth" value="Войти">
                </form>
                <input type="submit" class="auth__regist" value="Зарегестрироваться" onclick="window.location.href = '/sakura/pages/menus/registration.php';">
                <?php 
                    global $auth;
                    $auth->IsCookie();
                    if (isset($_POST['auth'])) {
                        if (isset($_POST["login"]) && isset($_POST["password"])) { //Если логин и пароль были отправлены
                            if (!$auth->auth($_POST["login"], $_POST["password"])) { //Если логин и пароль введен не правильно
                                echo "<h2 class='auth__error'>Логин или пароль введен не правильно!</h2>";
                            }
                            else{
                                $auth->setCookie($_POST['login'], $_POST['password']);
                                echo "<script>window.location.href='/sakura/pages/profile/addresses.php'</script>";
                            }
                        }
                    }
                ?>
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