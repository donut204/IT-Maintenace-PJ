<?php    
    include 'condb.php';
	session_start();

	if(!isset($_SESSION['admin_login'])){
		$_SESSION['error'] = 'กรุณาเข้าสู่ระบบ';
		header('location: login.php');
	}

	$id = $_GET['id'];
	$sql =  "SELECT p.product_id, pt.p_name, p.product_img, p.product_qty 
			FROM product AS p 
			INNER JOIN product_type AS pt ON pt.pt_id = p.pt_id
			WHERE p.product_id = '$id'";

	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($result);   
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="styles/edit_p.css">

	<!-- Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<title>ระบบแจ้งซ่อม</title>
	<style>	
		 form .input-group.mb-3 {
        width: 100%;
    }
		.image-box {
		border: 1px solid #ccc;
		padding: 10px;
		border-radius: 5px;
		margin-bottom: 10px;
	}
	</style>
</head>
<body>


		<!-- SIDEBAR -->
        <section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs-wrench' ></i>
			<span class="text">ระบบแจ้งซ่อม</span>
		</a>
		<ul class="side-menu top">
			<li >
				<a href="main_page.php">
					<i class='bx bxs-home'></i>
					<span class="text">หน้าหลัก</span>
				</a>
			</li>
			<li>
				<a href="problem_report.php">
					<i class='bx bxs-edit'></i>
					<span class="text">แจ้งปัญหา</span>
				</a>
			</li>
			<li>
				<a href="problem_list.php">
					<i class='bx bxs-edit'></i>
					<span class="text">รายการแจ้งซ่อม</span>
				</a>
			</li>
			<li class="active">
				<a href="product_list.php">
					<i class='bx bxs-edit'></i>
					<span class="text">รายการอุปกรณ์</span>
				</a>
			</li>
			<li>
				<a href="show_member.php">
					<i class='bx bxs-edit'></i>
					<span class="text">จัดการข้อมูลผู้ใช้งาน</span>
				</a>
			</li>			
		</ul>
		<ul class="side-menu">			
			<li>
				<a href="#" class="logout">
					<i class='bx bx-log-out' ></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->



	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' ></i>
			
			<a href="#" class="profile">
				<i class='bx bxs-user-circle'></i>
				<?php if(isset($_SESSION['user_login']) || isset($_SESSION['admin_login'])){
					$user_id = isset($_SESSION['user_login']) ? $_SESSION['user_login'] : $_SESSION['admin_login'];       
					$sql0 = "SELECT * FROM personal WHERE user_id = $user_id";
					$query0 = 	mysqli_query($conn, $sql0);		  
					$personal = mysqli_fetch_assoc($query0);
				}
				?>
				<span class="profile-name"><?php echo $personal['f_name'] ;?></span>
			</a>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<ul class="box-info login">
				<li>
					<div class="header-text  mb-3">
						<h1 >แก้ไขข้อมูลอุปกรณ์</h1>
						<p></p>
					</div>
					<form action = "update_product.php" method="POST" enctype="multipart/form-data">
						<label for="username" class="form-label mb-1 ">รหัสอุปกรณ์ : </label>
						<div class="input-group mb-3 	 ">
							<span class="input-group-text" id="product_id"><i class='bx bx-list-ul btn-outline-primary'></i></span>
							<input id="inputGroup-sizing-sm" class="form-control" name="product_id" type="text" aria-label="default input example" readonly value="<?php echo $row['product_id']?>" >
						</div>
						<label for="username" class="form-label mb-2">ชื่ออุปกรณ์ : </label>
						<div class="input-group mb-3">
							<span class="input-group-text" id="product_name"><i class='bx bxs-user btn-outline-primary'></i></span>
							<input id="product_name_input" class="form-control" name="product_name" type="text" placeholder="" aria-label="default input example " value="<?php echo $row['p_name']?>">
						</div>
						<label for="product" class="form-label mb-2">จำนวนอุปกรณ์</label>
							<div class="input-group mb-3">
							<span class="input-group-text" id="product_qty"><i class='bx bx-receipt btn-outline-primary'></i></span>
								<select name="product_qty" id="product_qty_select" class="form-control" aria-label="default input example">
								<?php
									for ($i = 1; $i <= 10; $i++) {
										$selected = ($row['product_qty'] == $i) ? 'selected' : '';
										echo "<option value='$i' $selected>$i</option>";
									}
									?>
								</select>
							</div>											
						<label for="img" class="form-label mb-1 ">ภาพอุปกรณ์ </label>
						<div class="image-box">
							<div class="image-wrapper">
								<?php if(!empty($row['product_img'])): ?>
									<img src="img/img_upload/<?=$row['product_img']?>">
								<?php else: ?>
									<img src="img/no-image.png">
								<?php endif; ?>							
							</div>
						</div>
						<div class="input-group mb-3">
							<span class="input-group-text" id="img"><i class='bx bx-image-alt btn-outline-primary'></i></span>
							<input id="img" class="form-control" name="img" type="file" accept="image/png, image/jpg, image/jpeg" placeholder="" aria-label="default input example">	
						</div>
						<div>						
							<button type="submit" name="signin" class="w-100 fs-6 btn btn-primary">
                                <i class='bx bx-paper-plane'></i> เพิ่มอุปกรณ์
							</button>
						</div>
					</form>	
				</li>
			</ul>								
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	

	<script src="script.js"></script>
</body>
</html>