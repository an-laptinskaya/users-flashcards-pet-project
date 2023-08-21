<?php

require_once 'config/DBConnection.php';

$db = new DBConnection();

$showCityFromDB = "SELECT * FROM `cities_info`";
$resultArray = mysqli_fetch_all($db->connection->query($showCityFromDB), MYSQLI_ASSOC);

foreach ($resultArray as $value) {
    
    $cityName = $value['city'];
    $cityId = $value['city_id'];
    echo "
        <div class=\"cpcity card border-0 my-3\">
            <div class=\"card-body\">
            <h4 class=\"card-title d-inline pe-4\">$cityName</h4>
                <form class=\"d-inline\" action=\"php/cities/deleteCity.php\" method=\"post\">
                <input type=\"hidden\" name=\"city_id\" value=\"$cityId\" />
                <input class=\"del-city btn btn-outline-danger\" type=\"submit\" name=\"del_city\" value=\"Удалить\"/>
                </form>
                <div class=\"d-inline\"> 
                <input class=\"edit-city btn btn-outline-secondary\" type=\"button\" data-delid=\"$cityId\" data-cityname=\"$cityName\" name=\"edit_city\" value=\"Редактировать\"/>
                </div>
            </div>
        </div>
    ";
}

?>