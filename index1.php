<?php
	include 'condb.php';	
	session_start();
	
	$sql1 	=  	"SELECT p.product_id, pt.p_name, p.product_qty 
				FROM product AS p 
				INNER JOIN product_type AS pt ON pt.pt_id = p.pt_id";
	$query1 	= 	mysqli_query($conn, $sql1);
	$p_name 	 = 	array();
	$product_qty =	array();

	foreach($query1 as $key => $value){
		$p_name[]		=	$value['p_name'];
		$product_qty[]	= 	$value['product_qty'];
	}

	$sql2 	=  	"SELECT 
					COUNT(r.repair_id) AS repair_product,
					(SELECT SUM(product_qty) FROM product) AS total_product
				FROM repair AS r";
	$query2 = 	mysqli_query($conn, $sql2);
	$repair_product = 	array();
	$total_product 	=	array();

	while ($row = mysqli_fetch_assoc($query2)) {
		$repair_product[] 	= 	$row['repair_product'];
		$total_product[] 	= 	$row['total_product'];
	}

	//ดึงข้อมูลการดำเนินการ 
	$sql3 = "SELECT COUNT(repair_id) AS wait from repair where repair_status_id='1'";
	$hand=mysqli_query($conn,$sql3);
	$row3=mysqli_fetch_array($hand);

	//ดึงข้อมูลส่งซ่อม 
	$sql4 = "SELECT COUNT(repair_id) AS repair from repair where repair_status_id='2'";
	$hand=mysqli_query($conn,$sql4);
	$row4=mysqli_fetch_array($hand);

	//ดึงข้อมูลการดำเนินการสำเร็จ
	$sql5 = "SELECT COUNT(repair_id) AS finish from repair where repair_status_id='3'";
	$hand=mysqli_query($conn,$sql5);
	$row5=mysqli_fetch_array($hand);

	$sql_G1 = "SELECT COUNT(repair_id) as repair_id from repair where review_grade ='1'";
    $result1 = mysqli_query($conn, $sql_G1);
    $row_G1 = mysqli_fetch_array($result1);

    $sql_G2 = "SELECT COUNT(repair_id) as repair_id from repair where review_grade ='2'";
    $result2 = mysqli_query($conn, $sql_G2);
    $row_G2 = mysqli_fetch_array($result2);

    $sql_G3 = "SELECT COUNT(repair_id) as repair_id from repair where review_grade ='3'";
    $result3 = mysqli_query($conn, $sql_G3);
	$row_G3 = mysqli_fetch_array($result3);

    $sql_G4 = "SELECT COUNT(repair_id) as repair_id from repair where review_grade ='4'";
    $result4 = mysqli_query($conn, $sql_G4);
    $row_G4 = mysqli_fetch_array($result4);

    $sql_G5 = "SELECT COUNT(repair_id) as repair_id from repair where review_grade ='5'";
    $result5 = mysqli_query($conn, $sql_G5);
    $row_G5 = mysqli_fetch_array($result5);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="styles/main_page.css">
	<!-- Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" >
	<!-- jquery -->
	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
	<!-- SweetAlert -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.all.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.min.css" rel="stylesheet">
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
				<li class="active">
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
				<li>
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
			<div class="head-title">
				<div class="left">
					<h1>Dashboard</h1>					
				</div>				
			</div>			

			<ul class="box-info">
				<li>
					<i class='bx bx-info-circle'></i>
					<span class="text">
						<h3><?=$row3['wait']?></h3>
						<p>กำลังดำเนินการ</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-wrench'></i>
					<span class="text">
					<h3><?=$row4['repair']?></h3>
						<p>ส่งซ่อม</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-check-circle'></i>
					<span class="text">
					<h3><?= $row5['finish'] ?></h3>
						<p>ดำเนินการสำเร็จ</p>
					</span>
				</li>				
			</ul>

			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>จำนวนอุปกรณ์</h3>						
					</div>
					<div class = "barchart">
						<canvas id="barchart"></canvas>
					</div>
				</div>
				<div class="todo">
					<div class="head">
						<h3>จำนวนอุปกรณ์ที่ส่งซ่อม / จำนวนอุปกรณ์ทั้งหมด</h3>
					</div>
					<div class = "piechart">
						<canvas id="piechart"></canvas>
					</div>
				</div>
			</div>

			<div class="review-title">
				<div class="left">
					<h1>คะแนนรีวิวระบบการแจ้งซ่อม</h1>					
				</div>			
			</div>
			<ul class="rate-info">
				<li>
					<i class='bx bxs-laugh'></i>
					<span class="text">
						<h3><?= $row_G5['repair_id'] ?></h3>
						<p>ดีมาก</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-happy-alt'></i>
					<span class="text">
						<h3><?= $row_G4['repair_id'] ?></h3>
						<p>ดี</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-meh' ></i>					
					<span class="text">
						<h3><?= $row_G3['repair_id'] ?></h3>
						<p>ปานกลาง</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-sad' ></i>					
					<span class="text">
						<h3><?= $row_G2['repair_id'] ?></h3>
						<p>พอใช้</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-angry' ></i>					
					<span class="text">
						<h3><?= $row_G1['repair_id'] ?></h3>
						<p>ปรับปรุง</p>
					</span>
				</li>
			</ul>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->	

	<script src="script.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

	<script>
		const a = document.getElementById('barchart');
		new Chart(a, {
			type: 'bar',
			data: {
			labels: <?php echo json_encode($p_name)?>,
			datasets: [{
				label: 'จำนวนอุปกรณ์',
				data: <?php echo json_encode($product_qty)?>,
				backgroundColor: [
					'rgba(255, 99, 132)',
					'rgba(255, 159, 64)',
					'rgba(255, 205, 86)',
					'rgba(75, 192, 192)',
					'rgba(54, 162, 235)',
					'rgba(153, 102, 255)',
					'rgba(201, 203, 207)'
				],			
				hoverOffset: 4
			}]
			}
		});

		const b = document.getElementById('piechart');
		new Chart(b, {
			type: 'pie',
			data: {
			labels: ['จำนวนอุปกรณ์ที่ส่งซ่อม','จำนวนอุปกรณ์ทั้งหมด'],
			datasets: [{
				label: 'จำนวนอุปกรณ์',
				data: [<?php echo json_encode($repair_product)?>,<?php echo json_encode($total_product)?>],
				backgroundColor: [
				'rgb(255, 99, 132)',
				'rgb(54, 162, 235)'				
				],
				hoverOffset: 4
			}]
			}
		});
	</script>
</body>
</html>