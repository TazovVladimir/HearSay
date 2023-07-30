<?php
require("connect.php");
if (isset($_POST['reviews_name']) && isset($_POST['reviews_text'])&& isset($_FILES['avatar'])) {
	$reviews_name = $_POST['reviews_name'];
	$reviews_text = $_POST['reviews_text'];
    $imagetmp = addslashes(file_get_contents($_FILES['avatar']['tmp_name']));
	$sql = "INSERT INTO reviews (reviews_name, reviews_text, avatar) VALUES ('$reviews_name', '$reviews_text', '$imagetmp')";
	if (mysqli_query($conn, $sql)) {
		echo "<p>Успешно добавлены</p>";
		header("location: index.php#reviews");
	} else {
		echo "Ошибка: " . mysqli_error($conn);
	}
}
?>