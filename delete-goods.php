<?php
if(isset($_POST["id"]))
{
    include 'connect.php';
    $userid = $conn->real_escape_string($_POST["id"]);
    $sql = "DELETE FROM goods WHERE id = '$userid'";
    if($conn->query($sql)){
        header("Location: admin.php");
    }
    else{
        echo "Ошибка: " . $conn->error;
    }
    $conn->close();  
}
?>