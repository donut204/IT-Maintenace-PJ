<?php
    session_start();
    include 'condb.php';
	
	if (!isset($_SESSION['admin_login'])) {        
        $_SESSION['error'] = "กรุณาเข้าสู่ระบบ";
        header('location: login.php');        
    }
    
    $product_name   = $_POST['product_name'];

    $sql1 = "INSERT INTO product_type (p_name) VALUES ('$product_name')";
    $result1 = mysqli_query($conn, $sql1);

    $product_qty    = $_POST['product_qty'];
    // $img            = $_POST['img'];      
    $pt_id = mysqli_insert_id($conn);

    // อัพโหลดรูปภาพ
    if(is_uploaded_file($_FILES['img']['tmp_name'])){
        $extension = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION); 
        
        $files = glob("./img/img_upload/*");    
        $image_index = count($files) + 1;

        $new_image_name = 'pd_' . $image_index . '.' . $extension;
        $image_upload_path = "./img/img_upload/" . $new_image_name;
        move_uploaded_file($_FILES['img']['tmp_name'], $image_upload_path);
    } else {
        $new_image_name = ""; 
    }    

    $sql2 = "INSERT INTO product (pt_id, product_img, product_qty) VALUES ('$pt_id','$new_image_name',$product_qty)";
    $result2 = mysqli_query($conn, $sql2);

    if($result1 && $result2){
        // echo "<script>alert('บันทึกข้อมูลสำเร็จ');</script>";
        echo "<script>window.location = 'product_list.php';</script>";
        $_SESSION['insert_success'] = "เพิ่มอุปกรณ์สำเร็จ";
    }else{
        // echo "<script>alert('ไม่สำเร็จ');</script>";
        $_SESSION['insert_error'] = "เพิ่มอุปกรณ์ไม่สำเร็จ";

    }
?>