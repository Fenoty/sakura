<nav class="minisort">  
<div class="left-side">
<?php
$URL = $_SERVER['REQUEST_URI'];
$url = '';
if (isset($_POST['povod'])) {
    $url = '&price_at='.$_POST['price_at'].'&price_to='.$_POST['price_to'].'&povod='.$_POST['povod'].'&color='.$_POST['color'];
    

    echo "<script>document.location.href='?page=1&sort=description&order=ASC".$url."';</script>";
}
else{
    $url='';
}
minisort();

function checkingPovod($value){
    if (isset($_GET['povod']) && $_GET['povod']==$value) {
        echo ' selected="selected" ';
    }
}
function checkingColor($value){
    if (isset($_GET['color']) && $_GET['color']==$value) {
        echo ' selected="selected" ';
    }
}
function inputPriceAt(){
    if (isset($_GET['price_at'])) {
        return ' value="'.$_GET['price_at'].'"';
    }
}
function inputPriceTo(){
    if (isset($_GET['price_to'])) {
        return ' value="'.$_GET['price_to'].'"';
    }
}

$short_url = substr(strstr($URL, '.php', true), strlen('/sakura/pages/kategories/'));
switch ($short_url) {
    case "buket":
        $pagetype = 1;
        break;
    case "kompozitsii":
        $pagetype = 2;
        break;
    case "japanflowers":
        $pagetype = 3;
        break;
    case "roomflowers":
        $pagetype = 4;
        break;
    default:
        $pagetype = 1;
        break;
}


function getMaxPrice(){
    global $pagetype;
    global $pdo;
    foreach($pdo->query("SELECT MAX(price) FROM goods WHERE typeofgood = '$pagetype'") as $max){
       echo $max['max']; 
    }
}

function getMinPrice(){
    global $pagetype;
    global $pdo;
    foreach($pdo->query("SELECT MIN(price) FROM goods WHERE typeofgood = '$pagetype'") as $min){
       echo $min['min']; 
     }
}
?>
</div>
<div class="right-side">
    
    <form class="form-right" method="post">
        <div class=filter-price__flex>
            <div class="filter-price">
                <span class="filter-price__text">от</span>
                    <input <?php inputPriceAt() ?> type="number" data-min="0" data-max="<?php getMaxPrice() ?>" placeholder="<?php getMinPrice() ?>" name="price_at" class="filter-price__input">
                <span class="filter-price__text">руб</span>
            </div>
            <div class="filter-price">
                <span class="filter-price__text">до</span>
                    <input <?php inputPriceTo() ?> type="number" data-min="0" data-max="<?php getMaxPrice() ?>" placeholder="<?php getMaxPrice() ?>" name="price_to" class="filter-price__input">
                <span class="filter-price__text">руб</span>
            </div>
        </div>
        <div class="selectors__flex">
            <div class="selectors">
                <label class="label-selector">Повод</label>
                <select name="povod">
                    <option value="0">Не выбрано</option>
                    <option <?php checkingPovod("1september") ?>value="1september">1 сентября</optionvalue=>
                    <option <?php checkingPovod("14february") ?>value="14february">14 февраля</option>
                    <option <?php checkingPovod("8mart")      ?>value="8mart">8 марта</option>
                    <option <?php checkingPovod("bezpovoda")  ?>value="bezpovoda">Без повода</option>
                    <option <?php checkingPovod("vipusknoy")  ?>value="vipusknoy">Выпускной</option>
                    <option <?php checkingPovod("yearday")    ?>value="yearday">Годовщина</option>
                    <option <?php checkingPovod("motherday")  ?>value="motherday">День матери</option>
                    <option <?php checkingPovod("birthday")   ?>value="birthday">День рождения</option>
                    <option <?php checkingPovod("teacherday") ?>value="teacherday">День учителя</option>
                    <option <?php checkingPovod("prosti")     ?>value="prosti">Извинение</option>
                    <option <?php checkingPovod("svadba")     ?>value="svadba">Свадьба</option>
                    <option <?php checkingPovod("svidanie")   ?>value="svidanie">Свидание</option>
                    <option <?php checkingPovod("yubilei")    ?>value="yubilei">Юбилей</option>
                    <option <?php checkingPovod("night")      ?>value="night">Ночь</option>
                    <option <?php checkingPovod("udivlenie")  ?>value="udivlenie">Удивить</option>
                </select>
            </div>
            <div class="selectors">
                <label class="label-selector">Цвет</label>
                <select name="color">
                    <option value='0'>Не выбрано</option>
                    <option <?php checkingColor('1') ?>value="1">белый</option>
                    <option <?php checkingColor('2') ?>value="2">голубой</option>
                    <option <?php checkingColor('3') ?>value="3">желтый</option>
                    <option <?php checkingColor('4') ?>value="4">зеленый</option>
                    <option <?php checkingColor('5') ?>value="5">красный</option>
                    <option <?php checkingColor('6') ?>value="6">кремовый</option>
                    <option <?php checkingColor('7') ?>value="7">микс</option>
                    <option <?php checkingColor('8') ?>value="8">оранжевый</option>
                    <option <?php checkingColor('9') ?>value="9">розовый</option>
                    <option <?php checkingColor('10') ?>value="10">фиолетовый</option>
                </select>
            </div>
        </div>
        <div class="buttons__flex">
            <a class="reset" href="?page=1">Сбросить</a>
            <input type="submit" class="show" value="Показать">
        </div>
    </form>
</div>
</nav>
<?php 


function minisort(){
    
        if (isset($_GET['povod'])) {
            if ($_GET['sort'] == 'description' && $_GET['order'] == 'DESC') {
                echo '<a href="?page='.$_GET['page'].'&sort=description&order=ASC&price_at='.$_GET['price_at'].'&price_to='.$_GET['price_to'].'&povod='.$_GET['povod'].'&color='.$_GET['color'].'"><span>По алфавиту &#709;</span></a>'; 
             }
             else if ($_GET['sort'] == 'description' && $_GET['order'] == 'ASC') {
                 echo '<a href="?page='.$_GET['page'].'&sort=description&order=DESC&price_at='.$_GET['price_at'].'&price_to='.$_GET['price_to'].'&povod='.$_GET['povod'].'&color='.$_GET['color'].'"><span>По алфавиту &#708;</span></a>'; 
             }
             else {
                 echo '<a href="?page='.$_GET['page'].'&sort=description&order=ASC&price_at='.$_GET['price_at'].'&price_to='.$_GET['price_to'].'&povod='.$_GET['povod'].'&color='.$_GET['color'].'"><span>По алфавиту &#709;</span></a>';
             }
             
         // Цена 
         
             if ($_GET['sort'] == 'price' && $_GET['order'] == 'DESC') {
                echo '<a href="?page='.$_GET['page'].'&sort=price&order=ASC&price_at='.$_GET['price_at'].'&price_to='.$_GET['price_to'].'&povod='.$_GET['povod'].'&color='.$_GET['color'].'"><span>По цене &#709;</span></a>'; 
             }
             else if ($_GET['sort'] == 'price' && $_GET['order'] == 'ASC') {
                 echo '<a href="?page='.$_GET['page'].'&sort=price&order=DESC&price_at='.$_GET['price_at'].'&price_to='.$_GET['price_to'].'&povod='.$_GET['povod'].'&color='.$_GET['color'].'"><span>По цене &#708;</span></a>'; 
             }
             else {
                 echo '<a href="?page='.$_GET['page'].'&sort=price&order=ASC&price_at='.$_GET['price_at'].'&price_to='.$_GET['price_to'].'&povod='.$_GET['povod'].'&color='.$_GET['color'].'"><span>По цене &#709;</span></a>';
             }
             
         
         // По наличию
             if ($_GET['sort'] == 'quantity' && $_GET['order'] == 'DESC') {
                 echo '<a href="?page='.$_GET['page'].'&sort=quantity&order=ASC&price_at='.$_GET['price_at'].'&price_to='.$_GET['price_to'].'&povod='.$_GET['povod'].'&color='.$_GET['color'].'"><span>По наличию &#709;</span></a>'; 
             }
             else if ($_GET['sort'] == 'quantity' && $_GET['order'] == 'ASC') {
                 echo '<a href="?page='.$_GET['page'].'&sort=quantity&order=DESC&price_at='.$_GET['price_at'].'&price_to='.$_GET['price_to'].'&povod='.$_GET['povod'].'&color='.$_GET['color'].'"><span>По наличию &#708;</span></a>'; 
             }
             else {
                 echo '<a href="?page='.$_GET['page'].'&sort=quantity&order=ASC&price_at='.$_GET['price_at'].'&price_to='.$_GET['price_to'].'&povod='.$_GET['povod'].'&color='.$_GET['color'].'"><span>По наличию &#709;</span></a>';
             }
        }
        elseif (isset($_GET['sort'])) {

        
// Название

            if ($_GET['sort'] == 'description' && $_GET['order'] == 'DESC') {
            echo '<a href="?page='.$_GET['page'].'&sort=description&order=ASC"><span>По алфавиту &#709;</span></a>'; 
            }
            else if ($_GET['sort'] == 'description' && $_GET['order'] == 'ASC') {
                echo '<a href="?page='.$_GET['page'].'&sort=description&order=DESC"><span>По алфавиту &#708;</span></a>'; 
            }
            else {
                echo '<a href="?page='.$_GET['page'].'&sort=description&order=ASC"><span>По алфавиту &#709;</span></a>';
            }
            
        // Цена 

            if ($_GET['sort'] == 'price' && $_GET['order'] == 'DESC') {
            echo '<a href="?page='.$_GET['page'].'&sort=price&order=ASC"><span>По цене &#709;</span></a>'; 
            }
            else if ($_GET['sort'] == 'price' && $_GET['order'] == 'ASC') {
                echo '<a href="?page='.$_GET['page'].'&sort=price&order=DESC"><span>По цене &#708;</span></a>'; 
            }
            else {
                echo '<a href="?page='.$_GET['page'].'&sort=price&order=ASC"><span>По цене &#709;</span></a>';
            }
            

        // По наличию
            if ($_GET['sort'] == 'quantity' && $_GET['order'] == 'DESC') {
                echo '<a href="?page='.$_GET['page'].'&sort=quantity&order=ASC"><span>По наличию &#709;</span></a>'; 
            }
            else if ($_GET['sort'] == 'quantity' && $_GET['order'] == 'ASC') {
                echo '<a href="?page='.$_GET['page'].'&sort=quantity&order=DESC"><span>По наличию &#708;</span></a>'; 
            }
            else {
                echo '<a href="?page='.$_GET['page'].'&sort=quantity&order=ASC"><span>По наличию &#709;</span></a>';
            }
        }

    else {
        echo '<a href="?page='.$_GET['page'].'&sort=description&order=ASC"><span>По алфавиту &#709;</span></a>';
        echo '<a href="?page='.$_GET['page'].'&sort=price&order=ASC"><span>По цене &#709;</span></a>';
        echo '<a href="?page='.$_GET['page'].'&sort=quantity&order=ASC"><span>По наличию &#709;</span></a>';
    }
    
}


    
?>