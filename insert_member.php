<?php
    session_start();
    include 'condb.php';

    $username   = $_POST['username'];
    $password   = $_POST['password'];        
    
    $sql1 = "INSERT INTO user (username, password) VALUES ('$username', '$password')";
    $result1 = mysqli_query($conn, $sql1);
    
    $titlename  = $_POST['titlename'];
    $f_name     = $_POST['f_name'];
    $l_name     = $_POST['l_name'];
    $tel_num    = $_POST['tel_num'];
    $status     = $_POST['status'];
    $user_id = mysqli_insert_id($conn);

    $sql2 = "INSERT INTO personal (user_id, t_id, f_name, l_name, tel_num, status_id) VALUES ('$user_id','$titlename', '$f_name', '$l_name', '$tel_num', '$status')";
    $result2 = mysqli_query($conn, $sql2);

    if($result1 && $result2){
        // echo "<script>alert('บันทึกข้อมูลสำเร็จ');</script>";
        echo "<script>window.location = 'show_member.php';</script>";
        $_SESSION['insert'] = "เพิ่มข้อมูลสำเร็จ";
    }else{
        // echo "<script>alert('ไม่สำเร็จ');</script>";
        $_SESSION['insert_error'] = "เพิ่มข้อมูลไม่สำเร็จ";

    }

?>

    