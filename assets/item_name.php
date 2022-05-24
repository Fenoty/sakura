<?php 
        include $_SERVER['DOCUMENT_ROOT']."/sakura/database/config.php";
        global $auth;
        global $pdo;
        $id = $_GET['id'];
        $array = $pdo->query("SELECT * FROM public.goods WHERE id = $id")->fetch(PDO::FETCH_ASSOC);
        $price = $array['price'];
?>  
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Описание</title>
    <link rel="stylesheet" href="/sakura/style/style.css">
    <link rel="stylesheet" href="/sakura/style/chief-slider.css">
    <link rel="stylesheet" href="/sakura/style/animate.css">
    <link rel="shortcut icon" href="/sakura/img/sakurashortneutral.png" type="image/png">
</head>
<body>
    <?php 
        include $_SERVER['DOCUMENT_ROOT'].'/sakura/assets/header.php';
        include $_SERVER['DOCUMENT_ROOT'].'/sakura/database/autharization.php';
    ?>  
    <main>
        <div class="item-name__background">
            <div class="item-name__main">
                <div class="item-name__left">
                    <img class="item-name__img" src="/sakura/img/goods/<?=$array['image'] ?>" alt="">
                </div>
                <div class="item-name__right">
                    <p class="item-name__name padding-border"><?=$array['description'] ?></p>
                    <p class="item-name__price padding-border"><?=$array['price'] ?> руб./букет</p>
                    <?php
                     
                        if ($array['quantity']!=0) {
                            echo '
                            <div class="amount-block__main padding-border">
                                <p class="amount-block__title">Количество</p>
                                    <button name="hide'.$id.'" class="amount-block__change-minus" value="-">-</button><input name="hide'.$id.'" readonly data-min="0" data-max="99" class="amount-block__typing" type="number" value="1"><button name="hide'.$id.'" class="amount-block__change-plus" value="+">+</button>
                                    <input class="amount-block__add-cart" '.$auth->IfNotAuthCart().' type="submit" name="'.$id.'" value="В корзину">
                                    <input class="amount-block__buy" type="submit" value="Купить">
                            </div>
                            <p class="item-name__quantity padding-border">В наличии <b>'.$array["quantity"].'</b> шт.</p>';
                        }
                        else{
                            echo '
                            <div class="amount-block__main padding-border">
                                <p class="amount-block__title">Количество</p>
                                <p class="item-name__quantity"><b>Нет в наличии</b></p>
                            </div>';
                        }
                    ?>
                    <div class="item-description padding-border">
                        <p class="item-description__title">Описание</p>
                        <p class="item-description__text"><?=$array['opis']?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="popup-fade">
            <div class="popup">
                <div class="top-menu">
                    <h2>Быстрая покупка</h2>
                    <a class="popup-close">&times;</a>
                </div>
                <form method="post">
                    <div class="center-menu">
                        <div class="block">
                            <label>Ф.И.О.<p class="null">*</p><input name="fio" onkeyup='checkParams()' class="fio-not-null  empty_field" type="text" placeholder="Иванов Иван Иваныч"></label>
                        </div>
                        <div class="block">
                            <label>Ваш email<p class="null">*</p><input name="email" onkeyup='checkParams()' class="email-not-null  empty_field" type="email" placeholder="example@email.com"></label>
                        </div>
                        <div class="block">
                            <label>Ваш телефон<p class="null">*</p><input id="phone" name="phone" onkeyup='checkParams()' class="phone-not-null empty_field" type="text" placeholder="+7 (___) ___-__-__"></label>
                        </div>
                        <div class="block">
                            <label>Ваш адрес<p class="null">*</p><input name="address" onkeyup='checkParams()' class="address-not-null  empty_field" type="text" placeholder="Москва, ул. Сакура-фловерс, д. 1, кв. 1"></label>
                        </div>
                        <div class="block">
                            <label>Комментарий к заказу<textarea name="comment"></textarea></label>
                        </div>
                    </div>
                    <div class="bottom-menu">
                            <input name="submit" class="disable submit-order" disabled type="submit" value="Отправить">
                    </div>
                </form>
                <?php
                    if (isset($_POST['submit'])){
                            $fio = $_POST['fio'];
                            $email = $_POST['email'];
                            $phone = $_POST['phone'];
                            $address = $_POST['address'];
                            $comment = isset($_POST['comment']) ? $_POST['comment'] : ''; 
                            $date = date("Y-m-d");
                            $pdo->query("INSERT INTO public.orders (fio, email, phone, comment, id_goods, date_order, address, total_price, quantity) VALUES ('$fio','$email','$phone','$comment','{".$id."}','$date','$address',$price, '{1}')");
                            $pdo->query("UPDATE public.goods SET quantity = quantity-1 WHERE id = $id");
            
                            $array_id = array($id);
                            global $setval;
                            $setval->SendMail($fio, $array_id, $email);
                            echo '<script>window.location.href = "/sakura/assets/was_order.php";</script>';
                    }
                ?>
            </div>		
        </div>
    </main>
    
    <?php 
        include $_SERVER['DOCUMENT_ROOT'].'/sakura/assets/footer.php';
    ?>  

    <script src="/sakura/script/jquery-3.6.0.min.js"></script>
    <script src="/sakura/script/jquery.maskedinput.min.js"></script>
    <script src="/sakura/script/animation/buttonsanimate.js"></script>
    <script src="/sakura/pages/js/pagginator.js"></script>
    <script src="/sakura/script/item_name.js"></script>
</body>
</html>
