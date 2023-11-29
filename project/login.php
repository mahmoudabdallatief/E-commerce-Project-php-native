<?php
 ini_set('session.cookie_lifetime', 60 * 60 * 24 * 365);
 header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
 session_start();
 if(isset($_SESSION['login'])){
    header("Location:products.php");
    exit();
  }
$pagename ="Login";
include "include files/connect.php";
include "include files/header.php";
@$username = htmlspecialchars($_POST['username']);
@$password = htmlspecialchars($_POST['password']);
@$id= $_COOKIE["id"];
$md5 =md5($password);
if(!empty($username)&& !empty($password)){
    $sql_login ="SELECT id_user FROM users WHERE username='$username' AND password = '$md5'";
    $result_login = $conn -> query($sql_login);
    
        foreach ($result_login as $row ) {
           $id_user =$row['id_user'];
            
       
    }
    
}
    

if($_SERVER['REQUEST_METHOD']=='POST'  && $sql_login==TRUE ){
    
 @$_SESSION['login'] = $id_user;

   
}


    
   if(isset( $_SESSION['login'])&& !$id){
    header("Location:products.php");
    exit();
 }
 if(isset( $_SESSION['login'])&& $id){
    header("Location:addtochart.php");
    exit();
 }

if($_SERVER['REQUEST_METHOD']=='POST' && !isset($_SESSION['login'])){
    header("Location:?error");
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
     
        <p class=" mt-3 pb-2 border-bottom  " style="color:crimson; font-size:20px;">Login</p>
        
 
    <form role="form" action="login.php" method="post">
       
        <div class="input-group">
  <input type="text" class="form-control user" placeholder="username" name="username">
</div>	
<br>
  
<div class="input-group">
  <input type="password" class="form-control  pass" placeholder="password" name="password" >
  
  <span class="input-group-text eye-icon" ><i class="fa-sharp fa-solid fa-eye"></i></span>
</div>					
  <br>	
<button class="btn login text-start  mb-3" type="submit">Login</button>
</form>
<?php
if(isset($_COOKIE["id"])){
    ?>
   <div class="mb-3">
   <a href="signup.php" style="color:crimson">If you don't have an account please click here</a>
</div>
    <?php
}
?>

    </div>

</div>
</div>

<script src="js/jquery-3.6.1.min.js"></script>
<script>

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
       position: 'top-top',
       icon: 'error',
       title: 'Login failed',
       showConfirmButton: false,
       timer: 2000,
  
     })

}

</script>
</body>
</html>