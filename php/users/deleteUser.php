<?php

require_once '../../config/DBConnection.php';

$db = new DBConnection();

$userId = $db->connection->real_escape_string($_POST['user_id']);
$userImg = $db->connection->real_escape_string($_POST['user_img']);

$deleteFromDB = "DELETE FROM `users_info` WHERE `user_id` = '$userId'";
$db->connection->query($deleteFromDB);
unlink('../../img/' . $userImg);

header('location: ' . $_SERVER['HTTP_REFERER']);
exit;

?>