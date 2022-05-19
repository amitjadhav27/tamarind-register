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
<meta name="viewport" content="width=device-width, initial-scale=1">
<div class="header">
<title>
Provide Tamarind
</title>
<h1>Provide Tamarind  </h1>
</div>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
   
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="setrate.php">Set Rate</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="welcome.php">Home</a>
        </li>
		
       <li class="nav-item">
            <a class="nav-link" href="logout.php"> LogOut</a>
        </li> 
    </ul>
</nav>
<!--
<div class="topnav">
  <a class="active" href="setrate.php">set Rate</a>
  <a href="welcome.php">Home</a>
  <div class="topnav-right">
    <a href="#about">About</a>
	    <a href="logout.php">Logout</a>
  </div>
</div>
-->
<br><br>
<body>
<div class="container" >
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method= "post">
  Name:<br>
  <input type="text" name="name" class="form-control">
  <br>
  Address:<br>
  <input type="text" name="address" class="form-control">
  <br>
  Phone:<br>
  <input type="text" name="phone" class="form-control">
  <br>
  Quantity(kg):<br>
  <input type="text" name="quantity" class="form-control">
  <br>
  <br>
<button name="submit_button" type="submit" class="btn btn-primary">Submit</button>
 <br>
 </form> 
</div>
<?php
 $errorMessages= array();
if (isset($_POST['submit_button'])) {
		if (empty($_POST['name'])) {
            $errorMessages['name'] = 'name field is empty, please enter name';
	echo "<br><strong> ".$errorMessages['name']."</strong>";
			
	}
	elseif (empty($_POST['address'])) {
            $errorMessages['address'] = 'Username field is empty, please enter address';
	echo "<br> <strong>".$errorMessages['address']."</strong>";
	}
    elseif (empty($_POST['phone'])) {
            $errorMessages['phone'] = 'The phone field is empty, please enter.';
	echo "<br><strong>".$errorMessages['phone']."</strong>";
		}
	elseif (empty($_POST['quantity'])) {
            $errorMessages['quantity'] = 'The quantity field is empty, please enter.';
	echo "<br> <strong>".$errorMessages['quantity']."</strong>";
		}
	else {
$nm = trim($_POST["name"]);
$addr = trim($_POST["address"]);
$ph = trim($_POST["phone"]);
$qty = trim($_POST["quantity"]);
$dburl="localhost"; 
$dbusername="root";
$dbpassword="admin";
$dbname="tam_management";

$conn = mysqli_connect($dburl, $dbusername, $dbpassword, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql_select_query= "select * from tam_workers where worker_name='".$nm."' and worker_num='".$ph."'";
$result= $conn->query($sql_select_query);
if($result->num_rows>0){
	 while($row = $result->fetch_assoc()){ 
		 $_SESSION["w_id"]= $row["worker_id"];
	//	 $_SESSION["tam_id"]= $row["tam_id"];

	 }
}
else {
	$sql_insert_worker="Insert into tam_workers(worker_name, worker_address, worker_num) Values ('".$nm."','".$addr."','".$ph."')";
	if(mysqli_query($conn,$sql_insert_worker)){
		$sql_select_worker= "select * from tam_workers where worker_name='".$nm."' and worker_num='".$ph."'";
		$result= $conn->query($sql_select_worker);
		if($result->num_rows>0){
		while($row = $result->fetch_assoc()) {
			$_SESSION["w_id"]= $row["worker_id"];
		//	$_SESSION["tam_id"]= $row["tam_id"];
		}	
		}
		else{
			echo "error searching worker - ".$sql_select_worker;
		}
	}
	else  {
		echo "Error inserting worker<br>".$sql_insert_worker;
	}
}
$date = date_default_timezone_set('Asia/Kolkata');
$dateout=date("Y-m-d");
		$sql_insert_collection="Insert into tam_collection(user_id, worker_id, date_out, tam_out, collect) Values (".$_SESSION["userid"].",".$_SESSION["w_id"].",'".$dateout."',".$qty.", '0')";
		if(mysqli_query($conn,$sql_insert_collection)){
			echo "<br>record inserted successfully";
		}
		else {
			echo"<br> error inserting record  ".$sql_insert_collection;
		}
}
}
?>
</body>
</html>