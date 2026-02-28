<?php
	include "condb.php";
	session_start();
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
			<li class="active">
				<a href="login.php">
					<i class='bx bxs-user-circle'></i>
					<span class="text">เข้าสู่ระบบ</span>
				</a>
			</li>
			<li >
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
			<ul class="box-info login">
				<li>
					<div class="header-text  mb-3">
						<h1 >เข้าสู่ระบบ</h1>
						<p>กรุณากรอกข้อมูลเพื่อเข้าสู่ระบบ</p>
					</div>
					<form action = "login_check.php" method="POST" >
						<div class="input-group mb-3">					
							<input class="form-control" name="username" type="text" placeholder="username" aria-label="default input example">
						</div>

						<div class="input-group mb-3">
							<input class="form-control" name="password" id="password" type="password" placeholder="password" aria-label="default input example">	
						</div>
						<?php
						if (isset($_SESSION['register'])) { ?>
							<script>
								Swal.fire({
									icon: 'success',
									title: "บันทึกข้อมูลสำเร็จ",
									customClass: {
										title: 'custom-title-class'
									}
								});
							</script>
							<?php
								unset($_SESSION['register']);
							}
							?>
						<?php
						if(isset($_SESSION["error"])){
							echo "<div class ='text-danger'>";
							echo $_SESSION["error"];
							echo "</div>";
							unset ($_SESSION['error']);
						}
						?>
                    	<div class="form-check mb-3">
							<input class="form-check-input" type="checkbox" id="checkbox" onchange="togglePassword()">
							<label class="form-check-label" for="checkbox">Show password</label>
						</div>

						<div>						
							<button type="submit" name="signin" class="w-100 fs-6 btn btn-primary">
								<i class='bx bx-lock-open'></i> Sign In
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
	<script>
		function togglePassword() {
			var passwordField = document.getElementById("password");
			var checkbox = document.getElementById("checkbox");

			if (checkbox.checked) {
				passwordField.type = "text";
			} else {
				passwordField.type = "password";
			}
		}
	</script>
</body>
</html>