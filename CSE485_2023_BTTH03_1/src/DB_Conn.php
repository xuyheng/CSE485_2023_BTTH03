<?php
$servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "csebtth03";
    $conn = mysqli_connect($servername, $username, $password);
    mysqli_select_db($conn, $dbname);
    mysqli_query($conn, "SET NAMES 'utf8'");
if(!$conn) {
    die('Kết nối tới Server lỗi');
}
