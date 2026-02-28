<?php
    session_start();
    include 'condb.php';

    $username   = $_POST['username'];
    $pt_id   = $_POST['pt_name'];
    $pro_id  = $_POST['pt_name'];  
    $problem  = $_POST['problem'];
    
    
    // อัพโหลดรูปภาพ
    if(is_uploaded_file($_FILES['pb_img']['tmp_name'])){
        $extension = pathinfo($_FILES['pb_img']['name'], PATHINFO_EXTENSION); 
        
        $files = glob("./img/img_problem/*");    
        $image_index = count($files) + 1;

        $new_image_name = 'pb_' . $image_index . '.' . $extension;
        $image_upload_path = "./img/img_problem/" . $new_image_name;
        move_uploaded_file($_FILES['pb_img']['tmp_name'], $image_upload_path);
    } else {
        $new_image_name = ""; 
    }     
    
    $sql1 = "INSERT INTO repair (user, product_id, pt_id, repair_detail, repair_img) VALUES ( '$username', '$pro_id', '$pt_id', '$problem', '$new_image_name')";
    $result1 = mysqli_query($conn, $sql1);
    


    if($result1 ){
        // echo "<script>alert('บันทึกข้อมูลสำเร็จ');</script>";
        echo "<script>window.location = 'problem_list.php';</script>";
        $_SESSION['insert'] = "รับเรื่องแล้วจะรีบจัดการโดยด่วน";
    }else{
        // echo "<script>alert('ไม่สำเร็จ');</script>";
        $_SESSION['insert_error'] = "ไม่สามารถรับเรื่องได้ในขณะนี้";

    }

?>

    