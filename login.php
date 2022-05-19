<html>
<link rel="stylesheet" href="css/bootstrap.css" type="text/css">
<link rel="stylesheet" href="css/header.css" type="text/css">
<div class="header"><title>
        Login page
    </title>
    <h1> Login </h1>
</div>
<body bgcolor="aqua">
<div class="container">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
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
		<br><br>
        <button name="submit" type="submit" class="btn btn-primary">Submit</button>
       <br><br> New User?<a href="register.php">Click here</a>
    </form>
</div>
<?php
session_start();
 $errorMessages = array();
if (isset($_POST['submit'])) {
	
    $un = $_POST["username"];
    $ps = $_POST["password"];
    $dburl = "localhost";
    $dbusername = "root";
    $dbpassword = "admin";
    $dbname = "tam_management";

    $conn = mysqli_connect($dburl, $dbusername, $dbpassword, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql_select_query = "select * from tam_users where username='".$un."' and password='".$ps."'";
   // echo "<br>" . $sql_select_query;
 /*  if (empty($_POST['username'])==true) {
            $errorMessages['username'] = 'Username field is empty, please enter username';
	}
        if (empty($_POST['password'])==true) {
            $errorMessages['password'] = 'The passwords you entered do not match';
		} */
    $result = $conn->query($sql_select_query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $_SESSION["userid"] = $row["user_id"];
			$_SESSION["username"] = $row["username"];
			$_SESSION["name"]= $row["name"];
			$setrate["srate"] = $row["rate"];
            if(is_null($setrate["srate"])){
			//header("Location: welcome.php?name=".$row["name"]);
			header("Location: setrate.php");
			}
			else{
				// header("Location: setrate.php");
				header("Location: welcome.php?name=".$row["name"]);
			}
        }
    } else {
        echo "<br>Wrong username and passsword";
    }
	mysqli_close($conn);
}
?>
</body>
</html>
