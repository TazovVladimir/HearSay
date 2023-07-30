<?php
require("connect.php");
if (isset($_POST['call_name']) && isset($_POST['call_email'])&& isset($_POST['goods_title'])) {
	$call_name = $_POST['call_name'];
	$call_email = $_POST['call_email'];
    $goods_title = trim($_POST['goods_title']);
	$sql = "INSERT INTO call_back (call_name, call_email, goods_title) VALUES ('$call_name', '$call_email', '$goods_title')";
	if (mysqli_query($conn, $sql)) {
		echo "<p>Успешно добавлены</p>";
		header("location: index.php");
	} else {
		echo "Ошибка: " . mysqli_error($conn);
	}
}
?>