<?php

require_once '../../config/DBConnection.php';

$db = new DBConnection();

$city_id = $db->connection->real_escape_string($_POST['city_id']);

$deleteFromDB = "DELETE FROM `cities_info` WHERE `city_id` = '$city_id'";
$db->connection->query($deleteFromDB);

header('location: ' . $_SERVER['HTTP_REFERER']);
exit;

?>