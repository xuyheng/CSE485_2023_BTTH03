<?php
    require_once ('./src/DB_Conn.php');
    $user_email = $_GET['id_email'];
    $user_hash = $_GET['id_hash'];
    $sql3 = "UPDATE users SET status = 1 WHERE user_email = '$user_email' AND user_hash = '$user_hash'";
    if(mysqli_query($conn,$sql3)){
        header("Location: login.php");
    };
    
?>