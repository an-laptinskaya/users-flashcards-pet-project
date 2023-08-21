<?php

require_once '../../config/DBConnection.php';

$db = new DBConnection();

$userId = $db->connection->real_escape_string($_POST['user_id']);
$userFirstName = $db->connection->real_escape_string($_POST['edit_text_name']);
$userLastName = $db->connection->real_escape_string($_POST['edit_text_lastname']);
$cityId = $db->connection->real_escape_string($_POST['sel_user_city']);
$userImg = $db->connection->real_escape_string($_FILES['edit_img']['name']);
$currentUserImg = $db->connection->real_escape_string($_POST['current_user_img']);

if (!$userImg) {
    $userImg = $currentUserImg;
}
else{
    unlink('../../img/' . $currentUserImg);
}

$editCityInDB = "UPDATE `users_info` SET `first_name`='$userFirstName',`last_name`='$userLastName',`city_id`='$cityId',`user_img`='$userImg' WHERE `user_id` = '$userId';";
$db->connection->query($editCityInDB);

if ($_FILES['edit_img']) {
    $file_tmp = $_FILES['edit_img']['tmp_name'];
    move_uploaded_file($file_tmp, "../../img/" . $_FILES['edit_img']['name']);
}

header('location: ' . $_SERVER['HTTP_REFERER']);
exit;

?>