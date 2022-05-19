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
<div class="header">
    <title>
        Collect Tamarind
    </title>
    <h1> Tamarind Collection </h1>
</div>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <!-- Links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="provide_tam.php">Provide Tamrind</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="setrate.php">Set Rate</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="welcome.php">Home</a>
        </li>
		<li class="nav-item">
            <a class="nav-link" href="history.php">History</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="logout.php">LogOut</a>
        </li>
    </ul>
</nav>
<br><br>
<body>
<?php
//echo "<br>printing content without submit";
if(isset($_GET['tam_id'])){
$tamid = $_GET['tam_id'];

$dburl = "localhost";
$dbusername = "root";
$dbpassword = "admin";
$dbname = "tam_management";

$conn = mysqli_connect($dburl, $dbusername, $dbpassword, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql_select_collection ="Select tam_id,date_out,worker_name,tam_out from tam_management.tam_collection tamcol join tam_management.tam_workers tamwrk where tamcol.worker_id=tamwrk.worker_id and tam_id=".$tamid;
//echo "<br>".$sql_select_collection;
$result = $conn->query($sql_select_collection);
if ($result->num_rows>0) {
    while ($row=$result->fetch_assoc()) {
        $dateout = $row["date_out"];
        $workername = $row["worker_name"];
        $tamout = $row["tam_out"];
    }
} else {
    echo "<br><strong>No record found- </strong>".$sql_select_collection;
}
$sql_select_rate = "select rate from tam_users where user_id= ".$_SESSION['userid'];
echo "<br>" . $sql_select_rate;
$result1 = $conn->query($sql_select_rate);
if ($result1->num_rows > 0) {
    while ($row1 = $result1->fetch_assoc()) {
       // echo "<br>" . $row1["rate"];
        $trate = $row1["rate"];
    }
} else {
    echo "<br><strong>not found</strong>";
}
$price = $tamout * $trate;
?>
<div class="container">
    <form  method="post">
        Name:<br>
        <input type="text" name="name" class="form-control" value="<?php echo $workername; ?>">
        <br>
        Total Quantity(kg):<br>
        <input type="text" name="total_qty" class="form-control" value="<?php echo $tamout; ?>">
        <br>
        Total Amount(Rs):<br>
        <input type="text" name="amount" class="form-control" value="<?php echo $price; ?>">
        <br>
        Remark:<br>
        <input type="text" name="remark" class="form-control">
        <br>
        <br>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        <br>
    </form>
</div>

<?php

/*
<script type="text/javascript">
function myFunction() {
    var x = document.getElementById("qty").value;
    document.getElementById("amt").innerHTML = x;
}
</script>
*/
if (isset($_POST['submit'])) {
 echo "<br>printing content with submit";
    $nm = $_POST["name"];
    $rmk = $_POST["remark"];
    $amt = $_POST["amount"];
    $qty_in = $_POST["total_qty"];
	$date = date_default_timezone_set('Asia/Kolkata');
    $datein = date("Y-m-d");
    $sql_update_collection = "update tam_collection set tam_in=".$qty_in.",date_in='".$datein."',tam_price=".$amt.",remark='".$rmk."',collect='1' where tam_id=".$tamid;
 ..   echo "<br>".$sql_update_collection;
    if (mysqli_query($conn, $sql_update_collection)) {
        echo "<br><strong>record updated successfully</strong>";
        header("Location: history.php");
    } else {
        echo "<br><strong> error updating record </strong> ";
    }
}
}
?>

</body>
</html>