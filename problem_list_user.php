<?php
session_start();
include 'condb.php';

if(!isset($_SESSION['user_login']) && !isset($_SESSION['admin_login'])){
	$_SESSION['error'] = 'กรุณาเข้าสู่ระบบ';
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
	<link rel="stylesheet" href="styles/list.css">

	<!-- Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	
	<!-- jquery -->
	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

	<!-- SweetAlert -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.all.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.min.css" rel="stylesheet">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
	
	<title>ระบบแจ้งซ่อม</title>
	<style>
		.custom-title-class {
			font-family: var(--prompt);
		}

		.custom-input-class {
			font-family: var(--prompt);
		}

		.fa-star {
			font-size: 40px;
			color: #ccc;
			cursor: pointer;
		}

		.checked {
			color: orange;
		}
	</style>
</head>

<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs-wrench'></i>
			<span class="text">ระบบแจ้งซ่อม</span>
		</a>
		<ul class="side-menu top">
			<li>
				<a href="main_page.php">
					<i class='bx bxs-home'></i>
					<span class="text">หน้าหลัก</span>
				</a>
			</li>
			<li>
				<a href="problem_report_user.php">
					<i class='bx bxs-edit'></i>
					<span class="text">แจ้งปัญหา</span>
				</a>
			</li>
			<li class="active">
				<a href="problem_list_user.php">
					<i class='bx bxs-edit'></i>
					<span class="text">รายการแจ้งซ่อม</span>
				</a>
			</li>			
		</ul>
		<ul class="side-menu">
			<li>
				<a href="logout.php" class="logout">
					<i class='bx bx-log-out'></i>
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
			<i class='bx bx-menu'></i>

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
					<h1>รายการแจ้งซ่อม</h1>
					<ul class="breadcrumb">
						<li>
							<i class='bx bxs-user-plus'></i>
							<a class="text active" href="problem_report_user.php">เพิ่มรายการแจ้งซ่อม</a>
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
									<th>ชื่อผู้แจ้ง</th>
									<th>สถานะ</th>
									<th>อุปกรณ์ที่ชำรุด</th>
									<th>รายละเอียด</th>
									<th>วันที่แจ้ง</th>
									<th>รูปอุปกรณ์ที่ชำรุด</th>
									<th>รีวิว</th>							
								</tr>
							</thead>
							<tbody>
								<?php
								$sql =  "SELECT  ROW_NUMBER() OVER () AS row_number, r.repair_id, r.user, rs.repair_status, pt.p_name, r.repair_detail, r.repair_date ,r.repair_img
									FROM repair AS r 
									INNER JOIN product_type AS pt ON pt.pt_id = r.pt_id
									INNER JOIN repair_status AS rs ON rs.repair_status_id  = r.repair_status_id 
									WHERE r.user_id = '$user_id'";

								$result = mysqli_query($conn, $sql);
								while ($row = mysqli_fetch_array($result)) {
								?>


									<tr>
										<td><?= $row['row_number'] ?></td>
										<td><?= $row['user'] ?></td>
										<td><a href="" class="btn btn-success btn-sm"><?= $row['repair_status'] ?></a></td>
										<td><?= $row['p_name'] ?></td>
										<td><?= $row['repair_detail'] ?></td>
										<td><?= date('d/m/Y', strtotime($row['repair_date'])) ?></td>
										<td>
											<?php if(!empty($row['repair_img'])): ?>
												<img src="img/img_problem/<?=$row['repair_img']?>">
											<?php else: ?>
												<img src="img/no-image.png">
											<?php endif; ?>
										</td>
										<form method="post" class="update-form" action="update_review.php" id="repair_id" enctype="multipart/form-data">
											<input type="hidden" name="repair_id" id="repair_id" value="<?= $row['repair_id'] ?>">
											<td><button type="submit" class="btn btn-success btn-sm review-btn">รีวิว</button></td>
										</form>
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
			if (isset($_SESSION['delete'])) { ?>
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

			<!-- SweetAlert Edit -->
			<?php
			if (isset($_SESSION['Edit_update'])) { ?>
				<script>
					Swal.fire({
						icon: "success",
						title: "อัพเดตข้อมูลสำเร็จ",
						customClass: {
							title: 'custom-title-class'
						}
					});
				</script>
			<?php
				unset($_SESSION['Edit_update']);
			}
			?>
			<!-- SweetAlert Edit -->

			<!-- SweetAlert Insert -->
			<?php
			if (isset($_SESSION['insert'])) { ?>
				<script>
					Swal.fire({
						icon: 'warning', // ใช้คำสั่งใน SweetAlert2 ในการแก้รูปicon
						iconColor: '#28a745', // เปลี่ยนสีไอคอน
						title: "รับเรื่องแล้วจะรีบจัดการโดยด่วน",
						customClass: {
							title: 'custom-title-class'
						}
					});
				</script>
			<?php
				unset($_SESSION['insert']);
			}
			?>
			<!-- SweetAlert Insert -->

			<!-- AJAX + SweetAlert -->
			<script>
				$(document).ready(function() {
					$('.review-btn').click(function(e) {
						e.preventDefault();
						var repair_id = $(this).closest('tr').find('td:first').text();
						Swal.fire({
							title: 'ระดับความพึ่งพอใจในการซ่อม',
							customClass: {
								title: 'custom-title-class'
							},
							html: `
							<span class="fa fa-star unchecked" data-rating="1"></span>
							<span class="fa fa-star unchecked" data-rating="2"></span>
							<span class="fa fa-star unchecked" data-rating="3"></span>
							<span class="fa fa-star unchecked" data-rating="4"></span>
							<span class="fa fa-star unchecked" data-rating="5"></span>
						`,
							showCancelButton: true,
							confirmButtonText: 'Submit',
							didOpen: function() {
								$('.fa-star').click(function() {
									var rating = $(this).attr('data-rating');
									$('.fa-star').removeClass('checked');
									for (var i = 1; i <= rating; i++) {
										$('.fa-star[data-rating="' + i + '"]').addClass('checked');
									}
								});
							},
							preConfirm: function() {
								return $.ajax({
									type: 'POST',
									url: 'update_review.php',
									data: {
										review: $('.fa-star.checked').length,
										repair_id: repair_id
									},
									success: function(response) {
										console.log(response);
									}
								});
							}
						}).then(function(result) {
							if (result.isConfirmed) {
								Swal.fire({
									icon: 'success',
									title: "ขอบคุณสำหรับคำติชม",
									customClass: {
										title: 'custom-title-class'
									}
								});
							}
						});
					});
				});
			</script>
		</main>
	</section>

	<!-- CONTENT -->

	<script src="script.js"></script>
</body>

</html>