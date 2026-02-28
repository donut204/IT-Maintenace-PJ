<?php
	session_start();
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
	<link rel="stylesheet" href="styles/stylelogin.css">
	<!-- Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<!-- jquery -->
	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
	<!-- SweetAlert -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.all.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.min.css" rel="stylesheet">

	<title>ระบบแจ้งซ่อม</title>
	<style>
		.custom-title-class {
			font-family: var(--prompt);
		}

		.custom-input-class {
			font-family: var(--prompt);
		}	
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
				<a href="index1.php">
					<i class='bx bxs-home'></i>
					<span class="text">หน้าหลัก</span>
				</a>
			</li>
			<li>
				<a href="login.php">
					<i class='bx bxs-user-circle'></i>
					<span class="text">เข้าสู่ระบบ</span>
				</a>
			</li>
			<li class="active">
				<a href="register.php">
					<i class='bx bxs-user-plus' ></i>
					<span class="text">สมัครสมาชิก</span>
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
						
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<ul class="box-info">
				<li>
					<div class="header-text  mb-3">
						<h1 >สมัครสมาชิก</h1>
						<p>กรุณากรอกข้อมูลของคุณ</p>
					</div>
					<form action = "insert_register.php" method="POST" >
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
							<?php
						if(isset($_SESSION["error"])){
							echo "<div class ='text-danger'>";
							echo $_SESSION["error"];
							echo "</div>";
							unset ($_SESSION['error']);
						}
						?>
						<br>
						<div>						
							<button type="submit" name="signup" class="w-100 fs-6 btn btn-primary">
								<i class='bx bx-lock-open'></i> Sign up
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