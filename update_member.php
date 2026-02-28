<?php
    session_start();
    include 'condb.php';
    $id         = $_POST['id'];
    $username   = $_POST['username'];
    $password   = $_POST['password'];        
    
    $sql1 = "UPDATE user SET username='$username',password='$password' WHERE user_id = '$id'";
    $result_update_user = mysqli_query($conn, $sql1);
    
    $titlename  = $_POST['titlename'];
    $f_name     = $_POST['f_name'];
    $l_name     = $_POST['l_name'];
    $tel_num    = $_POST['tel_num'];
    $status     = $_POST['status'];   
    
    $sql_update_personal = "UPDATE personal SET t_id='$titlename', f_name='$f_name', l_name='$l_name', tel_num='$tel_num', status_id='$status' WHERE per_id='$id'";
    $result_update_personal = mysqli_query($conn, $sql_update_personal);
    
    if($result_update_user && $result_update_personal){
        // echo "<script>alert('อัพเดตข้อมูลสำเร็จ');</script>";
        echo "<script>window.location = 'show_member.php';</script>";
        $_SESSION['Edit'] = "บันทึกข้อมูลสำเร็จ";
    } else {
        // echo "<script>alert('ไม่สามารถอัพเดตข้อมูลได้');</script>";
        $_SESSION['Edit_Error'] = "บันทึกข้อมูลไม่สำเร็จ";

    }
    
?>