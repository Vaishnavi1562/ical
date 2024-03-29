<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="partials/hey.css">
</head>
</html>
<?php
$showalert = false;
$showerr = false;
if ($_SERVER["REQUEST_METHOD"] == "POST"){
  include 'partials/_dbconnent.php';
  $username = $_POST["username"];
  $password = $_POST["password"];
  $cpassword = $_POST["cpassword"];
  $existSql = "SELECT * FROM `users` WHERE username = '$username'";
  $result = mysqli_query($conn,$existSql);
  $numexistrows = mysqli_num_rows($result);
  if ($numexistrows >0){
    $showerr = "user already exists";
  }
  else{
    if ($password==$cpassword){
      $hash = password_hash($password, PASSWORD_DEFAULT);
      $sql = "INSERT INTO `users` (`username`, `password`, `dt`) VALUES ('$username', '$hash', current_timestamp())";
      $result = mysqli_query($conn,$sql);
      if ($result){
        $showalert = True;
      }
    }
    else{
      $showerr = "Passwords don't match.";
    }
  }
}
  

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="partials/hey.css" rel="stylesheet">
    <title>Signup</title>
  </head>
  <body>
    <?php
    require 'partials/_nav.php';
    ?>
    <?php
    if ($showalert){
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success!</strong> Your account has been added.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    if ($showerr){
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>oops!</strong>'.$showerr.'
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
     
    ?>
    <div class="jumbotron big-banner">
    <div class="container my-4">
        <h1 class = "text-center">Signup to our Website</h1>
        <form action = "/calender/signup.php" method = "post">
            <div class="form-group col-md-6">
                <label for="username" class="form-label">Name</label>
                <input type="text" class="form-control" id="username" name = "username" aria-describedby="emailHelp">
               <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
            </div>
            <div class="form-group col-md-6">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name = "password">
            </div>
            <div class="form-group col-md-6">
                <label for="cpassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="cpassword" name = "cpassword">
            </div>
            <button type="submit" class="btn btn-primary">Signup</button>
        </form>
    </div>
  </div>
       

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>