<?php
	include 'condb.php';
	session_start();
	
	if (!isset($_SESSION['admin_login'])) {        
        $_SESSION['error'] = "กรุณาเข้าสู่ระบบ";
        header('location: login.php');        
    }

	$query_pname =  "SELECT * FROM product_type";
	$data_pname = mysqli_query($conn, $query_pname);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="styles/problem_report.css">

	<!-- Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<title>ระบบแจ้งซ่อม</title>
	<style>	

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
				<a href="admin_mainpage.php">
					<i class='bx bxs-home'></i>
					<span class="text">หน้าหลัก</span>
				</a>
			</li>
			<li class="active">
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
			<li>
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
				<a href="logout.php" class="logout">
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
						<h1 >แจ้งปัญหา</h1>
						<p></p>
					</div>
					<form action = "insert_problem.php" method="POST" enctype="multipart/form-data" >
						<label for="username" class="form-label mb-2">ชื่อผู้แจ้ง : </label>
						<div class="input-group mb-3">
							<span class="input-group-text" id="username"><i class='bx bxs-user btn-outline-primary'></i></span>
							<input id="username" class="form-control" name="username" type="text" placeholder="" aria-label="default input example ">
						</div>
						<label for="product">อุปกรณ์</label>
							<div class="input-group mb-3">
							<span class="input-group-text" id="pt_name"><i class='bx bx-receipt btn-outline-primary'></i></span>
								<select name="pt_name" id="pt_name" class="form-control" aria-label="default input example" >
								<option value="0">ระบุอุปกรณ์</option>
									<?php        
										while($row1 = mysqli_fetch_array($data_pname)){
									?>
										<option value="<?php echo $row1['pt_id']?>"> 
											<?php echo $row1['p_name']?> 
										</option>
									<?php } ?>
								</select>
							</div>			

						<label for="problem" class="form-label mb-2">รายละเอียดปัญหาอุปกรณ์ : </label>
                        <div class="input-group mb-3">
							<span class="input-group-text" id="problem"><i class='bx bx-edit-alt btn-outline-primary'></i></span>
							<textarea name="problem" class="form-control" rows="3" aria-label="default input example" id="problem"></textarea>
						</div>						
						<label for="pb_img" class="form-label mb-1 ">ภาพอุปกรณ์ </label>
                        <div class="input-group mb-3">
							<span class="input-group-text" id="pb_img"><i class='bx bx-image-alt btn-outline-primary	'></i></span>
							<input id="pb_img" class="form-control" name="pb_img" type="file" accept="image/png, image/jpg, image/jpeg" placeholder="" aria-label="default input example">	
						</div>
						<div>						
							<button type="submit" name="signin" class="w-100 fs-6 btn btn-primary">
                                <i class='bx bx-paper-plane'></i> ส่งฟอร์ม
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