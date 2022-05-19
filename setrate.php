<?php
session_start();
		 if($_SESSION["username"] == null)
		 {
			 header("location: login.php");
		 }
?>
<html>
<link rel="stylesheet" href="css/bootstrap.css" type="text/css">
<link rel="stylesheet" href="css/header.css" type="text/css">
<div class="header"><title>
        Set Rate
    </title>
    <h1> Set Rate </h1>
</div>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <!-- Links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="logout.php">LogOut</a>
        </li>
    </ul>
  </nav>
<br>
<div class="container">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method= "post">
        Rate per kg:<br>
        <input type="text" name="rate" class="form-control">
        <br>
        <button name="submit_button" type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<?php
if (isset($_POST['submit_button'])) {
    $sr = $_POST["rate"];
	//$ui = "userid";
    $dburl = "localhost";
    $dbusername = "root";
    $dbpassword = "admin";
    $dbname = "tam_management";
    $conn = mysqli_connect($dburl, $dbusername, $dbpassword, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql_update_query = "UPDATE tam_users SET rate='".$sr."' WHERE user_id='".$_SESSION["userid"]."'";
	echo "<br>".$sql_update_query;
    if ($conn->query($sql_update_query) === TRUE) {
        echo "Rate updated successfully";
		header("Location: welcome.php");
    } else {
        echo "Error updating rate: " .$conn->error;
    }

    $conn->close();
}
?>
        </body>
</html>