<?php

require_once "config/Cookie.php";
$cookieName = 'page1';
$cookieForPage1 = new Cookie($cookieName);

?>

<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="shortcut icon" href="favicon/cities.ico" type="image/x-icon">
    <title>Cities</title>
  </script>
  </head>
  <body>

    <div class="py-2 bg-light">
      <div class="container">
        <ul class="nav nav-pills">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Города</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="users.php">Пользователи</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="search.php">Поиск</a>
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
                    echo $cookieForPage1->countIncrement();
                    ?>
                </b> раз</h4>
            </div>
          </div>
        </div>
      </div>

      <h2 class="pe-3 d-inline">Список городов</h2>
      <div class="d-inline">
        <input class="btn btn-outline-success" type="button" id="ins" name="ins" value="Добавить" />
        <input class="btn btn-outline-dark" type="button" id="sort" name="sort" value="Сортировать" />
      </div>

      <div class="ins-sort">
        <div class="row">

        </div>
      </div>

      <div class="cities-list">
      <?php
        require_once 'php/cities/showCity.php';
      ?>
      </div>

    </div>

    <script src="js/jquery-3.7.0.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/citiesScript.js"></script>
  </body>
</html>
