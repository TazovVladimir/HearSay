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
    <title>Изменение</title>
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
                    Измененить товар и сделать акционный товар
                </h2>
                <span class="h2-title-text">
                    заполните форму для изменения
                </span>
                <?php
                if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"])) {
                    $userid = $conn->real_escape_string($_GET["id"]);
                    $sql = "SELECT * FROM goods WHERE id = '$userid'";
                    if ($result = $conn->query($sql)) {
                        if ($result->num_rows > 0) {
                            foreach ($result as $row) {
                                $goods_title = $row["goods_title"];
                                // $goods_old_price = $row["goods_old_price"];
                                $goods_new_price = $row["goods_new_price"];
                                $goods_text = $row["goods_text"];
                                $par_1 = $row["par_1"];
                                $par_2 = $row["par_2"];
                                $par_3 = $row["par_3"];
                                $par_4 = $row["par_4"];
                            }
                            echo "
                            <form class='post-rew-form-form add' method='POST'>
                                <input class='form-control mb-1' type='hidden' name='id' value='$userid' />
                                <div class='post-rew-form-form-item'>
                                    <label>
                                        <span>Название:</span>
                                        <input class='a' name='goods_title' value='$goods_title' required type='text' placeholder='EmitHear z1-2'>
                                    </label>
                                </div>
                                <div class='post-rew-form-form-item'>
                                    <label>
                                        <span>Новая цена (для акции):</span>
                                        <input class='a' name='goods_new_price' value='$goods_new_price' required type='number'>
                                    </label>
                                </div>
                                <div class='post-rew-form-form-item'>
                                    <label>
                                        <span>Текст:</span>
                                        <input class='a' name='goods_text' value='$goods_text' required type='text'
                                            placeholder='Отличные бюджетные наушники для студента, для обучения'>
                                    </label>
                                </div>
                                <div class='post-rew-form-form-item'>
                                    <label>
                                        <span>Сигнал:</span>
                                        <input class='a' name='par_1' value='$par_1' required type='text' placeholder='провод/без провода'>
                                    </label>
                                </div>
                                <div class='post-rew-form-form-item'>
                                    <label>
                                        <span>Цвет:</span>
                                        <input class='a' name='par_2' value='$par_2' required type='text' placeholder='белый'>
                                    </label>
                                </div>
                                <div class='post-rew-form-form-item'>
                                    <label>
                                        <span>Микрофон:</span>
                                        <input class='a' name='par_3' value='$par_3' required type='text' placeholder='есть'>
                                    </label>
                                </div>
                                <div class='post-rew-form-form-item'>
                                    <label>
                                        <span>Чувствительность:</span>
                                        <input class='a' name='par_4' value='$par_4' required type='text' placeholder='70'>
                                    </label>
                                </div>
                                <button class='btn-full' type='submit'>
                                    Изменить
                                </button>
                            </form>";
                        } else {
                            echo "<div>Не найден</div>";
                        }
                        $result->free();
                    } else {
                        echo "Ошибка: " . $conn->error;
                    }
                } elseif (isset($_POST['goods_title']) && isset($_POST['goods_new_price']) && isset($_POST['goods_text']) && isset($_POST['par_1']) && isset($_POST['par_2']) && isset($_POST['par_3']) && isset($_POST['par_4'])) {

                    $userid = $conn->real_escape_string($_POST["id"]);
                    $goods_title = $conn->real_escape_string($_POST["goods_title"]);
                    $goods_new_price = $conn->real_escape_string($_POST["goods_new_price"]);
                    // $goods_old_price = $conn->real_escape_string($_POST["goods_old_price"]);
                    $goods_text = $conn->real_escape_string($_POST["goods_text"]);
                    $par_1 = $conn->real_escape_string($_POST["par_1"]);
                    $par_2 = $conn->real_escape_string($_POST["par_2"]);
                    $par_3 = $conn->real_escape_string($_POST["par_3"]);
                    $par_4 = $conn->real_escape_string($_POST["par_4"]);
                    // $imagetmp = addslashes(file_get_contents($_FILES['goods_img']['tmp_name']));

                    $sql = "UPDATE goods SET goods_title = '$goods_title', goods_new_price = '$goods_new_price',  goods_text = '$goods_text', par_1 = '$par_1', par_2 = '$par_2', par_3 = '$par_3', par_4 = '$par_4'  WHERE id = '$userid'";
                    if ($result = $conn->query($sql)) {
                        echo "<h2 style='text-align:center;'>Отлично! Данные изменены</h2>";
                        exit("<meta http-equiv='refresh' content='0; url= /admin.php'>");  
                    } else {
                        echo "Ошибка: " . $conn->error;
                    }
                } else {
                    echo "Некорректные данные";
                }
                $conn->close();
                ?>
            </div>
        </section>
    </main>
</body>

</html>