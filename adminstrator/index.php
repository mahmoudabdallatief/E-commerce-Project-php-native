<?php
$pagename ='Login';
ini_set('session.cookie_lifetime', 60 * 60 * 24 * 365);
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
session_start();
include 'include files/header.php';
include 'sql/connect.php';
error_reporting(E_ALL & ~E_NOTICE);
@$user = htmlspecialchars($_POST['username']);
@$pass = htmlspecialchars($_POST['password']);
$md5 = md5($pass);
$sql= "SELECT * FROM admin WHERE username='$user' AND password ='$md5'";
$result = $conn -> query($sql);
foreach ($result as $row) {
  $pri = $row['pri'];
  
}
$num = $result->num_rows;
if($_SERVER['REQUEST_METHOD']=='POST' && $num==1){
   
    $_SESSION['log']= $pri;
   
}
if(isset($_SESSION['log'])){
  header("Location:dashboard.php");
  exit();
}
 ?>
 <br>
 <br>
<div class="container  ">
<div class="row  justify-content-center">
		<div class="col-lg-4 col-md-12 col-sm-12 border border-1 shadow rounded-3 ">
        <div class=" mt-3 pb-2 border-bottom  " style="color:chocolate;">Login</div>
		<form role="form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <br>
        <div class="input-group">
  <input type="text" class="form-control" placeholder="username" name="username">
</div>	
<br>
  
<div class="input-group">
  <input type="password" class="form-control  pass" placeholder="password" name="password" >
  
  <span class="input-group-text eye-icon" ><i class="fa-sharp fa-solid fa-eye"></i></span>
</div>					
        

  <br>
	
<?php
if( $_SERVER['REQUEST_METHOD']=='POST'  && $num == 0){
   echo '<div class="alert alert-danger p-2">username or password error</div>';
}
?>
	

	


						
			<button class="btn login text-start  mb-3" type="submit">Login</button>

					</form>
				</div>
		
</div>
    </div>
		<!-- /.col-->
	</div>
    </div>
 <?php include 'include files/footer.php'; ?>