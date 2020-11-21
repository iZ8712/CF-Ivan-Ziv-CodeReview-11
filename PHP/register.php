<?php
ob_start();
session_start();
if( isset($_SESSION['user'])!="" ){
    header("Location: index.php" );
}

if( isset($_SESSION['admin'])!="" ){
    header("Location: admin.php" );
}

include_once 'db_connect.php';
$error = false;
if ( isset($_POST['btn-signup']) ) {
 
    $name = trim($_POST['name']);
    $name = strip_tags($name);
    $name = htmlspecialchars($name);
 
    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $pass = trim($_POST['pass']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);

    if (empty($name)) {
        $error = true ;
        $nameError = "Please enter Name.";
    } else if (strlen($name) < 3) {
        $error = true;
        $nameError = "Name must have at least 3 characters.";
    } else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
        $error = true ;
    $nameError = "Name must contain Alphabets and Space.";
    }

    if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
        $error = true;
        $emailError = "Please enter Email." ;
    } else {
        $query = "SELECT EMAIL FROM users WHERE EMAIL='$email'";
        $result = mysqli_query($conn, $query);
        $count = mysqli_num_rows($result);
        if($count!=0){
            $error = true;
            $emailError = "Email already exists.";
        } 
    }

    if (empty($pass)){
        $error = true;
        $passError = "Please enter password.";
    } else if(strlen($pass) < 3) {
        $error = true;
        $passError = "Password must have atleast 3 characters." ;
    }

    $password = hash('sha256' , $pass);

    if( !$error ) {
        $query = "INSERT INTO `users`( `NAME`, `EMAIL`, `PASS`) VALUES('$name','$email','$password')";
        $res = mysqli_query($conn, $query);
 
    if ($res) {
        $errTyp = "success";
        $errMSG = "Successfully registered. You can login now.";
        unset($name);
        unset($email);
        unset($pass);
    } else  {
        $errTyp = "danger";
        $errMSG = "Something went wrong. Try again." ;
    }
}


}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petshop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link btn btn-primary btn-lg m-2" href="home.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
      <a class="nav-link m-2" href="register.php">Registration</a>
      </li>  
      <li class="nav-item">
      <a class="nav-link m-2" href="login.php">Login</a>
      </li>    
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>

<div class="container-fluid bgbox1">
    <div class="row justify-content-center">
    <div class="col-4 m-4">

        <form method="post"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"  autocomplete="off" >

            <h2>Sign up</h2>
         
            <?php
            if ( isset($errMSG) ) {
            ?>
           
            <div class="alert alert-<?php echo $errTyp ?>" >
                <?php echo $errMSG; ?>
            </div>

            <?php
            }
            ?>

                <div class="form-group">
                    <label for="exampleFormControlInput1">Name</label>
                    <input type ="text"  name="name"  class="form-control"  placeholder="Your Name" maxlength="20" value="<?php echo $name ?>"  />
                        <span class="text-danger"> <?php echo $nameError; ?> </span>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Your Email" maxlength="20" value ="<?php echo $email ?>"  />
                    <span  class="text-danger"> <?php echo $emailError; ?> </span>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Password</label>
                    <input type="password" name="pass" class="form-control" placeholder="Your Password" maxlength="20"  />
                    <span class="text-danger"> <?php echo $passError; ?> </span>
                </div>
                <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Sign Up</button>
                <hr>
                <a class="btn btn-block btn-success" href="login.php">Login</a>
        </form>
    </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
 
</body>
</html>
<?php ob_end_flush(); ?> 