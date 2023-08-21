<?php

require_once '../../config/DBConnection.php';

$db = new DBConnection();

$sortField = $db->connection->real_escape_string($_GET['sort_field']);
$sortDirection = $db->connection->real_escape_string($_GET['sort_direction']);

$sortCityInDB = "SELECT * FROM `cities_info` ORDER BY `$sortField` $sortDirection;";
$response = mysqli_fetch_all($db->connection->query($sortCityInDB), MYSQLI_ASSOC);

echo json_encode($response, JSON_UNESCAPED_UNICODE);
die();

?>