<?php
include('connect.php');
session_start();
if (!($_SESSION['admin'])) {
    header('Location: index.php');
}
$call_back = "SELECT * FROM call_back";
$revs = "SELECT * FROM reviews";
$goods = "SELECT * FROM goods";
$promotions = "SELECT * FROM `goods` WHERE goods_new_price != 0";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link type="image/x-icon" href="favicon.ico" rel="shortcut icon">
    <script src="https://code.jquery.com/jquery-3.6.4.js"
        integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">
    <title>Admin</title>
</head>

<body>
    <header id="header">
        <div class="container">
            <nav class="main-nav">
                <ul class="nav">
                    <li class="nav-item-logo">
                        <a class="nav-item-link" href="index.php#header">
                            <img src="img/logo.svg" alt="logo">
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-item-link" href="index.php#header">
                            Главная
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-item-link" href="index.php#promotion">
                            Акции
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-item-link" href="index.php#about">
                            О нас
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-item-link" href="index.php#goods">
                            Товары
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-item-link" href="index.php#reviews">
                            Отзывы
                        </a>
                    </li>
                </ul>
                <?php
                if (!($_SESSION['admin'])) {
                    echo '
                    <div class="to-acc auth-false">
                        <a href="auth.php">
                            <span>
                                Войти
                            </span>
                        </a>
                    </div>
                    ';
                } else {
                    echo '
                    <div class="to-acc auth-false">
                        <a href="logout.php">
                        <span>
                            Выйти
                        </span>
                </a>
                    </div>
                    ';
                }
                ?>
            </nav>
        </div>
    </header>
    <main>
        <section>
            <div class="container">
                <h2 class="h2-title">
                    Админ панель - обратная связь
                </h2>
                <span class="h2-title-text">
                    функционал админ панели
                </span>
                <div class="admin-div">
                    <?php
                    if ($result = $conn->query($call_back)) {
                        $rowsCount = $result->num_rows;
                        echo "<p class='reviews-item-name'>Данные об обратной связи: $rowsCount</p>";
                        echo "<table class='table'><tr><th>Id</th><th>Имя</th><th>Почта</th><th>Вид заявки</th><th>Действие</th></tr>";
                        foreach ($result as $row) {
                            echo "<tr>";
                            echo "<td>" . $row["id"] . "</td>";
                            echo "<td>" . $row["call_name"] . "</td>";
                            echo "<td>" . $row["call_email"] . "</td>";
                            echo "<td>" . $row["goods_title"] . "</td>";
                            echo "<td><form action='delete.php' method='post'>
                                  <input type='hidden' name='id' value='" . $row["id"] . "' />
                                  <input class='btn' type='submit' value='Удалить'>
                          </form></td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "Ошибка: " . $conn->error;
                    }
                    ?>
                </div>

            </div>
        </section>

        <section>
            <div class="container">
                <h2 class="h2-title">
                    Админ панель - отзывы
                </h2>
                <span class="h2-title-text">
                    функционал админ панели
                </span>
                <div class="admin-div">
                    <?php
                    if ($rev = $conn->query($revs)) {
                        $rowsCount = $rev->num_rows;
                        echo "<p class='reviews-item-name'>Данные об отзывах: $rowsCount</p>";
                        echo "<table class='table'><tr><th>Id</th><th>Имя</th><th>Текст</th><th>Действие</th></tr>";
                        foreach ($rev as $row) {
                            echo "<tr>";
                            echo "<td>" . $row["id"] . "</td>";
                            echo "<td>" . $row["reviews_name"] . "</td>";
                            echo "<td>" . $row["reviews_text"] . "</td>";
                            echo "<td><form action='delete-rev.php' method='post'>
                                  <input type='hidden' name='id' value='" . $row["id"] . "' />
                                  <input class='btn' type='submit' value='Удалить'>
                          </form></td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "Ошибка: " . $conn->error;
                    }
                    ?>
                </div>
            </div>
        </section>
        <section>
            <div class="container">
                <h2 class="h2-title">
                    Админ панель - товары
                </h2>
                <span class="h2-title-text">
                    функционал админ панели
                </span>
                <div class="admin-div">
                    <div class="btn-add">
                        <a href="add-goods.php">
                            Добавить новые товары
                        </a>
                    </div>
                    <?php
                    if ($goodss = $conn->query($goods)) {
                        $rowsCount = $goodss->num_rows;
                        echo "<p class='reviews-item-name'>Данные о товарах: $rowsCount</p>";
                        echo "<table class='table'><tr><th>Id</th><th>Картинка</th><th>Название</th><th>Старая цена</th><th>Новая цена</th><th>Текст</th><th>Сигнал</th><th>Цвет</th><th>Микрофон</th><th>Чувствительность</th><th>Действие</th><th>Действие</th></tr>";
                        foreach ($goodss as $row1) {
                            echo "<tr>";
                            echo "<td>" . $row1["id"] . "</td>";
                            echo '<td><img style="width: 100px; height: 120px; object-fit:contain;" src="data:image/png;base64,' . base64_encode($row1['goods_img']) . '"/></td>';
                            echo "<td>" . $row1["goods_title"] . "</td>";
                            echo "<td>" . $row1["goods_old_price"] . "</td>";
                            echo "<td>" . $row1["goods_new_price"] . "</td>";
                            echo "<td>" . $row1["goods_text"] . "</td>";
                            echo "<td>" . $row1["par_1"] . "</td>";
                            echo "<td>" . $row1["par_2"] . "</td>";
                            echo "<td>" . $row1["par_3"] . "</td>";
                            echo "<td>" . $row1["par_4"] . "</td>";
                            echo "<td><a class='btn btn-edit' href='edit-goods.php?id=" . $row1["id"] . "'>Изменить</a></td>";
                            echo "<td><form action='delete-goods.php' method='post'>
                                  <input type='hidden' name='id' value='" . $row1["id"] . "' />
                                  <input class='btn' type='submit' value='Удалить'>
                          </form></td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "Ошибка: " . $conn->error;
                    }
                    ?>
                </div>
            </div>
        </section>
        <section>
            <div class="container">
                <h2 class="h2-title">
                    Админ панель - акционные товары (слайдер)
                </h2>
                <span class="h2-title-text">
                    список акционных товаров
                </span>
                <div class="admin-div">
                    <?php
                    if ($promotion = $conn->query($promotions)) {
                        $rowsCount = $promotion->num_rows;
                        echo "<p class='warning'>!!!!Внимание, чтобы товар стал акционным измените в форме выше значение --новая цена--, если хотите чтобы товар стал не акционным измените --новая цена-- на значение -0-</p>";
                        echo "<p class='reviews-item-name'>Данные об акционных товарах: $rowsCount</p>";
                        echo "<table class='table'><tr><th>Id</th><th>Картинка</th><th>Название</th><th>Старая цена</th><th>Новая цена</th><th>Текст</th></tr>";
                        foreach ($promotion as $row1) {
                            echo "<tr>";
                            echo "<td>" . $row1["id"] . "</td>";
                            echo '<td><img style="width: 100px; height: 120px; object-fit:contain;" src="data:image/png;base64,' . base64_encode($row1['goods_img']) . '"/></td>';
                            echo "<td>" . $row1["goods_title"] . "</td>";
                            echo "<td>" . $row1["goods_old_price"] . "</td>";
                            echo "<td>" . $row1["goods_new_price"] . "</td>";
                            echo "<td>" . $row1["goods_text"] . "</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "Ошибка: " . $conn->error;
                    }
                    ?>
                </div>
            </div>
        </section>
    </main>
    <footer>
        <span class="footer-logo">
            <a href="index.php#header">
                <img src="img/logo-footer.svg" alt="footer-logo">
            </a>
        </span>
        <ul class="footer-ul">
            <li class="footer-item">
                <a href="index.php#header">
                    Главная
                </a>
            </li>
            <li class="footer-item">
                <a href="index.php#promotion">
                    Акции
                </a>
            </li>
            <li class="footer-item">
                <a href="index.php#about">
                    О нас
                </a>
            </li>
            <li class="footer-item">
                <a href="index.php#goods">
                    товары
                </a>
            </li>
            <li class="footer-item">
                <a href="index.php#reviews">
                    Отзывы
                </a>
            </li>
        </ul>
    </footer>
</body>

</html>