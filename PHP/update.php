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

if($_GET["id"]) {
    $id = $_GET["id"];

    $sql = "SELECT * FROM `animals` WHERE `ID` = $id";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_assoc();

    $conn->close();

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
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

<div class="container-fluid bgbox1">
    <div class="row justify-content-center">
        <div class="col-8 m">
        <h1>Edited Book</h1>
            <form action="a_update.php" method="post">
                <input type="hidden" name="id" value="<?php echo $row['ID'] ?>">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Image</label>
                    <input type="text" class="form-control" name="img" value="<?php echo $row['IMG'] ?>">
                </div>
                <div>
                    <label for="exampleFormControlInput1">Name</label>
                    <input type="text" class="form-control" name="name" value="<?php echo $row['NAME'] ?>">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Description</label>
                    <input type="text" class="form-control" name="description" value="<?php echo $row['DESCRIPTION'] ?>">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Hobbies</label>
                    <input type="text" class="form-control" name="hobbies" value="<?php echo $row['HOBBIES'] ?>">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Age</label>
                    <input type="text" class="form-control" name="age" value="<?php echo $row['AGE'] ?>">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">City</label>
                    <input type="text" class="form-control" name="city" value="<?php echo $row['CITY'] ?>">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">ZIP</label>
                    <input type="text" class="form-control" name="zip" value="<?php echo $row['ZIP'] ?>">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Address</label>
                    <input type="text" class="form-control" name="address" value="<?php echo $row['ADDRESS'] ?>">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Type</label>
                    <select class="form-control" name="size">
                    <option><?php echo $row['SIZE'] ?></option>
                    <option>small</option>
                    <option>large</option>
                    <option>senior</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-warning btn-lg btn-block">Change</button>
            </form>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
 
</body>
</html>

<?php ob_end_flush(); ?>