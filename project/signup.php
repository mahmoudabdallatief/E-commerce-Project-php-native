 <?php
 session_start();
 if(isset($_SESSION['login'])){
  header("Location:products.php");
  exit();
}
$pagename ="Sign Up";
include "include files/connect.php";
include "include files/header.php";
@$username = $_POST['username'];
@$password = $_POST['password'];
$md5 =md5($password);

$sql_check = "SELECT * FROM users WHERE username='$username' OR password='$md5'";
$result_check = $conn-> query($sql_check);
$num = $result_check -> num_rows;
if($_SERVER['REQUEST_METHOD']=='POST' &&  preg_match("/^[a-zA-Z0-9]{6,20}$/" , $username) && preg_match("/^[a-zA-Z0-9]{6,20}$/" , $password) &&!empty($username)&& !empty($password) && $num==0){
    
    $sql_insert ="INSERT INTO users( username, password) VALUES ('$username','$md5')";
    $result_insert = $conn -> query($sql_insert);
    
        }


if($_SERVER['REQUEST_METHOD']=='POST' && @$sql_insert ==TRUE){
  header("Location:login.php");
  exit();
}


if($_SERVER['REQUEST_METHOD']=='POST' &&(!preg_match("/^[a-zA-Z0-9]{6,20}$/" , $username)  || !preg_match("/^[a-zA-Z0-9]{6,20}$/" , $password) || empty($username)|| empty($password))){
  header("Location:?error");
  exit();
}

if($_SERVER['REQUEST_METHOD']=='POST' && $num > 0 &&!empty($username)&& !empty($password)){
  header("Location:?warning");
  exit();
  }




?>
<?php @$error =$_GET['error'];
  if(isset($error)){?>
  <input type="hidden" class="hidden" value="2">
  <?php
  }
  ?>
<div class="container mt-5">
<div class="row justify-content-center">
    <div class="col-lg-4 col-md-6 col-sm-12  bg-white border-1 rounded-3 shadow-lg">
     
    <p class=" mt-3 pb-2 border-bottom  " style="color:crimson; font-size:20px;">Sign up</p>

      <h5 class="text-start" style="color:crimson;">The input field must contain between 6 to 20 letters or numbers And not Contain (space or any symbol)</h5>
    <form role="form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <br>
        <div class="input-group">
  <input type="text" class="form-control user" placeholder="username" name="username">
</div>	
<br>
  
<div class="input-group">
  <input type="password" class="form-control  pass" placeholder="password" name="password" >
  
  <span class="input-group-text eye-icon" ><i class="fa-sharp fa-solid fa-eye"></i></span>
</div>					
  <br>	
  <?php
  if(isset($_GET['warning'])){
echo' <div class="alert alert-warning text-dark p-2">username or password is already exist</div> 
<br> ';
  }
  ?>	
<button class="btn login text-start  mb-3" type="submit">Sign up</button>
</form>
<?php
if(!isset($_COOKIE["id"])){
    ?>
<div class="mb-3">
<a href="login.php" style="color:crimson">Do you already have an account?</a>
</div>

<?php
}
?>	
    </div>
   
</div>
</div>

<script src="js/jquery-3.6.1.min.js"></script>
<script>
    $(".user").keyup(function(){
        var user = $(".user").val()
        var lenuser = user.length
        if(lenuser >20 ||lenuser<6){
$(".user").attr("style","color:red;")
        }
        if(lenuser <= 20 && lenuser>=6){
$(".user").attr("style","color:black;")
        }
    })
    $(".pass").keyup(function(){
        var pass = $(".pass").val()
        var lenpass = pass.length
        if(lenpass >20||lenpass<6){
$(".pass").attr("style","color:red;")
        }
        if(lenpass <= 20 && lenpass >=6){
$(".pass").attr("style","color:black;")
        }
    })
    $(".eye-icon").click(function(){
    var eye = $(".pass").attr("type")
    if(eye=="password"){
$(".pass").attr("type","text")
    }
    if(eye=="text"){
        $(".pass").attr("type","password")
            }
 })
 var hidden = $(".hidden").val()

if(hidden==2){
   Swal.fire({
       position: 'top-',
       icon: 'error',
       title: 'Account registration failed',
       showConfirmButton: false,
       timer: 2000,
  
     })

}
</script>

</body>
</html>