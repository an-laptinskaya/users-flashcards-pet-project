// ФАЙЛ users.php

// Форма добавления пользователя
$('#ins').click(function(e){
    e.preventDefault();
    if($('div').hasClass('add-user'))
    {
        $('.add-user').remove();
    }
    else{
        $.ajax({
            url: 'php/users/getCities.php',
            type: 'POST',
            dataType: 'json',
            processDate: false,
            success: function(data){
                if(!data){
                    alert(`Ошибка!`);
                }
                else{
                    $('.ins-sort > .row').prepend(`
                        <div class="add-user col-xl-4 col-md-6 my-3">
                            <div class="card">
                                <div class="card-body">
                                <form action="php/users/addUser.php" method="post" enctype="multipart/form-data">
                                    <h5>Форма добавления пользователя</h5>
                                    <input class="form-control my-2" type="text" name="ins_text_name" required placeholder="Имя">
                                    <input class="form-control my-2" type="text" name="ins_text_lastname" required placeholder="Фамилия">
                                    <select class="sel-user-city form-select my-3" size="1" name="sel_user_city">
                                    <option disabled>Выберите город</option>
                                    </select>
                                    <input class="form-control my-2" type="file" accept="image/png, image/jpeg" name="ins_img">
                                    <input class="btn btn-outline-success" type="submit" value='Добавить' name="subm_ins_user" id="subm_ins_user">
                                    <input class="btn btn-outline-dark" type="button" value='Отмена' name="cancel_ins_user" id="cancel_ins_user">
                                </form>
                                </div>
                            </div>
                        </div>
                    `);
                    addOptionsInSelect(data);
                }
            }
        });   
    }
});

// Функция добавления городов в форму добавления пользователя
function addOptionsInSelect(data)
{
    data.forEach(element => {
        cityName = element['city'];
        cityId = element['city_id'];
        $('.sel-user-city').append(`
            <option value="${cityId}">${cityName}</option>
        `);
    });
}

// Удаление формы добавления пользователя
$('.ins-sort').on('click', '#cancel_ins_user', function(){
    $('.add-user').remove();
});

// Форма сортировки
$('#sort').click(function(){

    if($('div').hasClass('sort-field'))
    {
        $('.sort-field').remove();
    }
    else{
        $('.ins-sort > .row').prepend(`
            <div class="sort-field col-xl-4 col-md-6 my-3">
                <div class="card">
                    <div class="card-body">
                        <form id="sort_form">
                            <div class="row">
                                <div class='col-md-6'>
                                <h5>Поле сортировки</h5>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sort_field" id="sort_by_id" value="user_id" checked>
                                    <label class="form-check-label" for="sort_by_id">id</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sort_field" id="sort_by_name" value="first_name" >
                                    <label class="form-check-label" for="sort_by_name">Имя</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sort_field" id="sort_by_lastname" value="last_name" >
                                    <label class="form-check-label" for="sort_by_lastname">Фамилия</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sort_field" id="sort_by_city" value="city">
                                    <label class="form-check-label" for="sort_by_city">Название Города</label>
                                </div>
                                </div>
                                <div class="col-md-6">
                                <h5>Направление сортировки</h5>
                                <div class="form-check">
                                    <input type="radio" name="sort_direction" id="sort_by_asc" value="ASC" checked>
                                    <label class="form-check-label" for="sort_by_asc">Возрастание</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" name="sort_direction" id="sort_by_desc" value="DESC">
                                    <label class="form-check-label" for="sort_by_desc">Убывание</label>
                                </div>
                                </div>
                            </div>
                            <input class="btn btn-outline-success" type="submit" name="submit_sort_user" id="submit_sort_user" value='Сортировать'>
                            <input class="btn btn-outline-dark" type="button" name="cancel_sort_user" id="cancel_sort_user" value='Отмена'>
                        </form>
                    </div>
                </div>
            </div>
        `);
    }

    // Подтверждение сортировки
    $('#sort_form').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: 'php/users/sortUser.php',
            type: 'GET',
            data: $(this).serialize(),
            dataType: 'json',
            processDate: false,
            success: function(data){
                if(!data){
                    alert(`Ошибка!`);
                }
                else{
                    showSortedUsers(data);
                }
            }
        });
    });
});

// Функция вывода сортированных пользователей
function showSortedUsers(data){
    $('.list-of-users > .row').empty();

    data.forEach(element => {
        userId = element['user_id'];
        userFirstName = element['first_name'];
        userLastName = element['last_name'];
        cityId = element['city_id'];
        userCity = element['city'];
        userImg = element['user_img'];
        $('.list-of-users > .row').append(`
            <div class=\"user col-sm-4\">
                <div class=\"card mb-3\" style=\"max-width: 540px;\">
                    <div class=\"row g-0\">
                        <div class=\"col-md-6\">
                        <img src=\"img/${userImg}\" class=\"img-fluid rounded-start\" alt=\"Фотография\">
                        </div>
                        <div class=\"col-md-6\">
                        <div class=\"card-body\">
                            <h5 class=\"card-title\">${userFirstName} ${userLastName}</h5>
                            <p class=\"card-text\">Город: ${userCity}</p>
                            <form class=\"mb-2\" action=\"php/users/deleteUser.php\" method=\"post\" >
                                <input type=\"hidden\" name=\"user_id\" value=\"${userId}\">
                                <input type=\"hidden\" name=\"user_img\" value=\"${userImg}\">
                                <input class=\"del-user btn btn-outline-danger\" type=\"submit\" name=\"del_user\" value=\"Удалить\">
                            </form>
                            <div>
                                <input class=\"edit-user btn btn-outline-secondary\" type=\"button\" name=\"edit_user\" data-userid=\"${userId}\" data-userfirstname=\"${userFirstName}\" data-userlastname=\"${userLastName}\" data-cityname=\"${userCity}\" data-cityid=\"${cityId}\" data-userimg=\"${userImg}\" value=\"Редактировать\" >
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        `);
    });
};

// Отмена сортировки
$('.ins-sort').on('click', '#cancel_sort_user', function(){
    $('.sort-field').remove();
});

// Удаление города
$('.list-of-users').on('click', '.del-user', function(){
    return confirm('Вы действительно хотите удалить пользователя?');
});

// Форма редактирования пользователя
$('.list-of-users').on('click', '.edit-user', function(e){
    userId = e.target.dataset.userid;
    userFirstName = e.target.dataset.userfirstname;
    userLastName = e.target.dataset.userlastname;
    userCity = e.target.dataset.cityname;
    userCityId = e.target.dataset.cityid;
    userImg = e.target.dataset.userimg;
    
    if($('div').hasClass('edit-user-form'))
    {
        $('.edit-user-form').remove();
    }
    else{
        $.ajax({
            url: 'php/users/getCities.php',
            type: 'POST',
            dataType: 'json',
            processDate: false,
            success: function(data){
                if(!data){
                    alert(`Ошибка!`);
                }
                else{
                    $('.list-of-users').prepend(`
                        <div class="edit-user-form col-xl-4 col-md-6 my-3">
                            <div class="card">
                                <div class="card-body">
                                <form action="php/users/editUser.php" method="post" enctype="multipart/form-data">
                                    <h5>Форма редактирования пользователя</h5>
                                    <input type="hidden" name="user_id" value="${userId}"/>
                                    <input class="form-control my-2" type="text" name="edit_text_name" required value="${userFirstName}">
                                    <input class="form-control my-2" type="text" name="edit_text_lastname" required value="${userLastName}">
                                    <select class="sel-user-city form-select my-3" size="1" name="sel_user_city">
                                    <option disabled>Выберите город</option>
                                    </select>
                                    <img width="100" src="img/${userImg}" alt="Фотография">
                                    <input type="hidden" name="current_user_img" value="${userImg}"/>
                                    <input class="form-control my-2" type="file" accept="image/png, image/jpeg" name="edit_img">
                                    <input class="btn btn-outline-success" type="submit" value='Подтвердить' name="subm_edit_user" id="subm_edit_user">
                                    <input class="btn btn-outline-dark" type="button" value='Отмена' name="cancel_edit_user" id="cancel_edit_user">
                                </form>
                                </div>
                            </div>
                        </div>
                    `);
                    data.forEach(element => {
                        cityName = element['city'];
                        cityId = element['city_id'];
                        if (cityId == userCityId) {
                            $('.sel-user-city').append(`
                            <option selected value="${cityId}">${cityName}</option>
                        `);
                        }
                        else{
                            $('.sel-user-city').append(`
                            <option value="${cityId}">${cityName}</option>
                        `);
                        }
                        
                    });
                }
            }
        });  
    }
});

// Отмена редактирования города
$('.list-of-users').on('click', '#cancel_edit_user', function(){
    $('.edit-user-form').remove();
});

// Фильтр по городам
$('#sort_fc').click(function(e){
    e.preventDefault();
    let cityFilter = $('#selsity_2').val();
    $.ajax({
        url: 'php/users/cityFilter.php',
        type: 'GET',
        data: {cityFilter: cityFilter},
        dataType: 'json',
        processDate: false,
        success: function(data){
            if(!data){
                alert(`Ошибка!`);
            }
            else{
                showSortedUsers(data);
            }
        }
    });
});

// Прокрутка страницы вниз
$('#scroll_down').click(function(){
    $('html, body').animate({scrollTop: $(document).height() - $(window).height()}, 600);
    return false;
});

// Прокрутка страницы вверх
$('#scroll_up').click(function(){
    $('html, body').animate({scrollTop: 0}, 600);
    return false;
});

// ФАЙЛ search.php

// Поиск пользователей по имени или фамилии
$('#search-form').submit(function(e){
    e.preventDefault();
    $.ajax({
        url: 'php/users/searchUsers.php',
        type: 'GET',
        data: $(this).serialize(),
        dataType: 'json',
        processDate: false,
        success: function(data){
            if(!data){
                alert(`Ошибка!`);
            }
            else{
                showSortedUsers(data);
            }
        }
    });
});