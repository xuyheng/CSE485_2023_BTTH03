<?php
require_once './src/DB_Conn.php';

if(isset($_POST['submit'])){
//Lưu vào cơ sở dữ liệu
$user_email = $_POST['email'];
$user_pass = $_POST['password1'];
$sql5= "SELECT * FROM users WHERE user_email = '$user_email'";
$result = mysqli_query($conn,$sql5);
$row = mysqli_fetch_assoc($result);
$hashed_password = $row['pass_hash'];
if (password_verify($user_pass, $hashed_password)) {
        session_start();
    $_SESSION['user_email'] = $user_email;
    $_SESSION['user_pass'] = $user_pass;
    header('Location: admin.php');
}
else{
    header("Location: login.php?error=Lỗi. Email hoặc Password nhập sai!");
}
}
?>