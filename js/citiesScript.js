// Форма добавления города
$('#ins').click(function(){

    if($('div').hasClass('add-city'))
    {
        $('.add-city').remove();
    }
    else{
        $('.ins-sort > .row').prepend(`
            <div class="add-city col-xl-4 col-md-6 my-3">
                <div class="card">
                    <div class="card-body">
                    <form action="php/cities/addCity.php" method="post">
                        <h5>Форма добавления города</h5>
                        <input class="form-control my-2" type="text" name="ins_text_city" required placeholder="Название города">
                        <input class="btn btn-outline-success" type="submit" value='Добавить' name="subm_ins_city" id="subm_ins_city">
                        <input class="btn btn-outline-dark" type="button" value='Отмена' name="cancel_ins_city" id="cancel_ins_city">
                    </form>
                    </div>
                </div>
            </div>
    `);
    }
});

// Удаление формы добавления города
$('.ins-sort').on('click', '#cancel_ins_city', function(){
    $('.add-city').remove();
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
                                    <input class="form-check-input" type="radio" name="sort_field" id="sort_by_id" value="city_id" checked>
                                    <label class="form-check-label" for="sort_by_id">id</label>
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
                            <input class="btn btn-outline-success" type="submit" name="submit_sort_city" id="submit_sort_city" value='Сортировать'>
                            <input class="btn btn-outline-dark" type="button" name="cancel_sort_city" id="cancel_sort_city" value='Отмена'>
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
            url: 'php/cities/sortCity.php',
            type: 'GET',
            data: $(this).serialize(),
            dataType: 'json',
            processDate: false,
            success: function(data){
                if(!data){
                    alert(`Ошибка!`);
                }
                else{
                    showSortedCities(data);
                }
            }
        })
    });
});

// Функция вывода сортированных городов
function showSortedCities(data){
    $('.cities-list').empty();

    data.forEach(element => {
        cityName = element['city'];
        cityId = element['city_id'];
        $('.cities-list').append(`
            <div class="cpcity card border-0 my-3">
                <div class="card-body">
                    <h4 class="card-title d-inline pe-4">${cityName}</h4>
                    <form class="d-inline" action="php/cities/deleteCity.php" method="post">
                    <input type="hidden" name="city_id" value="${cityId}"/>
                    <input class="del-city btn btn-outline-danger" type="submit" data-delid="${cityId}" name="del_city" value="Удалить"/>
                    </form>
                    <div class="d-inline">
                    <input class="edit-city btn btn-outline-secondary" type="button" data-delid="${cityId}" data-cityname="${cityName}" name="edit_city" value="Редактировать"/>
                    </div>
                </div>
            </div>
        `);
    });
};

// Отмена сортировки
$('.ins-sort').on('click', '#cancel_sort_city', function(){
    $('.sort-field').remove();
});

// Удаление города
$('.cities-list').on('click', '.del-city', function(){
    return confirm('Вы действительно хотите удалить город?');
});

// Форма редактирования города
$('.cities-list').on('click', '.edit-city', function(e){
    cityId = e.target.dataset.delid;
    cityName = e.target.dataset.cityname;
    if($('div').hasClass('edit-city-form'))
    {
        $('.edit-city-form').remove();
    }
    else{
        $('.cities-list').prepend(`
            <div class="edit-city-form col-xl-4 col-md-6 my-3">
                <div class="card">
                    <div class="card-body">
                    <form action="php/cities/editCity.php" method="post">
                        <h5>Форма редактирования города</h5>
                        <input class="form-control my-2" type="text" name="edit_text_city" required value="${cityName}">
                        <input type="hidden" name="city_id" value="${cityId}"/>
                        <input class="btn btn-outline-success" type="submit" value='Подтвердить' name="subm_edit_city" id="subm_edit_city">
                        <input class="btn btn-outline-dark" type="button" value='Отмена' name="cancel_edit_city" id="cancel_edit_city">
                    </form>
                    </div>
                </div>
            </div>
    `);
    }
});

// Отмена редактирования города
$('.cities-list').on('click', '#cancel_edit_city', function(){
    $('.edit-city-form').remove();
});