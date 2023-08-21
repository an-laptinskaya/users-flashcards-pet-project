<?php

require_once '../../config/DBConnection.php';

$db = new DBConnection();

$cityId = $db->connection->real_escape_string($_POST['city_id']);
$EditSityName = $db->connection->real_escape_string($_POST['edit_text_city']);

$editCityInDB = "UPDATE `cities_info` SET `city` = '$EditSityName' WHERE `city_id` = '$cityId'";
$db->connection->query($editCityInDB);

header('location: ' . $_SERVER['HTTP_REFERER']);
exit;

?>