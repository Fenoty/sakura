<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Контакты</title>
    <link rel="stylesheet" href="/sakura/style/style.css">
    <link rel="stylesheet" href="/sakura/style/chief-slider.css">
    <link rel="stylesheet" href="/sakura/style/animate.css">
    <link rel="shortcut icon" href="/sakura/img/sakurashortneutral.png" type="image/png">
</head>
<body>
    <?php 
        include $_SERVER['DOCUMENT_ROOT']."/sakura/database/config.php";
        include $_SERVER['DOCUMENT_ROOT'].'/sakura/assets/header.php';
    ?>  
    <main>
        <p class="metka metka-another">Контакты</p>
        <div class="background">
            <div class="contacts-center">
                <p>Телефон: <a href="https://api.whatsapp.com/send?phone=79163649292">8 (916) 364-92-92</a> (с 9:00 до 21:00)</p>
                <p>Почта: <a href="mailto:sakura-flowwwers@gmail.com">sakura-flowwwers@gmail.com</a></p>
                <p>Телеграмм: <a href="tg://resolve?domain=fenoty">/tg-sakura-flowers</a></p>
                <p>ВКонтакте: <a href="https://vk.me/fenoty">/sakura-flowers</a></p>
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