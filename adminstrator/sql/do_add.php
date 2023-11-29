<?php
// Include the connection file
include 'connect.php';

// Disable error reporting for notices
error_reporting(E_ALL & ~E_NOTICE);

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Sanitize and validate user inputs
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $price = $_POST['price'];
  $count = $_POST['count'];
  $cat = $_POST['cat'];
  $brand = $_POST['brand'];
  $des = mysqli_real_escape_string($conn, $_POST['describtion']);
  $date = mysqli_real_escape_string($conn, $_POST['date']);
  $offer = $_POST['offer'];
  $error = array();

  // Get the uploaded image files
  $file_name = $_FILES['upload']['name'];
  $array_img = array();
  $count_file = count($file_name);
  $ext = array("jpg","jpeg","png","gif");
  // Loop through each file and validate it
  for ($i = 0; $i < $count_file; $i++) {
    if (($_FILES['upload']['size'][$i] < 20000000000000000000000) &&
    ($_FILES['upload']['type'][$i] == 'image/jpg' ||
     $_FILES['upload']['type'][$i] == 'image/jpeg' ||
     $_FILES['upload']['type'][$i] == 'image/gif' ||
     $_FILES['upload']['type'][$i] == 'image/png') &&
    ($name !== '' &&
     $price !== '' &&
     $count !== '' &&
     $offer !== '' &&
     $cat !== '' &&
     $brand !== '' &&
     mb_strlen($des, 'utf8') > 4 &&
     
     ($offer !== '' && ($offer === "0" || preg_match('/^(?:\d+\.?\d*|\.\d+)$/', $offer))) &&
     ($price !== '' && ($price === "0" || preg_match('/^(?:\d+\.?\d*|\.\d+)$/', $price)))&&($count !== '' && ($count === "0" || preg_match('/^\d+$/', $count))))) {
      // Generate a unique filename for the uploaded image
      $new_img_name = md5(uniqid()) . $file_name[$i];
      $folder = "../assets/images/$new_img_name";
      // Move the uploaded file to the designated folder
      move_uploaded_file($_FILES['upload']['tmp_name'][$i], $folder);
      array_push($array_img, $new_img_name);
      // Count the number of uploaded images
      $img_count = count($array_img);
      // Convert the array of image names into a comma-separated string
      $implode = implode(",", $array_img);
    }
    $explode[$i] =explode(".",$file_name[$i]);                        
    $end[$i]= end($explode[$i]);
 
            if(!in_array($end[$i],$ext) && $_FILES['upload']['name'][0]!=""   ){
             array_push($error , "The type of image is not valid");
            }
            if($_FILES['upload']['size'][$i] > 20000000000000000000000 && $_FILES['upload']['name'][0]!=""  )  {
              array_push($error , "The Size of image is so big");
             } 
  }

  // If all the images are uploaded successfully and the required fields are not empty, insert the data into the database
  if ($img_count == $count_file) {
  
      // Construct the SQL query to insert the data into the database
      $sql1 = "INSERT INTO prro(name, price, count, brand, cat, des, cover, date, offer) VALUES ('$name','$price','$count','$brand','$cat','$des','$implode','$date','$offer')";
      // Execute the SQL query
      $result1 = $conn->query($sql1);
      // Redirect the user to the products page with a success message
      header("Location:../products.php?add");
    }
  

  // Validate user inputs and add any errors to the error array
  if (empty($name)) {
    array_push($error, "Empty input of name");
  }
  if ($price === '') {
    array_push($error, "Empty input of price");
  }
  if ($count === '') {
    array_push($error, "Empty input of count");
  }
  if ($offer === '') {
    array_push($error, "Empty input of offer");
  }
  if (empty($cat)) {
    array_push($error, "Empty input of category");
  }
  if (empty($brand)) {
    array_push($error, "Empty input of brand");
  }
  if ( $_FILES['upload']['name'][0]=="")   {
    array_push($error , "Empty input of image");
   } 
  if (mb_strlen($des, 'utf8') <= 4) {
    array_push($error, "Description is equal or less than 4 characters");
  }
  
  if (!empty($count) && !preg_match('/^\d+$/', $count)) {
    array_push($error, "The Count must be integer");
  }
  if (!empty($offer) && !preg_match('/^(?:\d+\.?\d*|\.\d+)$/', $offer)) {
    array_push($error, "The Offer must be integer or decimal number");
  }
  if (!empty($price) && !preg_match('/^(?:\d+\.?\d*|\.\d+)$/', $price)) {
    array_push($error, "The Price must be integer or decimal number");
  }
  
  
  $err_count = count($error);
  // If there are any errors, redirect the user to the add product page with an error message
  if( $err_count  > 0) {
    ?>
<!DOCTYPE html>
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
               <div class=" mt-3 pb-2 border-bottom  text-danger">
                    ERROR
                   </div>
           <br>	
           <div class=" mb-3 pb-2   text-danger">This Error because the following :- </div>
            	
                <?php
                $c =1;
                for ($z=0; $z <$err_count ; $z++) { 
                  ?>
                  <p class="   mb-3 pb-2   text-danger"><?php echo $c++ ." - ". $error[$z]?> .</p>
                  <?php
                }
                ?>
                   </div>
           </div>
               </div>
           </body>
           </html>
    <?php
  }
}
?>