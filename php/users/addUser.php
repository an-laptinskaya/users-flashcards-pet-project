<?php

require_once '../../config/DBConnection.php';

$db = new DBConnection();

$userFirstName = $db->connection->real_escape_string($_POST['ins_text_name']);
$userLastName = $db->connection->real_escape_string($_POST['ins_text_lastname']);
$cityId = $db->connection->real_escape_string($_POST['sel_user_city']);
$userImg = $_FILES['ins_img']['name'];

$addUserToDB = "INSERT INTO `users_info`(`user_id`, `first_name`, `last_name`, `city_id`, `user_img`) VALUES (NULL, '$userFirstName','$userLastName','$cityId','$userImg');";
$db->connection->query($addUserToDB);

if (isset($_FILES['ins_img'])) {
    $file_tmp = $_FILES['ins_img']['tmp_name'];
    move_uploaded_file($file_tmp, "../../img/" . $_FILES['ins_img']['name']);
}

header('location: ' . $_SERVER['HTTP_REFERER']);
exit;

?>