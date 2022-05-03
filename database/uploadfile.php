<?php
if(isset($_POST['save'])) {
                
        $uploaddir = 'img/goods/';
        $uploadfile = $uploaddir . basename($_FILES['image']['name']);
        
        echo '1) '.$_FILES['image']['tmp_name'].'     2)'.$uploadfile;
        $description = $_POST['description'];
        $price = $_POST['price'];
        $typeofgood = $_POST['typeofgood'];
        $image = $_FILES['image']['name'];
        $quantity = $_POST['quantity'];
        $color = $_POST['color'];
        if (move_uploaded_file($_FILES['image']['name'], $uploadfile)) {
            echo "Файл корректен и был успешно загружен.\n";
            $pdo->query("INSERT INTO public.goods (description, price, typeofgood, image, quantity, povod, color) VALUES ('$description', $price, '$typeofgood', '$image', $quantity, '$povod', $color)");
            echo '<h2>Запись успешно добавлена</h2>'; 
        } else {
            echo "Ошибка!\n";
        }
}