<?php
    session_start();
    include 'condb.php';

    $username   = $_POST['username'];
    $pt_id   = $_POST['pt_name'];
    $pro_id  = $_POST['pt_name'];  
    $problem  = $_POST['problem'];
    $user_id = isset($_SESSION['user_login']) ? $_SESSION['user_login'] : $_SESSION['admin_login'];
    
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
    
    $sql1 = "INSERT INTO repair (user_id, user, product_id, pt_id, repair_detail, repair_img) VALUES ( '$user_id', '$username', '$pro_id', '$pt_id', '$problem', '$new_image_name')";
    $result1 = mysqli_query($conn, $sql1);
    
    $sToken = "wijukxI4mWtmy7AHJc4LyDpDVkU1cGSzNmNBwrAn91x";
	$sMessage = "มีรายการแจ้งซ่อมจ้า....\n";
    $sMessage .= "ชื่อผู้แจ้ง : ".$username. "\n";
    $sMessage .= "เข้าไปดูด้วยจ้า \n";
    $sticker_package_id = "6370";
    $sticker_id = "11088017";
        
    $data = array(
            'message' => $sMessage,
            'stickerPackageId' => $sticker_package_id,
            'stickerId' => $sticker_id
        );

	$chOne = curl_init(); 
	curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
	curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
	curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
	curl_setopt( $chOne, CURLOPT_POST, 1); 
	curl_setopt( $chOne, CURLOPT_POSTFIELDS, $data); 
	$headers = array( 'Content-type: multipart/form-data', 'Authorization: Bearer '.$sToken.'', );
	curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
	curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
	$result = curl_exec( $chOne ); 

	// //Result error 
	// if(curl_error($chOne)) 
	// { 
	// 	echo 'error:' . curl_error($chOne); 
	// } 
	// else { 
	// 	$result_ = json_decode($result, true); 
	// 	echo "status : ".$result_['status']; echo "message : ". $result_['message'];
	// } 
	// curl_close( $chOne ); 

    if($result1 ){
        // echo "<script>alert('บันทึกข้อมูลสำเร็จ');</script>";
        echo "<script>window.location = 'problem_list_user.php';</script>";
        $_SESSION['insert'] = "รับเรื่องแล้วจะรีบจัดการโดยด่วน";
    }else{
        // echo "<script>alert('ไม่สำเร็จ');</script>";
        $_SESSION['insert_error'] = "ไม่สามารถรับเรื่องได้ในขณะนี้";

    }

?>

    