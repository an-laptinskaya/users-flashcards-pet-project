<?php

require_once '../../config/DBConnection.php';

$db = new DBConnection();

$getCitiesFromDB = "SELECT * FROM `cities_info`";
$response = mysqli_fetch_all($db->connection->query($getCitiesFromDB), MYSQLI_ASSOC);

echo json_encode($response, JSON_UNESCAPED_UNICODE);
die();

?>