<?php
include 'connect.php';
session_start();
if (!$_SESSION['admin']) {
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Добавление</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/style.css">
    <link type="image/x-icon" href="favicon.ico" rel="shortcut icon">
    <script src="https://code.jquery.com/jquery-3.6.4.js"
        integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">
</head>

<body>
    <main>
        <section>
            <div class="container-form">
                <h2 class="h2-title">
                    Добавление товара
                </h2>
                <span class="h2-title-text">
                    заполните форму для добавления
                </span>
                <form class="post-rew-form-form add" action="add-goods.php" method="POST" enctype="multipart/form-data">
                    <div class="post-rew-form-form-item">
                        <label>
                            <span>Картинка:</span>
                            <input name="goods_img" required type="file">
                        </label>
                    </div>
                    <div class="post-rew-form-form-item">
                        <label>
                            <span>Название:</span>
                            <input class="a" name="goods_title" required type="text" placeholder="EmitHear z1-2">
                        </label>
                    </div>
                    <div class="post-rew-form-form-item">
                        <label>
                            <span>Цена:</span>
                            <input class="a" name="goods_old_price" required type="number" placeholder="5000">
                        </label>
                    </div>
                    <div class="post-rew-form-form-item" style="display: none;">
                        <label>
                            <span>Новая цена:</span>
                            <input  class="a" name="goods_new_price" required type="number" value="0">
                        </label>
                    </div>
                    <div class="post-rew-form-form-item">
                        <label>
                            <span>Текст:</span>
                            <input class="a" name="goods_text" required type="text" placeholder="Отличные бюджетные наушники для студента, для обучения">
                        </label>
                    </div>
                    <div class="post-rew-form-form-item">
                        <label>
                            <span>Сигнал:</span>
                            <input class="a" name="par_1" required type="text" placeholder="провод/без провода">
                        </label>
                    </div>
                    <div class="post-rew-form-form-item">
                        <label>
                            <span>Цвет:</span>
                            <input class="a" name="par_2" required type="text" placeholder="белый">
                        </label>
                    </div>
                    <div class="post-rew-form-form-item">
                        <label>
                            <span>Микрофон:</span>
                            <input class="a" name="par_3" required type="text" placeholder="есть">
                        </label>
                    </div>
                    <div class="post-rew-form-form-item">
                        <label>
                            <span>Чувствительность:</span>
                            <input class="a" name="par_4" required type="text" placeholder="70">
                        </label>
                    </div>
                    <button class="btn-full" type="submit">
                        Добавить
                    </button>
                </form>
            </div>
        </section>
    </main>


    <?php
    if (isset($_POST['goods_title']) && isset($_POST['goods_new_price']) && isset($_POST['goods_old_price']) && isset($_POST['goods_text']) && isset($_POST['par_1']) && isset($_POST['par_2']) && isset($_POST['par_3']) && isset($_POST['par_4']) && isset($_FILES['goods_img'])) {
        $goods_title = $_POST['goods_title'];
        $goods_new_price = $_POST['goods_new_price'];
        $goods_old_price = $_POST['goods_old_price'];
        $goods_text = $_POST['goods_text'];
        $par_1 = $_POST['par_1'];
        $par_2 = $_POST['par_2'];
        $par_3 = $_POST['par_3'];
        $par_4 = $_POST['par_4'];

        $imagetmp = addslashes(file_get_contents($_FILES['goods_img']['tmp_name']));

        $sql = "INSERT INTO goods (goods_title, goods_old_price, goods_new_price, goods_text, par_1, par_2, par_3, par_4, goods_img) VALUES ('$goods_title', '$goods_old_price', '$goods_new_price', '$goods_text', '$par_1', '$par_2', '$par_3', '$par_4', '$imagetmp')";
        if (mysqli_query($conn, $sql)) {
            exit("<meta http-equiv='refresh' content='0; url= /admin.php'>");         
        } else {
            echo "Ошибка: " . mysqli_error($conn);
        }
    }
    ?>
</body>

</html>