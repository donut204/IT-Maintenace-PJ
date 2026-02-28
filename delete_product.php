<?php
    session_start();
    include 'condb.php';

    $ids = $_GET['id'];
    
    $sql_id = "SELECT product_id FROM product WHERE product_id='$ids'";
    $result = mysqli_query($conn, $sql_id);
    $row = mysqli_fetch_assoc($result);
    $product_id = $row['product_id'];

    $sql_product = "DELETE FROM product WHERE product_id='$ids'";
    if(mysqli_query($conn, $sql_product)){
        $sql_pt = "DELETE FROM product_type WHERE pt_id = '$product_id'";
        if(mysqli_query($conn, $sql_pt)){
            // echo "<script>alert('ลบข้อมูลสำเร็จ');</script>";
            echo "<script>window.location = 'product_list.php';</script>";
            $_SESSION['delete'] = "ลบข้อมูลสำเร็จ";
        } else {
            // echo "<script>alert('ลบข้อมูลไม่สำเร็จ');</script>";
            $_SESSION['delete_error'] = "ลบข้อมูลไม่สำเร็จ";

        }
    } else {
        echo "<script>alert('ลบข้อมูลไม่สำเร็จ');</script>";
    }


?>