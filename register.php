<?php	
	session_start();
	?>
<html>
<link rel="stylesheet" href="css/bootstrap.css" type="text/css">
<link rel="stylesheet" href="css/header.css" type="text/css">
<title>
Register page
</title>
<div class="header">
<h1> Register </h1>
</div>
<body>
<div class="container" >
 <form>
 <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
Name:<br>
        <input type="text" name="name" class="form-control is-valid" autocomplete="off">
        <br>
Username:<br>
        <input type="text" name="username" class="form-control is-valid" autocomplete="off">
        <br>
Password:<br>
  <input type="password" name="password" class="form-control is-valid" id="myInput" autocomplete="off">
  <br>
  <input type="checkbox" onclick="myFunction()">Show Password
  
<script>
function myFunction() {
    var x = document.getElementById("myInput");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
</script>
<br>
  <br>
<button name="submit" type="submit" class="btn btn-primary">Submit</button>
 <br><br>
 <a href= "login.php"> Click here</a> If already registered.
</form> 
</div>
<?php
 $errorMessages = array();
if (isset($_POST['submit'])){
	if (empty($_POST['name'])) {
            $errorMessages['name'] = 'name field is empty, please enter name';
	echo "<br> ".$errorMessages['name'];
			
	}
	elseif (empty($_POST['username'])) {
            $errorMessages['username'] = 'Username field is empty, please enter username';
	echo "<br> error messages".$errorMessages['username'];
	}
    elseif (empty($_POST['password'] || $_POST['password'] != $_POST['confirm_password'])) {
            $errorMessages['password'] = 'The passwords you entered do not match';
	echo "<br> error messages".$errorMessages;
		}
	else {
	echo "<br> error messages".$errorMessages;
	$nm = trim($_POST["name"]);
	$un = trim($_POST["username"]);
	$ps = trim($_POST["password"]);
	$dburl="localhost"; 
	$dbusername="root";
	$dbpassword="admin";
	$dbname="tam_management";

	$conn = mysqli_connect($dburl, $dbusername, $dbpassword, $dbname);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
		}

$sql_select_query= "select * from tam_users where username='".$un."' and password='".$ps."'";
//$result= $conn->query($sql_select_query);
$result= mysqli_query($conn,$sql_select_query);
if($result->num_rows>0){
	while ($row = $result->fetch_assoc()) {
            $_SESSION["userid"] = $row["user_id"];
			$_SESSION["name"] = $row["name"];
			$_SESSION["username"] = $row["username"];
	}
{
	echo "<br>User already exists. Please login";
}
}
else{
$sql_insert_query="Insert into tam_users(name, username, password) Values ('".$nm."','".$un."','".$ps."')";
if(mysqli_query($conn,$sql_insert_query))
$sql_select1_query= "select * from tam_users where username='".$un."' and password='".$ps."'";	
$result1= mysqli_query($conn,$sql_select1_query);
if($result1->num_rows>0){
	while ($row = $result1->fetch_assoc()) {
            $_SESSION["userid"] = $row["user_id"];
			$_SESSION["name"] = $row["name"];
			$_SESSION["username"] = $row["username"];
	}	
{
	echo "User registered successfully";
	header("Location: setrate.php");
}
}
else  {
	echo "Error registering user";
}
}
mysqli_close($conn);
	}
}
?>
</body>
</html>
