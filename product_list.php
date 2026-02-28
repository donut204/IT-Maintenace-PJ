<?php
	session_start();
	include 'condb.php';
	
	if (!isset($_SESSION['admin_login'])) {        
        $_SESSION['error'] = "กรุณาเข้าสู่ระบบ";
        header('location: login.php');        
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
	<link rel="stylesheet" href="styles/p_list.css">

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
			<li  class="active">
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
        
        <main>
			<div class="head-title">
				<div class="left">
					<h1>รายการอุปกรณ์</h1>
					<ul class="breadcrumb">
						<li>
							<i class='bx bxs-user-plus'></i>												
							<a class="text active" href="form_product.php">เพิ่มอุปกรณ์</a>
						</li>
					</ul>					
				</div>				
			</div>

            <div class="table-data">
				<div class="order">					
					<table>
					<table>
						<thead>
							<tr>
								<th>ID</th>
								<th>ชื่ออุปกรณ์</th>
								<th>จำนวนอุปกรณ์</th>
								<th>รูปอุปกรณ์</th>
								<th>Edit</th>
								<th>Delete</th>
							</tr>
						</thead>
						<tbody>
						<?php
							$sql =  "SELECT p.product_id, pt.p_name, p.product_img, p.product_qty 
									FROM product AS p 
									INNER JOIN product_type AS pt ON pt.pt_id = p.pt_id";

							$result = mysqli_query($conn, $sql);
							while($row = mysqli_fetch_array($result)){
						?>						
							<tr>
								<td><?=$row['product_id']?></td>								
								<td><?=$row['p_name']?></td>								
								<td><?=$row['product_qty']?></td>								
								<td>
									<?php if(!empty($row['product_img'])): ?>
										<img src="img/img_upload/<?=$row['product_img']?>">
									<?php else: ?>
										<img src="img/no-image.png">
									<?php endif; ?>
								</td>								
								<td><a href="edit_form_pro.php?id=<?=$row['product_id']?>" class="btn btn-warning btn-sm" >Edit</a></td>
								<td><a href="delete_product.php?id=<?=$row['product_id']?>" class="btn btn-danger btn-sm " >Delete</a></td>
							</tr>
						<?php		
							}
							mysqli_close($conn);
						?>							
						</tbody>
					</table>
				</div>				
			</div>
			<!-- SweetAlert Delete -->			
			<?php
				if(isset($_SESSION['insert_success'])){ ?>
					<script>
						Swal.fire({
						icon: "success",
						title: "เพิ่มอุปกรณ์สำเร็จ",
						customClass: {
							title: 'custom-title-class'
							}
						});
					</script>			
				
			<?php
				unset($_SESSION['insert_success']);
				}
			?>			
			<?php
				if(isset($_SESSION['Edit_update'])){ ?>
					<script>
						Swal.fire({
						icon: "success",
						title: "บันทึกข้อมูลสำเร็จ",
						customClass: {
							title: 'custom-title-class'
							}
						});
					</script>			
				
			<?php
				unset($_SESSION['Edit_update']);
				}
			?>
			<?php
				if(isset($_SESSION['delete'])){ ?>
					<script>
						Swal.fire({
						icon: "success",
						title: "ลบข้อมูลสำเร็จ",
						customClass: {
							title: 'custom-title-class'
							}
						});
					</script>			
				
			<?php
				unset($_SESSION['delete']);
				}
			?>			
			<!-- SweetAlert Delete -->					
        </main>
	</section>
	<!-- CONTENT -->
	

	<script src="script.js"></script>
</body>
</html>