<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Бонсай</title>
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
        <p class="metka">Бонсай</p>
            <?php 
                include $_SERVER['DOCUMENT_ROOT'].'/sakura/assets/minisort.php';
            ?>  
        <div class="background">
            <div id="goods-main">
                <?php 
                    include $_SERVER['DOCUMENT_ROOT']."/sakura/database/action.php";
                    SelectAllItemsOnPage(3); 
                ?>  
            </div>
            <div class="pages-listing">
                <?php
                    PagesAdd(Total_pages(3));
                ?>
            </div>
        </div>
    </main>

    <?php 
        include $_SERVER['DOCUMENT_ROOT'].'/sakura/assets/footer.php';
    ?>  

    <script src="/sakura/script/jquery-3.6.0.min.js"></script>
    <script src="/sakura/script/animation/buttonsanimate.js"></script>
    <script src="../js/pagginator.js"></script>
</body>
</html>