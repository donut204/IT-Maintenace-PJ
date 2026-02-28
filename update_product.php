<?php
    session_start();
    include 'condb.php';
    $product_id     = $_POST['product_id'];
    $product_qty    = $_POST['product_qty'];
    
    // อัพโหลดรูปภาพ
    if(is_uploaded_file($_FILES['img']['tmp_name'])){
        $extension = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION); 
        
        $files = glob("./img/img_upload/*");    
        $image_index = count($files) + 1;

        $new_image_name = 'pd_' . $image_index . '.' . $extension;
        $image_upload_path = "./img/img_upload/" . $new_image_name;
        move_uploaded_file($_FILES['img']['tmp_name'], $image_upload_path);
    } else {
        $sql_old_img = "SELECT product_img FROM product WHERE product_id = '$product_id'";
        $result_old_img = mysqli_query($conn, $sql_old_img);
        $row = mysqli_fetch_assoc($result_old_img);
        $new_image_name = $row['product_img'];  
    }
    
    $sql_update_product = "UPDATE product SET product_qty='$product_qty',product_img='$new_image_name' WHERE product_id = '$product_id'";
    $result_update_product = mysqli_query($conn, $sql_update_product);
    
    $product_name  = $_POST['product_name'];
    
    $sql_update_product_type = "UPDATE product_type SET p_name='$product_name' WHERE pt_id='$product_id'";
    $result_update_product_type = mysqli_query($conn, $sql_update_product_type);
    
    if($result_update_product && $result_update_product_type){
        // echo "<script>alert('อัพเดตข้อมูลสำเร็จ');</script>";
        echo "<script>window.location = 'product_list.php';</script>";
        $_SESSION['Edit_update'] = "อัพเดตข้อมูลสำเร็จ";
    } else {
        // echo "<script>alert('ไม่สามารถอัพเดตข้อมูลได้');</script>";
        $_SESSION['Edit_Error'] = "ไม่สามารถอัพเดตข้อมูลได้";

    }
    
?>