<?php

require_once '../../config/DBConnection.php';

$db = new DBConnection();

$cityFilter = $db->connection->real_escape_string($_GET['cityFilter']);

$cityFilterFromDb = "SELECT `users_info`.`user_id`, `users_info`.`first_name`, `users_info`.`last_name`, `users_info`.`city_id`, `users_info`.`user_img`, `cities_info`.`city` FROM `users_info` INNER JOIN `cities_info` ON `users_info`.`city_id` = `cities_info`.`city_id` WHERE `users_info`.`city_id` = '$cityFilter';";
$response = mysqli_fetch_all($db->connection->query($cityFilterFromDb), MYSQLI_ASSOC);

echo json_encode($response, JSON_UNESCAPED_UNICODE);
die();

?>