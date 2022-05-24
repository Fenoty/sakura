<header>
    <div class="header-flex__main-container">
        <div>
            <a href="" id="delivery-text">Доставка по Москве</a>
        </div>
        <div>
            <img id="logo" src="/sakura/img/sakura2.png" alt="Сакура">
        </div>
        <table id="elements">
            <tr>
                <td><img class="Search" src="/sakura/img/buttons/Search.svg"></td>
                <td><img class="User" src="/sakura/img/buttons/User.svg"></td>
                <td><img class="ShoppingCart" src="/sakura/img/buttons/ShoppingCart.svg"></td>
            </tr>
        </table>
    </div>
    
    <form action="/sakura/database/search.php" class="search-button__search hidden" method="get">
        <input name="search" class="search-button__input" autocomplete="off" type="text" placeholder="Что ищем?">
        <input type="submit" class="search-button__submit" value="Найти">
    </form>

    <div class="search-list hidden">
        
        <script>
            let search_input = document.querySelector(".search-button__input");
            let search_list = document.querySelector(".search-list"); 
            
   
            let url = '/sakura/assets/post_search.php';
            let formData = new FormData();

            search_input.addEventListener("keyup", () => {
                if (search_input.value !="") {
                    formData.append('x', search_input.value);
                    fetch(url, { method: 'POST', body: formData })
                    .then(function (response) {
                        return response.text();
                    })
                    .then(function (body) {
                        search_list.innerHTML = body;
                    });
                }
                else{
                    search_list.innerHTML = "";
                }
            });     
        </script> 
        <?php
            include $_SERVER['DOCUMENT_ROOT']."/sakura/assets/post_search.php";
        ?>

    </div>
    <script src="/sakura/script/jquery-3.6.0.min.js"></script>
</header>