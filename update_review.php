<?php

include 'condb.php';

// รับค่าจาก AJAX
$id = $_POST['repair_id'];
$review = $_POST['review'];


$sql_update_review = "UPDATE repair SET review_grade='$review' WHERE repair_id = '$id'";
$result=mysqli_query($conn,$sql_update_review);   

?>
