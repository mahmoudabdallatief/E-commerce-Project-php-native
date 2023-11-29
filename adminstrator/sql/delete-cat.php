<?php 
	include 'connect.php';
	$id = $_GET['id'];
	$sql2= "SELECT * FROM prro WHERE cat='$id'";
	$result=$conn->query($sql2);
	while($row=$result->fetch_assoc()) {
		
		$del= $row['cat'];
	}

	$sql_parent = "SELECT * FROM cat WHERE id ='$id'";
	$result_parent=$conn->query($sql_parent);
	while($row_parent=$result_parent->fetch_assoc()) {
		
		$parent= $row_parent['parent'];
	}

if(!isset($del) && $parent!=0){
$sql = "DELETE  FROM cat WHERE id = '$id' ";
 $conn -> query($sql);

 header("Location:../category.php?delete");
}

else{
echo '<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/x-icon" href="../assets/images/34583214-logo-admin-icon-administrator-illustration-of-a-man-in-a-jacket-and-shirt-ties-jacket-and-shirt-.webp">
	<link rel="stylesheet" href="../assets/css/bootstrap.css">
	<link rel="stylesheet" href="../assets/css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />  
	<title>ERROR</title>
</head>
<body>
<br>
<br>
<div class="container  ">
<div class="row  justify-content-center">
   <div class="col-lg-4 col-md-12 col-sm-12 border border-1 shadow rounded-3 ">
       <div class=" mt-3 pb-2 border-bottom  text-danger">ERROR</div>
<br>	
<div class=" mb-3 pb-2   text-danger">You can\'t delete category has been used</div>    
       </div>
 </div>
   </div>
   </body>
       </html>';
}
	



 ?>