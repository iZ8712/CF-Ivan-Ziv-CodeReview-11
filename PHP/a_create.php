<?php 
ob_start();
session_start();
require_once 'db_connect.php';

if( !isset($_SESSION['admin']) && !isset($_SESSION['user'])) {
  header("Location: home.php");
  exit;
}

if(isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

$res=mysqli_query($conn, "SELECT * FROM users WHERE ID =".$_SESSION['admin']);
$userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
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
      <a class="nav-link m-2" href="logout.php">Hello <?php echo $userRow['NAME']; ?>!</a>
      </li>   
      <li class="nav-item">
      <a class="nav-link m-2" href="create.php">Add new Pet</a>
      </li>
      <li class="nav-item">
      <a class="nav-link m-2" href="logout.php?logout">Sign Out</a>
      </li>     
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>

<div class="container-fluid bgbox2">
    <div class="acbox">

        <?php
            if($_POST) {
                $img = $_POST["img"];
                $name = $_POST["name"];
                $description = $_POST["description"];
                $hobbies = $_POST["hobbies"];
                $age = $_POST["age"];
                $city = $_POST["city"];
                $zip = $_POST["zip"];
                $address = $_POST["address"];
                $size = $_POST["size"];


                $sql = "INSERT INTO `animals`( `IMG`, `NAME`, `DESCRIPTION`, `HOBBIES`, `AGE`, `CITY`, `ZIP`, `ADDRESS`, `SIZE`) 
                VALUES ('$img', '$name', '$description', '$hobbies',  '$age', '$city', '$zip', '$address', '$size')";
                if(mysqli_query($conn, $sql)) {
                    echo "
                    <div class='card bookbg' style='width: 40rem;'>
                        <button class='btn btn-success btn-lg btn-block'>Pet successfully added!</button>
                        <img src='$img'>
                        <div class='card-body'>
                            <h5 class='card-title'>$name</h5>
                            <p class='card-text'>Description: $description</p>
                            <p><small class='card-text'>My Hobbie: $hobbies</small></p>
                            <p><small class='card-text'>Age: $age</small></p>
                            <p><small class='card-text'>Type: $size</small></p>
                            <p><small class='card-text'>Adress: $address</small><br>
                            <small class='card-text'>City: $zip $city</small></p>
                            <a class='btn btn-block btn-info btn-lg' href='admin.php'>Back</a>
                        </div>
                    </div>";
                } else { 
                    echo "
                    <div class='myerror'>
                        <h1>ERROR!</h1>
                        <p class='errorp'>Something went wrong. Please try again.</p>
                        <a class='btn btn-warning btn-lg btn-block' href='create.php'>Back</a>
                    </div>";
                };
            };

            $conn->close();
        ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>
</html>
<?php ob_end_flush(); ?>

