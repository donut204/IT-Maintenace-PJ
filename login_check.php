<?php
    session_start();
    include('condb.php');

    $username = $_POST['username'];
    $password = $_POST['password'];    

    if (empty($username)) {
        $_SESSION['error'] = 'กรุณาใส่ username';
        header("location: login.php");
        exit;
    } elseif (empty($password)) {
        $_SESSION['error'] = 'กรุณาใส่ password';
        header("location: login.php");
        exit;
    } 
    
    $sql = "SELECT * FROM `user` WHERE username = '$username'"; 
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);  

    if ($row) { 
        if(password_verify($password, $row['password'])){
            if($row['role'] == 'admin'){
                $_SESSION['admin_login'] = $row['user_id'];
                $_SESSION['admin'] = "เข้าสู่ระบบสำเร็จ";
                header("location: admin_mainpage.php");
            }else{
                $_SESSION['user_login'] = $row['user_id'];
                $_SESSION['user'] = "เข้าสู่ระบบสำเร็จ";
                header("location: main_page.php");
            }
        }else{
            $_SESSION['error'] = "รหัสผ่านผิด";
            header("location: login.php");
        }
    } else {
        $_SESSION['error'] = "ไม่มีข้อมูลในระบบ"; 
        header("location: login.php");
    }

?>
