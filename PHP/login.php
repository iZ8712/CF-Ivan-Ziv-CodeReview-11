<?php
ob_start();
session_start();
require_once 'db_connect.php';

if ( isset($_SESSION['user' ])!="" ) {
 header("Location: index.php");
 exit;
}

if( isset($_SESSION['admin'])!="" ){
    header("Location: admin.php" );
}

$error = false;

if( isset($_POST['btn-login']) ) {

    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $pass = trim($_POST['pass']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);

    if(empty($email)){
        $error = true;
        $emailError = "Please enter your Email.";
    } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
        $error = true;
        $emailError = "Please enter a valid Email.";
    }

    if (empty($pass)){
        $error = true;
        $passError = "Please enter your Password." ;
    }

    if (!$error) {
        $password = hash( 'sha256', $pass); 

        $res=mysqli_query($conn, "SELECT `ID`, `NAME`, `EMAIL`, `PASS`, `STATUS` FROM users WHERE EMAIL='$email'" );
        $row=mysqli_fetch_array($res, MYSQLI_ASSOC);
        $count = mysqli_num_rows($res);

        if( $count == 1 && $row['PASS']==$password ) {
            if($row['STATUS'] == 'admin'){
                $_SESSION['admin'] = $row['ID'];
                header("Location: admin.php");
            }else {
                $_SESSION['user'] = $row['ID'];
                header("Location: index.php");
            }
        } else {
            $errTyp = "danger";
            $errMSG = "Incorrect Credentials";
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
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete= "off">
            <h2>Login</h2>
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
                <label for="exampleFormControlInput1">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Your Email" value="<?php echo $email; ?>"  maxlength="20" />
                <span class="text-danger"><?php  echo $emailError; ?></span>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Password</label>
                <input type="password" name="pass"  class="form-control" placeholder="Your Password" maxlength="15"  />
                <span class="text-danger"><?php  echo $passError; ?></span>
            </div>
            <button class="btn btn-block btn-success" type="submit" name="btn-login">Login</button>
            <hr>
            <a class="btn btn-block btn-primary" href="register.php">Sign up</a>
     
         
   </form>
   </div>
</div>
</body>
</html>
<?php ob_end_flush(); ?> 