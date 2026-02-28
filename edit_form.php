<?php    
    include 'condb.php';
	session_start();

	if(!isset($_SESSION['admin_login'])){
		$_SESSION['error'] = 'กรุณาเข้าสู่ระบบ';
		header('location: login.php');
	}
	$id = $_GET['id'];
	$sql = "SELECT p.per_id, t.t_name, p.f_name, p.l_name, p.tel_num ,s.s_name , u.username , u.password 
			FROM personal AS p
			INNER JOIN title_name AS t ON t.t_id = p.t_id
			INNER JOIN tb_status AS s ON s.status_id = p.status_id
			INNER JOIN user AS u ON u.user_id = p.user_id
			WHERE p.per_id = '$id'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($result);   
    
	$query_tname =  "SELECT * FROM title_name";
	$data_tname = mysqli_query($conn, $query_tname);
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$password = $_POST['password'];
		$update_sql = "UPDATE user SET password = '$password' WHERE user_id = $id";
		mysqli_query($conn, $update_sql);
	}	
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
						<h1 >แก้ไขข้อมูลผู้ใช้งาน</h1>
						<p></p>
					</div>
					<form action = "update_member.php" method="POST" enctype="multipart/form-data">
						<label for="username" class="form-label mb-1 ">ID : </label>
						<div class="input-group mb-3 	 ">
							<span class="input-group-text" id="username"><i class='bx bx-list-ul btn-outline-primary'></i></span>
							<input id="inputGroup-sizing-sm" class="form-control" name="id" type="text" aria-label="default input example" readonly value="<?php echo $row['per_id']?>" >
						</div>

						<label for="username" class="form-label mb-1 ">Username : </label>
						<div class="input-group mb-3">
							<span class="input-group-text" id="username"><i class='bx bxs-user-circle btn-outline-primary'></i></span>
							<input id="username" class="form-control" name="username" type="text" placeholder="" aria-label="default input example" value="<?php echo $row['username']?>" >
						</div>

						<label for="username" class="form-label mb-1 ">Password : </label>
						<div class="input-group mb-3 	 ">
							<span class="input-group-text" id="password"><i class='bx bxs-key btn-outline-primary'></i></span>
							<input id="passwordinput" class="form-control" name="password" type="password" placeholder="" aria-label="default input example" value="<?php echo $row['password']?>">
							<img src = img/hide.png id="eyeicon" class="eye-icon">						
						</div>						
						
						<label for="product">คำนำหน้าชื่อ</label>
							<div class="input-group mb-3">
								<span class="input-group-text" id="product"><i class='bx bx-receipt btn-outline-primary'></i></span>
								<select name="titlename" id="product" class="form-control" aria-label="default input example">
									<?php        
									while($row1 = mysqli_fetch_array($data_tname)){
										$selected = ($row1['t_name'] == $row['t_name']) ? 'selected' : '';
									?>
										<option value="<?php echo $row1['t_id']?>" <?php echo $selected ?>>
											<?php echo $row1['t_name']?>
										</option>                                   
									<?php }?>
								</select>
							</div>			
							
						<label for="username" class="form-label mb-1 ">ชื่อ : </label>
						<div class="input-group mb-3 	 ">
							<span class="input-group-text" id="username"><i class='bx bx-id-card btn-outline-primary'></i></span>
							<input id="username" class="form-control" name="f_name" type="text" placeholder="" aria-label="default input example" value="<?php echo $row['f_name']?>">
						</div>

						<label for="username" class="form-label mb-1 ">นามสกุล : </label>
						<div class="input-group mb-3 	 ">
							<span class="input-group-text" id="username"><i class='bx bx-id-card btn-outline-primary'></i></span>
							<input id="username" class="form-control" name="l_name" type="text" placeholder="" aria-label="default input example" value="<?php echo $row['l_name']?>">
						</div>

						<label for="username" class="form-label mb-1 ">เบอร์โทรศัพท์ : </label>
						<div class="input-group mb-3 	 ">
							<span class="input-group-text" id="username"><i class='bx bxs-phone btn-outline-primary'></i></span>
							<input id="username" class="form-control" name="tel_num" type="text" placeholder="" aria-label="default input example" value="<?php echo $row['tel_num']?>">
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
                                <i class='bx bx-paper-plane'></i> บันทึกข้อมูล
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