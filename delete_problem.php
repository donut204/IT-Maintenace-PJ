<?php
    session_start();
    include 'condb.php';

    $ids = $_GET['id'];
    $sql_problem = mysqli_query($conn,"DELETE FROM repair WHERE repair_id='$ids'");

    if($sql_problem){
        echo "<script>window.location='problem_list.php';</script>";
        $_SESSION['delete'] = "ลบข้อมูลสำเร็จ";
    }else{
        echo "<script>alert('ลบข้อมูลไม่สำเร็จ');</script>";
        $_SESSION['delete_error'] = "ลบข้อมูลไม่สำเร็จ";
    }

    mysqli_close($conn);


?>