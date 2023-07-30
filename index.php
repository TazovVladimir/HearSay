<?php
include('connect.php');
session_start();
$result_rev = mysqli_query($conn, "SELECT * FROM `reviews` ");
$result_goods = mysqli_query($conn, "SELECT * FROM `goods` ");
$result_promotion = mysqli_query($conn, "SELECT * FROM `goods` WHERE goods_new_price != 0");
$result_goods_call = mysqli_query($conn, "SELECT * FROM `goods` ");
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
    <title>HEARSAY</title>
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
                    <div class="to-acc auth-true">
                        <a href="admin.php">
                            <span class="to-acc-avatar">
                                <img src="img/avatar1.jpg" alt="admin-avatar">
                            </span>
                            <span class="to-acc-name">
                                Admin
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
        
        <section class="slider" id="promotion">
            <div class="container">
                <div class="sliders">
                    <ul id="slider-main" class="slider-main">
                        <?php
                        while ($promotion = mysqli_fetch_assoc($result_promotion)) {
                            ?>
                            <li class="slider-item">
                                <div class="slider-item-left">
                                    <span class="promotion-wrpapper">
                                        <?php
                                        if ($promotion['goods_old_price'] != 0) {
                                            echo "
                                                <span class='promotion'>
                                                    Акция
                                                </span>
                                            ";
                                            echo "
                                            <span class='promotion-value'>";
                                            $discount = round(100 - ($promotion['goods_new_price'] / $promotion['goods_old_price']) * 100);
                                            echo '-' . $discount . '%';
                                            echo "</span>
                                            ";
                                        }
                                        ?>
                                    </span>
                                    <p class="slider-item-name">
                                        <?php echo $promotion['goods_title']; ?>
                                    </p>
                                    <span class="slider-item-text">
                                        <?php echo $promotion['goods_text']; ?>
                                    </span>
                                    <span class="price-wrapper">
                                        <?php
                                        if ($promotion['goods_old_price'] == 0) {
                                            echo '
                                            <span class="new-price">';
                                            echo $promotion["goods_new_price"] . " р";
                                            echo '</span>
                                        ';
                                        } else {
                                            echo '
                                        <span class="old-price">';
                                            echo $promotion["goods_old_price"] . " р";
                                            echo '</span>
                                    ';
                                            echo "
                                        <span class='new-price'>";
                                            echo $promotion['goods_new_price'] . ' р';
                                            echo "</span>
                                    ";
                                        }
                                        ?>
                                    </span>
                                    <div class="btn-border">
                                        <a href="#callBack">
                                            <span>
                                                Выбрать
                                            </span>
                                        </a>
                                    </div>
                                </div>
                                <div class="slider-item-right">
                                    <?php echo '<img src="data:image/png;base64,' . base64_encode($promotion['goods_img']) . '"/>'; ?>
                                </div>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                    <span id="arr-left" class="arr-left">
                        <img src="img/arr_left.svg" alt="arr-left">
                    </span>
                    <span id="arr-right" class="arr-right">
                        <img src="img/arr_right.svg" alt="arr-right">
                    </span>
                </div>
            </div>
        </section>

        <section class="about" id="about">
            <div class="container">
                <h2 class="h2-title">
                    HEARSAY
                </h2>
                <span class="h2-title-text">
                    наша компания
                </span>
                <div class="about-wrapper">
                    <div class="about-left">
                        <img src="img/about-img.png" alt="about-img">
                    </div>
                    <div class="about-right">
                        <span class="about-comp-title">hearsay</span>
                        <p class="about-title">
                            Наслаждайтесь музыкой
                        </p>
                        <p class="about-text">
                            В нашем интернет магазине Вы можете купить понравившийся товар максимально комфортно. Наш
                            каталог включает в себя более 15 000 товаров. Для каждого товара подготовлено подробное
                            описание и характеристики. Основные направления представленной аудиотехники: наушники
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="goods" id="goods">
            <div class="container">
                <h2 class="h2-title">
                    Товары
                </h2>
                <span class="h2-title-text">
                    товары нашей компании
                </span>
                <ul class="goods-ul">
                    <?php
                    while ($goods = mysqli_fetch_assoc($result_goods)) {
                        ?>
                        <li class="goods-item">
                            <?php
                            if ($goods['goods_new_price'] != 0) {
                                echo "
                                <span class='promotion-value promotion-right'>";
                                $discount = round(100 - ($goods['goods_new_price'] / $goods['goods_old_price']) * 100);
                                echo '-' . $discount . '%';
                                echo "</span>
                                ";
                            }
                            ?>
                            <div class="goods-item-img-wrapper">
                                <?php echo '<img src="data:image/png;base64,' . base64_encode($goods['goods_img']) . '"/>'; ?>
                            </div>
                            <span class="goods-item-title">
                                <?php echo $goods['goods_title']; ?>
                            </span>
                            <span class="price-wrapper">
                                <?php
                                if ($goods['goods_new_price'] == 0) {
                                    echo '
                                    <span class="new-price">';
                                    echo $goods["goods_old_price"] . " р";
                                    echo '</span>
                                ';
                                } else {
                                    echo '
                                <span class="old-price">';
                                    echo $goods["goods_old_price"] . " р";
                                    echo '</span>
                            ';
                                    echo "
                                <span class='new-price'>";
                                    echo $goods['goods_new_price'] . ' р';
                                    echo "</span>
                            ";
                                }
                                ?>

                            </span>
                            <ul class="par-wrapper">
                                <li>
                                    <span class="par">
                                        передача сигнала:
                                    </span>
                                    <span class="par-value">
                                        <?php echo $goods['par_1']; ?>
                                    </span>
                                </li>
                                <li>
                                    <span class="par">
                                        цвет:
                                    </span>
                                    <span class="par-value">
                                        <?php echo $goods['par_2']; ?>
                                    </span>
                                </li>
                                <li>
                                    <span class="par">
                                        микрофон:
                                    </span>
                                    <span class="par-value">
                                        <?php echo $goods['par_3']; ?>
                                    </span>
                                </li>
                                <li>
                                    <span class="par">
                                        чувствительность:
                                    </span>
                                    <span class="par-value">
                                        <?php echo $goods['par_4'] . ' дБ'; ?>
                                    </span>
                                </li>
                            </ul>
                            <div class="btn-border max">
                                <a href="#callBack">
                                    <span>
                                        Выбрать
                                    </span>
                                </a>
                            </div>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </section>

        <section class="reviews" id="reviews">
            <div class="container">
                <h2 class="h2-title">
                    Отзывы
                </h2>
                <span class="h2-title-text">
                    отзывы клиентов
                </span>
                <ul class="reviews-ul">
                    <?php
                    while ($rev = mysqli_fetch_assoc($result_rev)) {
                        ?>
                        <li class="reviews-item">
                            <div class="reviews-item-img-wrapper">
                                <?php echo '<img src="data:image/png;base64,' . base64_encode($rev['avatar']) . '"/>'; ?>
                            </div>
                            <span class="reviews-item-par">
                                <span class="reviews-item-name">
                                    <?php echo $rev['reviews_name']; ?>
                                </span>
                                <span class="reviews-item-text">
                                    <?php echo $rev['reviews_text']; ?>
                                </span>
                            </span>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </section>

        <section class="post-rew-form">
            <div class="container-form">
                <h2 class="h2-title">
                    Оставить отзыв
                </h2>
                <span class="h2-title-text">
                    заполните форму для отзыва
                </span>
                <form class="post-rew-form-form" action="rev-form.php" method="POST" enctype='multipart/form-data'>
                    <div class="post-rew-form-form-item">
                        <label for="post-rew-name">
                            <span>Ваше имя:</span>
                            <input name="reviews_name" required id="post-rew-name" type="text" placeholder="Николай">
                        </label>
                    </div>
                    <div class="post-rew-form-form-item">
                        <label for="post-rew-text">
                            <span>Текст отзыва:</span>
                            <input name="reviews_text" required id="post-rew-text" type="text"
                                placeholder="Все отлично!">
                        </label>
                    </div>
                    <div class="post-rew-form-form-item">
                        <label for="post-rew-photo">
                            <span>Ваша фотография:</span>
                            <input name="avatar" required id="post-rew-photo" type="file">
                        </label>
                    </div>
                    <button class="btn-full" type="submit">
                        Отправить
                    </button>
                </form>
            </div>
        </section>

        <section class="call-back" id="callBack">
            <span id="msg-succes" class="msg-succes">
                <span class="msg-succes-msg">
                    Ваша заявка отправлена!
                </span>
                <span id="close" class="close">x</span>
            </span>
            <div class="container-call">
                <div class="call-left">
                    <h2 class="h2-title">
                        Хотите оставить заявку?
                    </h2>
                    <span class="h2-title-text">
                        заполните форму для заявки
                    </span>
                    <script>
                        $(document).ready(function () {
                            $('#myForm').submit(function (event) {
                                event.preventDefault();
                                var formData = $(this).serialize();
                                $.ajax({
                                    type: 'POST',
                                    url: $(this).attr('action'),
                                    data: formData,
                                    success: function (response) {
                                        var show = $('#msg-succes').addClass('msg-succes-show');
                                        $("form#myForm").trigger('reset');
                                    },
                                    error: function (xhr, status, error) {
                                        alert('Произошла ошибка: ' + error);
                                    }
                                });
                            });
                        });
                        $('#close').on('click', function () {
                            $("#msg-succes").removeClass("msg-succes-show");
                        });
                    </script>
                    <form id="myForm" class="post-call-form-form" action="call-form.php" method="POST">
                        <div class="post-call-form-form-item">
                            <label for="post-call-name">
                                <span>Ваше имя:</span>
                                <input name="call_name" required id="post-call-name" type="text" placeholder="Вася">
                            </label>
                        </div>
                        <div class="post-call-form-form-item">
                            <label for="post-call-email">
                                <span>Ваша почта:</span>
                                <input name="call_email" required id="post-call-email" type="email"
                                    placeholder="example@mail.ru">
                            </label>
                        </div>
                        <div class="post-call-form-form-item">
                            <label for="post-call-text">
                                <span>Вид заявки:</span>
                                <select name="goods_title">
                                    <?php
                                    while ($call_option = mysqli_fetch_assoc($result_goods_call)) {
                                        ?>
                                        <option required value="
                                        <?php echo $call_option['goods_title'] ?>
                                    ">
                                            <?php echo $call_option['goods_title'] ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </label>
                        </div>
                        <button class="btn-full" type="submit">
                            Отправить
                        </button>
                    </form>
                </div>
                <div class="call-right">
                    <img src="img/call-img.png" alt="call-img">
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
    <script src="js/index.js"></script>
</body>

</html>