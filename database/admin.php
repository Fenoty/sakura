<?php
global $pdo;

if (!isset($_GET['admin'])) {
    echo '
    <script src="script/chief-slider.js"></script>
    <script src="script/animation/animate.js"></script>
    <script src="script/index.js"></script>
    <script src="/sakura/script/animation/buttonsanimate.js"></script>
    ';
}
else {
    echo '<script language="javascript">document.querySelector("body").innerHTML = ""; 
    </script> ';
    echo '
        
    ';
    echo '
    <div class="add-data__center">
    <form method="get">
        <input type="submit" name="admin" value="change">
        <input type="submit" name="admin" value="add">
    </form>
    ';
    if ($_GET['admin']=='change') {
 
        //ФУНКЦИЯ ПРОВЕРКИ ID
        function checking($attr,$val,$tp){
            if (isset($_POST[$tp]) && $attr==$val) {
                return ' selected="selected" ';
            }
        }

        //ФУНКЦИЯ ПОЛУЧЕНИЯ МАССИВА ЗНАЧЕНИЙ ИЗ БД
        function getArray(){
            global $pdo;
            if (isset($_POST['id'])) {
                if(isset($_POST['show'])) {
                    $id = $_POST['id'];
                    $array = $pdo->query("SELECT * FROM public.goods WHERE id = $id")->fetch(PDO::FETCH_ASSOC); 
                }
                else{
                    $array= array(
                        'id' => 1,
                        'description' => '',
                        'price' => '',
                        'typeofgood' => '1',
                        'image' => '',
                        'quantity' => '',
                        'povod' => 1,
                        'color' => 1
                    ); 
                }

                return $array;
            }
            else{
                $array= array(
                    'id' => 1,
                    'description' => '',
                    'price' => '',
                    'typeofgood' => '1',
                    'image' => '',
                    'quantity' => '',
                    'povod' => 1,
                    'color' => 1
                ); 
                return $array;
            }
        }
        
      
        function allid(){
            global $pdo;
            $str ='';
            if (isset($_POST['id'])) {
                    $id = $_POST['id'];
            }
            else{
                $id='1'; 
            }
            foreach($pdo->query("SELECT * FROM public.goods") as $row) {
                
                if ($row['id'] == $id) {
                    $str = $str.'<option selected="selected" value="'.$row['id'].'">'.$row['id'].'</option>';
                }
                else{
                    $str = $str.'<option value="'.$row['id'].'">'.$row['id'].'</option>';
                }
                
            }
            return $str; 
            
        }

        //УДАЛЕНИЕ ЗАПИСИ====================================
        if (isset($_POST['delete']) && isset($_POST['id'])) {
            $id = $_POST['id'];
            $pdo->query("DELETE FROM public.goods WHERE id = $id");
            echo 'Запись успешно удалена';
            $array = $pdo->query("SELECT * FROM public.goods WHERE id = $id")->fetch(PDO::FETCH_ASSOC);
        }

        //ИЗМЕНЕНИЕ ЗАПИСИ====================================
        if (isset($_POST['change']) && isset($_POST['id'])) {
            $id = $_POST['id'];
            if (($_POST['quantity']!='') && ($_POST['description']!='') && ($_POST['price']!='')) {
                $uploaddir = 'img/goods/';
                $uploadfile = $uploaddir . basename($_FILES['image']['name']);
                $description = $_POST['description'];
                $price = $_POST['price'];
                $typeofgood = $_POST['typeofgood'];
                $image = $_FILES['image']['name'];
                $quantity = $_POST['quantity'];
                $povod = $_POST['povod'];
                $color = $_POST['color'];
                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
                    echo "Запись успешна изменена\n";
                    $pdo->query("UPDATE public.goods SET description='$description', price=$price, typeofgood='$typeofgood', image='$image', quantity=$quantity, povod='$povod', color=$color WHERE id=$id");
                    $array = array(
                        'id' => '',
                        'description' => '',
                        'price' => '',
                        'typeofgood' => '1',
                        'image' => '',
                        'quantity' => '',
                        'povod' => '1',
                        'color' => '1'
                    );
                } 
                else {
                    $pdo->query("UPDATE public.goods SET description='$description', price=$price, typeofgood='$typeofgood', quantity=$quantity, povod='$povod', color=$color WHERE id=$id");
                    echo 'Запись успешно изменена без картинки';
                }
            }else{
            echo 'Введите все данные!';
            }
            
            
        }

        echo '
        <h2>Изменение записи по ID</h2>
        <form method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td>ID</td>
                <td>
                <select name="id">
                '.allid().'
                </select>
                <input type="submit" value="Показать" name="show">
                </td>
            </tr>
            <tr><td colspan="2"><hr></td></tr>
            <tr>
                <td>Название</td>
                <td><input type="text" value="'.getArray()['description'].'" name="description"></td>
            </tr>
            <tr>
                <td>Цена</td>
                <td><input type="text" value="'.getArray()['price'].'" name="price"></td>
            </tr>
            <tr>
                <td>Тип товара</td>
                <td>
                <select name="typeofgood">
                    <option '.checking(1,getArray()['typeofgood'],'typeofgood').' value="1">Букет</optionvalue=>
                    <option '.checking(2,getArray()['typeofgood'],'typeofgood').' value="2">Композиция</option>
                    <option '.checking(3,getArray()['typeofgood'],'typeofgood').' value="3">Японские растения</option>
                    <option '.checking(4,getArray()['typeofgood'],'typeofgood').' value="4">Комнатные расения</option>
                </select>
                </td>
            </tr>
            <tr>
                <td>Количество</td>
                <td><input type="text" value="'.getArray()['quantity'].'" name="quantity"></td>
            </tr>
            <tr>
                <td>Повод</td>
                <td>
                <select name="povod">
                    <option '.checking('1september',getArray()['povod'],'povod').' value="1september">1 сентября</optionvalue=>
                    <option '.checking('14february',getArray()['povod'],'povod').' value="14february">14 февраля</option>
                    <option '.checking('8mart',getArray()['povod'],'povod').' value="8mart">8 марта</option>
                    <option '.checking('bezpovoda',getArray()['povod'],'povod').' value="bezpovoda">Без повода</option>
                    <option '.checking('vipusknoy',getArray()['povod'],'povod').' value="vipusknoy">Выпускной</option>
                    <option '.checking('yearday',getArray()['povod'],'povod').' value="yearday">Годовщина</option>
                    <option '.checking('motherday',getArray()['povod'],'povod').' value="motherday">День матери</option>
                    <option '.checking('birthday',getArray()['povod'],'povod').' value="birthday">День рождения</option>
                    <option '.checking('teacherday',getArray()['povod'],'povod').' value="teacherday">День учителя</option>
                    <option '.checking('prosti',getArray()['povod'],'povod').' value="prosti">Извинение</option>
                    <option '.checking('svadba',getArray()['povod'],'povod').' value="svadba">Свадьба</option>
                    <option '.checking('svidanie',getArray()['povod'],'povod').' value="svidanie">Свидание</option>
                    <option '.checking('yubilei',getArray()['povod'],'povod').' value="yubilei">Юбилей</option>
                    <option '.checking('night',getArray()['povod'],'povod').' value="night">Классика</option>
                    <option '.checking('udivlenie',getArray()['povod'],'povod').' value="udivlenie">Удивить</option>
                </select>
                </td>
            </tr>
            <tr>
                <td>Цвет</td>
                <td>
                <select name="color">
                    <option '.checking(1,getArray()['color'],'color').' value="1">белый</option>
                    <option '.checking(2,getArray()['color'],'color').' value="2">голубой</option>
                    <option '.checking(3,getArray()['color'],'color').' value="3">желтый</option>
                    <option '.checking(4,getArray()['color'],'color').' value="4">зеленый</option>
                    <option '.checking(5,getArray()['color'],'color').' value="5">красный</option>
                    <option '.checking(6,getArray()['color'],'color').' value="6">кремовый</option>
                    <option '.checking(7,getArray()['color'],'color').' value="7">микс</option>
                    <option '.checking(8,getArray()['color'],'color').' value="8">оранжевый</option>
                    <option '.checking(9,getArray()['color'],'color').' value="9">розовый</option>
                    <option '.checking(10,getArray()['color'],'color').' value="10">фиолетовый</option>
                </select>
                </td>
            </tr>
            <tr>
                <td>Изображение</td>
                <td><input type="hidden" name="MAX_FILE_SIZE" value="20000000" /><input class="photo" type="file" name="image"></td>
            </tr>
            <tr colspan="2">
                <td><img src="/sakura/img/goods/'.getArray()['image'].'" class="result"></td>
            </tr>
        </table>
        <input type="submit" name="change" value="Изменить">
        <input type="submit" name="delete" value="Удалить">
        </form>
        ';

        
    }
    elseif ($_GET['admin']=='add') {
        echo '
        <h2>Добавление записи</h2>
        <form method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Название</td>
                <td><input type="text" name="description"></td>
            </tr>
            <tr>
                <td>Цена</td>
                <td><input type="text" name="price"></td>
            </tr>
            <tr>
                <td>Тип товара</td>
                <td>
                <select name="typeofgood">
                    <option value="1">Букет</optionvalue=>
                    <option value="2">Композиция</option>
                    <option value="3">Японские растения</option>
                    <option value="4">Комнатные расения</option>
                </select>
                </td>
            </tr>
            <tr>
                <td>Количество</td>
                <td><input type="text" name="quantity"></td>
            </tr>
            <tr>
                <td>Повод</td>
                <td>
                <select name="povod">
                    <option value="1september">1 сентября</optionvalue=>
                    <option value="14february">14 февраля</option>
                    <option value="8mart">8 марта</option>
                    <option value="bezpovoda">Без повода</option>
                    <option value="vipusknoy">Выпускной</option>
                    <option value="yearday">Годовщина</option>
                    <option value="motherday">День матери</option>
                    <option value="birthday">День рождения</option>
                    <option value="teacherday">День учителя</option>
                    <option value="prosti">Извинение</option>
                    <option value="svadba">Свадьба</option>
                    <option value="svidanie">Свидание</option>
                    <option value="yubilei">Юбилей</option>
                    <option value="night">Классика</option>
                    <option value="udivlenie">Удивить</option>
                </select>
                </td>
            </tr>
            <tr>
                <td>Цвет</td>
                <td>
                <select name="color">
                    <option value="1">белый</option>
                    <option value="2">голубой</option>
                    <option value="3">желтый</option>
                    <option value="4">зеленый</option>
                    <option value="5">красный</option>
                    <option value="6">кремовый</option>
                    <option value="7">микс</option>
                    <option value="8">оранжевый</option>
                    <option value="9">розовый</option>
                    <option value="10">фиолетовый</option>
                </select>
                </td>
            </tr>
            <tr>
                <td>Изображение</td>
                <td><input type="hidden" name="MAX_FILE_SIZE" value="20000000" /><input class="photo" type="file" name="image"></td>
            </tr>
            <tr colspan="2">
                <td><img class="result"></td>
            </tr>
        </table>
        <input type="submit" name="save" value="Save">
        </form>
        ';
        
            if(isset($_POST['save'])) {
                if (($_POST['quantity']!='') && ($_POST['description']!='') && ($_POST['price']!='')) {
                    $uploaddir = 'img/goods/';
                    $uploadfile = $uploaddir . basename($_FILES['image']['name']);
                    $description = $_POST['description'];
                    $price = $_POST['price'];
                    $typeofgood = $_POST['typeofgood'];
                    $image = $_FILES['image']['name'];
                    $quantity = $_POST['quantity'];
                    $povod = $_POST['povod'];
                    $color = $_POST['color'];
                    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
                        echo "Файл корректен и был успешно загружен. Запись добавлена!\n";
                        $pdo->query("INSERT INTO public.goods (description, price, typeofgood, image, quantity, povod, color) VALUES ('$description', $price, '$typeofgood', '$image', $quantity, '$povod', $color)");
                    } else {
                        echo "Картинка не была загружена!\n";
                    }
                }else{
                echo 'Введите все данные!';
                }
        }
        
    echo '</div>';






}
echo '<script language="javascript"> 
        FReader = new FileReader();
        
        // событие, когда файл загрузится
        FReader.onload = function(e) {
            document.querySelector(".result").src = e.target.result;};
        
        // выполнение функции при выборки файла
        document.querySelector(".photo").addEventListener("change", loadImageFile);
        
        // функция выборки файла
        function loadImageFile() {
            var file = document.querySelector(".photo").files[0];
            FReader.readAsDataURL(file);}
    </script> ';
}