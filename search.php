<?php

require_once "config/Cookie.php";
$cookieName = 'page3';
$cookieForPage3 = new Cookie($cookieName);

?>

<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="shortcut icon" href="favicon/search.ico" type="image/x-icon">
    <title>Search</title>
  </script>
  </head>
  <body>

    <div class="py-2 bg-light">
      <div class="container">
        <ul class="nav nav-pills">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="index.php">Города</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="users.php">Пользователи</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="search.php">Поиск</a>
          </li>
        </ul>
      </div>
    </div>

    <div class="container">

        <div class="row">
            <div class="col-xxl-6 col-xl-8 col-sm-12">
            <div class="post card my-3">
                <div class="card-body">
                <h3 class="postcontent card-title">Общее количество загрузок страниц = 
                  <b>
                    <?php
                      echo $_COOKIE['page1'] + $_COOKIE['page2'] + $_COOKIE['page3'];
                    ?>
                  </b>
                </h3>
                <h4 class="postbottom card-subtitle text-muted"> Вы посещали эту страницу 
                  <b>
                    <?php
                    echo $cookieForPage3->countIncrement();
                    ?>
                  </b> раз</h4>
                </div>
            </div>
            </div>
        </div>

        <form id="search-form">
            <h4>Поиск по имени или фамилии пользователя</h4>
            <div class="row">
                <div class="col-lg-4 col-mb-6 col-sm-10 my-2">
                    <input class="form-control" type="search" pattern="[A-Za-zА-Яа-яЁё]{3,40}" name="ins_sh_name" required placeholder="Введите запрос">
                </div>
                <div class="col-sm-2 my-2">
                    <input class="btn btn-outline-primary" type="submit" name="sub_sh_name" value="Поиск">
                </div>
            </div>
        </form>

        <div class="list-of-users">
          <div class="row">

          </div>
        </div>
    </div>

    <script src="js/jquery-3.7.0.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/usersScript.js"></script>
  </body>
</html>
