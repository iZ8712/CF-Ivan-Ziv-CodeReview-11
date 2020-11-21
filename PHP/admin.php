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

$sql ="SELECT * FROM animals";
$result = mysqli_query($conn, $sql);

$res=mysqli_query($conn, "SELECT * FROM users WHERE ID =".$_SESSION['admin']);
$userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);

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
      <a class="nav-link m-2" href="">Hello <?php echo $userRow['NAME']; ?>!</a>
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

<div class="container-fluid bgbox1">
    <p><h1>Petshop</h1></p>
    <div class="row justify-content-around">
        <?php 
            if($result->num_rows == 0){
                echo "No Pets";
            }else {
                $rows = $result->fetch_all(MYSQLI_ASSOC);
                foreach ($rows as $key => $value) {
                echo "
                    <div class='card col-3 mr-1 ml-1 mt-4 mb-4'>
                        <img src='".$value["IMG"]."'>
                        <div class='card-body'>
                            <h5 class='card-title'>". $value["NAME"]. "</h5>
                            <p class='card-text'>Description: ". $value["DESCRIPTION"]. "</p>
                            <p><small class='card-text'>My Hobbie: ". $value["HOBBIES"]. "</small></p>
                            <p><small class='card-text'>Age: ". $value["AGE"]. "</small><br>
                            <p><small class='card-text'>Age: ". $value["SIZE"]. "</small><br>
                            <p><small class='card-text'>Address: ". $value["ADDRESS"]. "</small><br>
                            <small class='card-text'>City: ". $value["ZIP"]. " ". $value["CITY"]. "</small></p>
                            <a class='btn btn-primary btn-lg' href='update.php?id=".$value["ID"]."'>Change</a>
                            <a class='btn btn-danger btn-lg' href='delete.php?id=".$value["ID"]."'>Delete</a>
                        </div>
                    </div>";
                }
            }
            $conn->close();
        ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    
</body>
</html>
