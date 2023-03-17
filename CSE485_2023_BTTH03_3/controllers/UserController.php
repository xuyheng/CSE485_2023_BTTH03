<?php
// require_once './configs/DB_Connection.php';
require_once 'services/UserService.php';
use Symfony\Component\HttpFoundation\Response;
class UserController{
public function Signup(){
if(isset($_POST['signbtn'])){
//Lưu vào cơ sở dữ liệu
$user_email = $_POST['txtEmail'];
$user_pass = $_POST['txtPass'];
$reset_pass = $_POST['txtResetPass'];
    if ($_POST['txtPass'] !== $_POST['txtResetPass']) {
        echo "Mật khẩu xác nhận không khớp.";
        exit();
    } else {
                if (strlen($user_email) > 50) {
                    $message = "Email không quá 50 ký tự";
                    echo "<script>alert('$message');</script>";
                } else {
                        if (strlen($user_pass) > 255) {
                            $message = "Pass không quá 255 ký tự";
                            echo "<script>alert('$message');</script>";
                        } else {
                            // if (send($user_email)) {
                                // Hash mật khẩu
                                $userService = new UserService();
                                $user_hash = md5(uniqid(rand(),true));
                                $hash_password = password_hash($user_pass, PASSWORD_DEFAULT);
                                $result = $userService -> signupUser($user_email, $user_pass, $user_hash, $hash_password, 0);
                                if ($result) {

                                    // header('location:/CSE485_2023_BTTH03/index.php?controller=user&action=home');
                                    $response = new Response(include"views/home/home.php");
                                    return $response;
                                } else {
                                    echo "Email could not be sent.";
                                }
                            // }
                        }
                    }
                }
            }
            // include "views/user/add_user.php";
            $response = new Response(include"views/home/signup.php");
            return $response;
        }
        public function home(){
            $response = new Response(include"views/home/home.php");
            return $response;
        }
    
        
    }

    

// $sql4= "SELECT * FROM users";
// $result = mysqli_query($conn,$sql4);
// $row = mysqli_fetch_assoc($result);
//     if($row ['user_email'] == $user_email){
//     header("Location: register.php?error=Lỗi. Email đã tồn tại!");
// }
// else{
//     if($user_pass === $reset_pass){
//         $pass_hash = password_hash($user_pass, PASSWORD_DEFAULT);
//         $user_hash = md5(uniqid(rand(),true));
//         // $sql2 = "INSERT INTO users(user_email, user_pass, pass_hash, user_hash) VALUES('$user_email', '$user_pass','$pass_hash', '$user_hash')";
//         if(mysqli_query($conn,$sql2)){
//             require 'vendor/autoload.php';
//             require 'Utils/MyEmailServer.php';
//             require 'Utils/EmailSender.php';
       
//             $emailServer = new MyEmailServer();
//             $emailSender = new EmailSender($emailServer);
//             $emailSender -> send($user_email,"Check_Email", "http://localhost/cse485_2023_btth03/check_email.php?id_email=".$user_email."&id_hash=".$user_hash);
//             header("Location: register.php?confirm=Vui lòng xác nhận Email!");   
    
//             } else{
//                 echo "Loi.";
//             }
//     }
//     else {
//         header("Location: register.php?error=Lỗi. Mật khẩu không trùng nhau.");   
//     }
// }


    //1Gui email chua link +ma kich hoat


?>