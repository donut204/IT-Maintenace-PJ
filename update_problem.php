<?php
    session_start();
    include 'condb.php';
    $repair_id      = $_POST['repair_id'];
    $problem        = $_POST['problem'];
    $status         = $_POST['status'];
    $pt_name        = $_POST['pt_id'];
    
    // อัพโหลดรูปภาพ
    if(is_uploaded_file($_FILES['repair_img']['tmp_name'])){
        $extension = pathinfo($_FILES['repair_img']['name'], PATHINFO_EXTENSION); 
        
        $files = glob("./img/img_problem/*");    
        $image_index = count($files) + 1;

        $new_image_name = 'pb_' . $image_index . '.' . $extension;
        $image_upload_path = "./img/img_problem/" . $new_image_name;
        move_uploaded_file($_FILES['repair_img']['tmp_name'], $image_upload_path);
    } else {
        $sql_old_img = "SELECT repair_img FROM repair WHERE repair_id = '$repair_id'";
        $result_old_img = mysqli_query($conn, $sql_old_img);
        $row = mysqli_fetch_assoc($result_old_img);
        $new_image_name = $row['repair_img'];  
    }
    
    $sql_update_problem = "UPDATE repair SET repair_detail='$problem',repair_img='$new_image_name', repair_status_id='$status', pt_id='$pt_name'
    WHERE repair_id  = '$repair_id '";
    $result_update_problem = mysqli_query($conn, $sql_update_problem);
    
    
    if($result_update_problem){
        // echo "<script>alert('อัพเดตข้อมูลสำเร็จ');</script>";
        echo "<script>window.location = 'problem_list.php';</script>";
        $_SESSION['Edit_update'] = "อัพเดตข้อมูลสำเร็จ";
    } else {
        // echo "<script>alert('ไม่สามารถอัพเดตข้อมูลได้');</script>";
        $_SESSION['Edit_Error'] = "ไม่สามารถอัพเดตข้อมูลได้";

    }
    
?>