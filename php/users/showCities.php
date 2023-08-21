<?php

require_once 'config/DBConnection.php';

$db = new DBConnection();

$getCitiesFromDB = "SELECT * FROM `cities_info`";
$response = mysqli_fetch_all($db->connection->query($getCitiesFromDB), MYSQLI_ASSOC);

foreach ($response as $value) {
    $cityName = $value['city'];
    $cityId = $value['city_id'];
    echo "<option value='$cityId'>$cityName</option>";
}

?>