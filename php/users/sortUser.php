<?php

require_once '../../config/DBConnection.php';

$db = new DBConnection();

$sortField = $db->connection->real_escape_string($_GET['sort_field']);
$sortDirection = $db->connection->real_escape_string($_GET['sort_direction']);

$sortUserInDB = "SELECT `users_info`.`user_id`, `users_info`.`first_name`, `users_info`.`last_name`, `users_info`.`city_id`, `users_info`.`user_img`, `cities_info`.`city` FROM `users_info` INNER JOIN `cities_info` ON `users_info`.`city_id` = `cities_info`.`city_id` ORDER BY `$sortField` $sortDirection;";
$response = mysqli_fetch_all($db->connection->query($sortUserInDB), MYSQLI_ASSOC);

echo json_encode($response, JSON_UNESCAPED_UNICODE);
die();

?>