<?php

require_once 'config/DBConnection.php';

$db = new DBConnection();

$showCityFromDB = "SELECT `users_info`.`user_id`, `users_info`.`first_name`, `users_info`.`last_name`, `users_info`.`city_id`, `users_info`.`user_img`, `cities_info`.`city` FROM `users_info` INNER JOIN `cities_info` ON `users_info`.`city_id` = `cities_info`.`city_id` ORDER BY `users_info`.`user_id`;";
$resultArray = mysqli_fetch_all($db->connection->query($showCityFromDB), MYSQLI_ASSOC);

foreach ($resultArray as $value) {
    
    $userId = $value['user_id'];
    $userFirstName = $value['first_name'];
    $userLastName = $value['last_name'];
    $cityId = $value['city_id'];
    $userCity = $value['city'];
    $userImg = $value['user_img'];
    
    echo "
        <div class=\"user col-sm-4\">
                <div class=\"card mb-3\" style=\"max-width: 540px;\">
                    <div class=\"row g-0\">
                        <div class=\"col-md-6\">
                        <img src=\"img/$userImg\" class=\"img-fluid rounded-start\" alt=\"Фотография\">
                        </div>
                        <div class=\"col-md-6\">
                        <div class=\"card-body\">
                            <h5 class=\"card-title\">$userFirstName $userLastName</h5>
                            <p class=\"card-text\">Город: $userCity</p>
                            <form class=\"mb-2\" action=\"php/users/deleteUser.php\" method=\"post\" >
                                <input type=\"hidden\" name=\"user_id\" value=\"$userId\" >
                                <input type=\"hidden\" name=\"user_img\" value=\"$userImg\">
                                <input class=\"del-user btn btn-outline-danger\" type=\"submit\" name=\"del_user\" value=\"Удалить\">
                            </form>
                            <div>
                                <input class=\"edit-user btn btn-outline-secondary\" type=\"button\" name=\"edit_user\" data-userid=\"$userId\" data-userfirstname=\"$userFirstName\" data-userlastname=\"$userLastName\" data-cityname=\"$userCity\" data-cityid=\"$cityId\" data-userimg=\"$userImg\" value=\"Редактировать\" >
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
    ";
}

?>