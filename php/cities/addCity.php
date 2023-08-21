<?php

require_once '../../config/DBConnection.php';

$db = new DBConnection();

$cityName = $db->connection->real_escape_string($_POST['ins_text_city']);

$addCityToDB = "INSERT INTO `cities_info`(`city_id`, `city`) VALUES (NULL, '$cityName')";
$db->connection->query($addCityToDB);

header('location: ' . $_SERVER['HTTP_REFERER']);
exit;

?>