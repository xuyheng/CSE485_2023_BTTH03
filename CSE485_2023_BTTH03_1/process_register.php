<?php
require_once './src/DB_Conn.php';

if(isset($_POST['submit'])){
//Lưu vào cơ sở dữ liệu
$user_email = $_POST['email'];
$user_pass = $_POST['password1'];
$reset_pass = $_POST['password2'];
$sql4= "SELECT * FROM users";
$result = mysqli_query($conn,$sql4);
$row = mysqli_fetch_assoc($result);
    if($row ['user_email'] == $user_email){
    header("Location: register.php?error=Lỗi. Email đã tồn tại!");
}
else{
    if($user_pass === $reset_pass){
        $pass_hash = password_hash($user_pass, PASSWORD_DEFAULT);
        $user_hash = md5(uniqid(rand(),true));
        $sql2 = "INSERT INTO users(user_email, user_pass, pass_hash, user_hash) VALUES('$user_email', '$user_pass','$pass_hash', '$user_hash')";
        if(mysqli_query($conn,$sql2)){
            require 'vendor/autoload.php';
            require 'Utils/MyEmailServer.php';
            require 'Utils/EmailSender.php';
       
            $emailServer = new MyEmailServer();
            $emailSender = new EmailSender($emailServer);
            $emailSender -> send($user_email,"Check_Email", "http://localhost/cse485_2023_btth03/check_email.php?id_email=".$user_email."&id_hash=".$user_hash);
            header("Location: register.php?confirm=Vui lòng xác nhận Email!");   
    
            } else{
                echo "Loi.";
            }
    }
    else {
        header("Location: register.php?error=Lỗi. Mật khẩu không trùng nhau.");   
    }
}

}
    //1Gui email chua link +ma kich hoat
?>