<?php
	include 'condb.php';

	$query_tname =  "SELECT * FROM title_name";
	$data_tname = mysqli_query($conn, $query_tname);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="styles/edit_m.css">

	<!-- Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<title>ระบบแจ้งซ่อม</title>
	<style>	
		.eye-icon {
			position: absolute;
			right: 15px;
			top: 50%;
			transform: translateY(-50%);
			cursor: pointer;
			width: 18px; 
			height: auto; 
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
			<li>
				<a href="product_list.php">
					<i class='bx bxs-edit'></i>
					<span class="text">รายการอุปกรณ์</span>
				</a>
			</li>
			<li class="active">
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
				<img src="img/people.png">
				<span class="profile-name">Admin</span>
			</a>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<ul class="box-info login">
				<li>
					<div class="header-text  mb-3">
						<h1 >เพิ่มผู้ใช้งาน</h1>
						<p></p>
					</div>
					<form action = "insert_member.php" method="POST" enctype="multipart/form-data">						

						<label for="username" class="form-label mb-1 ">Username : </label>
						<div class="input-group mb-3">
							<span class="input-group-text" id="username"><i class='bx bxs-user-circle btn-outline-primary'></i></span>
							<input id="username" class="form-control" name="username" type="text" placeholder="" aria-label="default input example ">
						</div>

						<label for="username" class="form-label mb-1 ">Password : </label>
						<div class="input-group mb-3">
							<span class="input-group-text" id="password"><i class='bx bxs-key btn-outline-primary'></i></span>
							<input id="passwordinput" class="form-control" name="password" type="password" placeholder="" aria-label="default input example ">
							<img src = img/hide.png id="eyeicon" class="eye-icon">	
						</div>
						
						<label for="product">คำนำหน้าชื่อ</label>
							<div class="input-group mb-3">
							<span class="input-group-text" id="titlename"><i class='bx bx-receipt btn-outline-primary'></i></span>
								<select name="titlename" id="titlename" class="form-control" aria-label="default input example" >
								<option value="0">ระบุคำนำหน้าชื่อ</option>
									<?php        
										while($row1 = mysqli_fetch_array($data_tname)){
									?>
										<option value="<?php echo $row1['t_id']?>"> 
											<?php echo $row1['t_name']?> 
										</option>
									<?php } ?>
								</select>
							</div>			
						
						<label for="username" class="form-label mb-1 ">ชื่อ : </label>
						<div class="input-group mb-3 	 ">
							<span class="input-group-text" id="f_name"><i class='bx bx-id-card btn-outline-primary'></i></span>
							<input id="f_name" class="form-control" name="f_name" type="text" placeholder="" aria-label="default input example " require>
						</div>

						<label for="username" class="form-label mb-1 ">นามสกุล : </label>
						<div class="input-group mb-3 	 ">
							<span class="input-group-text" id="l_name"><i class='bx bx-id-card btn-outline-primary'></i></span>
							<input id="l_name" class="form-control" name="l_name" type="text" placeholder="" aria-label="default input example ">
						</div>

						<label for="username" class="form-label mb-1 ">เบอร์โทรศัพท์ : </label>
						<div class="input-group mb-3 	 ">
							<span class="input-group-text" id="tel_num"><i class='bx bxs-phone btn-outline-primary'></i></span>
							<input id="tel_num" class="form-control" name="tel_num" type="text" placeholder="" aria-label="default input example ">
						</div>

						<label for="product">สถานะ</label>
							<div class="input-group mb-3">
							<span class="input-group-text" id="status"><i class='bx bx-receipt btn-outline-primary'></i></span>
								<select name="status" id="status" class="form-control" aria-label="default input example" >									
										<option value="1">นักศึกษา</option>									
										<option value="2">อาจารย์</option>									
								</select>
							</div>

						<div>						
							<button type="submit" name="signin" class="w-100 fs-6 btn btn-primary">
                                <i class='bx bx-paper-plane'></i> เพิ่มข้อมูล
							</button>
						</div>
					</form>	
				</li>
			</ul>								
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	<script>
		let eyeicon = document.getElementById("eyeicon");
		let password = document.getElementById("passwordinput");

		eyeicon.onclick = function(){
			if(password.type == "password"){
				password.type = "text";
				eyeicon.src = "img/view.png";
			}else{
				password.type = "password";
				eyeicon.src = "img/hide.png";
			}
		}
	</script>	

	<script src="script.js"></script>
</body>
</html>