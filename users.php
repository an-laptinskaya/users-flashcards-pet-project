<?php

require_once "config/Cookie.php";
$cookieName = 'page2';
$cookieForPage2 = new Cookie($cookieName);

?>

<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="shortcut icon" href="favicon/user.ico" type="image/x-icon">
    <title>Users</title>
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
            <a class="nav-link active" href="users.php">Пользователи</a>
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
                  echo $cookieForPage2->countIncrement();
                ?>
                </b> раз</h4>
              </div>
          </div>
          </div>
      </div>

      <h2>Список пользователей</h2>

      <div class="row my-3">

        <div class="col-sm-6 col-xs-12">
          <a class="btn btn-outline-primary" href="#down"id="scroll_down">Вниз</a>
          <div class="d-block my-3">
              <input class="btn btn-outline-success" type="button" name="ins" id="ins" value="Добавить" >
              <input class="btn btn-outline-dark" type="button" name="sort" id="sort" value="Сортировать" >
            </div>
        </div>
          
          <div class="col-sm-6 col-xs-12">
              <div class="filter">
                  <form action="" method="post">
                      <h4>Фильтр по Городам</h4>
                          <select class="form-select my-3" size="1" name="selsity_2" id="selsity_2">
                              <option disabled>Выберите город</option>
                              <?php
                                require_once 'php/users/showCities.php';
                              ?>   
                          </select>
                      <input class="btn btn-outline-dark" type="submit" name="sort_fc" id="sort_fc" value="Показать">
                  </form>
              </div>
          </div>

      </div>

      <div class="ins-sort">
        <div class="row">

        </div>
      </div>

      <div class="list-of-users">
          <div class="row">
          <?php
            require_once 'php/users/showUser.php';
          ?>
          </div>
      </div>

      <div class="p-3">
        <a class="btn btn-outline-primary" href="#up"id="scroll_up">Вверх</a>
      </div>

    </div>

    <script src="js/jquery-3.7.0.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/usersScript.js"></script>
  </body>
</html>
