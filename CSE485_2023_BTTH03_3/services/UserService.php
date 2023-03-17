<?php
    
require_once "./configs/DB_Connection.php";
require "models/User.php";
class UserService
{
    public function checkLogin($username)
    {
        $dbConn = new DBConnection();
        $conn = $dbConn->getConnection();

        $sql = "SELECT * FROM users WHERE user_email = '$user_email'";
        $result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
    if($row ['user_email'] == $user_email){
        // $users = [];
        // while($row = $result->fetch()){
        //     $user = new Member($row['id'], $row['name'], $row['email'], $row['username'], $row['password'], $row['is_admin']);
        //     array_push($users, $user);
        // }


        return $users;
    }
}
    public function countUser()
    {
        $dbConn = new DBConnection();
        $conn = $dbConn->getConnection();

        $sql = "SELECT COUNT(id) as count FROM users";
        $result = $conn ->query($sql);
        while ($row = $result->fetch()) {
            $count = strval($row['count']);
        }
        return $count;
    }
    public function getAllUser()
    {
        // 4 bước thực hiện
        $dbConn = new DBConnection();
        $conn = $dbConn->getConnection();

        // B2. Truy vấn
        $sql = "SELECT * FROM users";
        $stmt = $conn->query($sql);

        // B3. Xử lý kết quả
        $members = [];
        while ($row = $stmt->fetch()) {
            $member = new Member($row['id'], $row['name'], $row['email'], $row['username'], $row['password'], $row['is_admin']);
            array_push($members, $member);
        }
        // Mảng (danh sách) các đối tượng Article Model

        return $members;
    }

    public function addMember($name, $email, $user, $pass,$is_admin)
    {
        $dbConn = new DBConnection();
        $conn = $dbConn->getConnection();

        // B2. Truy vấn
        $sql = "INSERT INTO users VALUES ('','$name','$email','$user','$pass','$is_admin')";
        $stmt = $conn->query($sql);
        if ($stmt) {
            return true;
        }
        else{
            echo "lỗi";
        }
    }

    public function deleteMember($id)
    {
        $dbConn = new DBConnection();
        $conn = $dbConn->getConnection();
        $sql = "DELETE from users where id = '$id';";
        $stmt = $conn->query($sql);
        if($stmt) {
            return true;
        }
        return false; 
    }
    public function signupUser($user_email, $user_pass, $user_hash,$pass_hash, $is_admin)
    {
        
        $dbConn = new DB_Connection();
        $conn = $dbConn->getConnection();
        $sql = "INSERT INTO users VALUES ('','$user_email', '$user_pass', '$user_hash', '$pass_hash',0)";
        $stmt = $conn->query($sql);
        if ($stmt) {
            return true;
        }
        else{
            echo "lỗi";
        }

    }
    public function findMemberId($id)
    {
        $dbConn = new DBConnection();
        $conn = $dbConn->getConnection();

        // B2. Truy vấn
        $sql = "SELECT * FROM users WHERE id = '$id'";
        $stmt = $conn->query($sql);

    
        while($row = $stmt->fetch()){
            $member = new Member($row['id'], $row['name'], $row['email'], $row['username'], $row['password'], $row['is_admin']);
         
        }
        // Mảng (danh sách) các đối tượng Author Model

        return $member;
    }

    public function editMember($id, $name, $email, $user, $pass,$is_admin)
    {
        $dbConn = new DBConnection();
        $conn = $dbConn->getConnection();
        $sql = "UPDATE users SET  name='$name' , email='$email', username='$user', password='$pass',is_admin='$is_admin' WHERE id='$id'";
        $stmt = $conn->query($sql);
        if ($stmt) {
            return true;
        }
        else{
            echo "lỗi";
        }
    }
}
