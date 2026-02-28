<?php
    session_start();
    include 'condb.php';

    $ids = $_GET['id'];
    
    $sql_id = "SELECT user_id FROM personal WHERE per_id='$ids'";
    $result = mysqli_query($conn, $sql_id);
    $row = mysqli_fetch_assoc($result);
    $user_id = $row['user_id'];

    $sql_personal = "DELETE FROM personal WHERE per_id='$ids'";
    if(mysqli_query($conn, $sql_personal)){
        $sql_user = "DELETE FROM user WHERE user_id = '$user_id'";
        if(mysqli_query($conn, $sql_user)){
            // echo "<script>alert('ลบข้อมูลสำเร็จ');</script>";
            echo "<script>window.location = 'show_member.php';</script>";
            $_SESSION['delete'] = "ลบข้อมูลสำเร็จ";
        } else {
            // echo "<script>alert('ลบข้อมูลไม่สำเร็จ');</script>";
            $_SESSION['delete_error'] = "ลบข้อมูลไม่สำเร็จ";

        }
    } else {
        echo "<script>alert('ลบข้อมูลไม่สำเร็จ');</script>";
    }


?>