<?php
include('connect.php');
session_start();
if (isset($_SESSION['admin'])) {
    header('Location: index.php');
}
if (!empty($_REQUEST['login']) and !empty($_REQUEST['password'])) {
    $login = $_POST['login'];
    $query = "SELECT * FROM admin WHERE login='$login'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);
    if (!empty($user)) {
        if ($_POST['password'] === $user['password']) {
            session_start();
            $_SESSION['admin'] = true;
            header('Location: index.php');
        } else {
            $msg = true;
        }
    } else {
        $msg = true;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link type="image/x-icon" href="favicon.ico" rel="shortcut icon">
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">
    <title>Авторизация админа</title>
</head>

<body>
    <main>
        <section class="post-auth-form">
            <div class="container-form">
                <h2 class="h2-title">
                    Авторизация
                </h2>
                <span class="h2-title-text">
                    заполните форму для авторизация
                </span>
                <form class="post-rew-form-form" action="auth.php" method="POST">
                    <?php if ($msg) {
                        echo '
                            <div class="post-rew-form-form-item">
                                <div class="alert">Неправильный логин или пароль</div>
                            </div>
                        ';
                    } ?>

                    <div class="post-rew-form-form-item">
                        <label for="post-rew-name">
                            <span>Ваше имя:</span>
                            <input name="login" required id="post-rew-name" type="text" placeholder="admin">
                        </label>
                    </div>
                    <div class="post-rew-form-form-item">
                        <label for="post-rew-text">
                            <span>Ваш пароль:</span>
                            <input name="password" required id="post-rew-text" type="password" placeholder="admin">
                        </label>
                    </div>
                    <button class="btn-full" type="submit">
                        Отправить
                    </button>
                </form>
            </div>
        </section>
    </main>
</body>

</html>