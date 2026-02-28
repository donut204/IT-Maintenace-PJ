<?php

include 'condb.php';
session_start();
if (isset($_POST['signup'])) {
    $username =$_POST['username'];
    $password =$_POST['password'];
    $passwordHashed = password_hash($password, PASSWORD_DEFAULT);   

    if (empty($username)) {
        $_SESSION['error'] = 'กรุณาใส่ username';
        header("location: register.php");
    } elseif (empty($password)) {
        $_SESSION['error'] = 'กรุณาใส่ password';
        header("location: register.php");
    }
    $sql1 = "INSERT INTO user (username, password) VALUES ('$username', '$passwordHashed')";
    $result1 = mysqli_query($conn, $sql1);

    $titlename =$_POST['titlename'];
    $f_name =$_POST['f_name'];
    $l_name =$_POST['l_name'];
    $tel_num =$_POST['tel_num'];
    $status =$_POST['status'];
    $user_id = mysqli_insert_id($conn);

    if (empty($titlename)) {
        $_SESSION['error'] = 'กรุณาใส่ คำนำหน้าชื่อ';
        header("location: register.php");
    } elseif (empty($f_name)) {
        $_SESSION['error'] = 'กรุณาใส่ชื่อ';
        header("location: register.php");
    }elseif (empty($l_name)) {
        $_SESSION['error'] = 'กรุณาใส่นามสกุล';
        header("location: register.php");
    }elseif (empty($tel_num)) {
        $_SESSION['error'] = 'กรุณาใส่เบอร์โทรศัพท์';
        header("location: register.php");
    }elseif (empty($status)) {
        $_SESSION['error'] = 'กรุณาใส่สถานะ';
        header("location: register.php");
    }else  {        
            
        $sql2 = "INSERT INTO personal (user_id, t_id, f_name, l_name, tel_num, status_id) VALUES ('$user_id','$titlename', '$f_name', '$l_name', '$tel_num', '$status')";
        $result2 = mysqli_query($conn, $sql2);

            if($result1 && $result2){
                $_SESSION['register'] = "บันทึกข้อมูลสำเร็จ";
                header("location: login.php");
            }else{
                echo "Error:" . $sql . "<br>" . mysqli_error($conn);
                echo "<script> alert('บันทึกข้อมูลไม่ได้');</script>";
            }
            mysqli_close($conn);
    }
}
?>