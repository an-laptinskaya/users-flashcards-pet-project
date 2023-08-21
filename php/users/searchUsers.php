<?php

require_once '../../config/DBConnection.php';

$db = new DBConnection();

$firstOrLastName = $db->connection->real_escape_string($_GET['ins_sh_name']);

$searchUserInDB = "SELECT `users_info`.`user_id`, `users_info`.`first_name`, `users_info`.`last_name`, `users_info`.`city_id`, `users_info`.`user_img`, `cities_info`.`city` FROM `users_info` INNER JOIN `cities_info` ON `users_info`.`city_id` = `cities_info`.`city_id` WHERE `first_name` = '$firstOrLastName' OR `last_name` = '$firstOrLastName';";
$response = mysqli_fetch_all($db->connection->query($searchUserInDB), MYSQLI_ASSOC);

echo json_encode($response, JSON_UNESCAPED_UNICODE);
die();

?>