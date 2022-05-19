<html>
<title> history </title>
<link rel="stylesheet" href="css/bootstrap.css" type="text/css">
<link rel="stylesheet" href="css/header.css" type="text/css">
<body>
<div class="header">
    <h1>History</h1>
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
            <a class="nav-link" href="logout.php">LogOut</a>
        </li>
    </ul>
    <!-- Navbar text-->
    <span class="navbar-text">
     <form class="form-inline" action="/action_page.php">
    <input class="form-control mr-sm-2" type="text" placeholder="Search">
    <button class="btn btn-success" type="submit" onclick="">Search Name</button>
  </form>
  </span>

</nav>
<br>
<div class="container">
    <table class="table table-striped">
    <thead>
    <tr>
        <th>Date Out</th>
        <th>Date In</th>
        <th>Name</th>
        <th>Quantity Out</th>
        <th>Quantity In</th>
        <th> Remark</th>
    </tr>
    </thead>
        <tbody>
        <?php
        session_start();
				 if($_SESSION["username"] == null)
		 {
			 header("location: login.php");
		 }
        $dburl = "localhost";
        $dbusername = "root";
        $dbpassword = "admin";
        $dbname = "tam_management";
		$date = date_default_timezone_set('Asia/Kolkata');
		$dateout=date("Y-m-d");

        $conn = mysqli_connect($dburl, $dbusername, $dbpassword, $dbname);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
		$sql_total="select sum(tam_out) as total from tam_collection where user_id=".$_SESSION["userid"]." and date_out='".$dateout."'";
		$result1= $conn->query($sql_total);
		if ($result1->num_rows>0) {
            while ($row1 = $result1->fetch_assoc()) {			
		echo "<div class=p1><h3>Today's total : ".$row1["total"]."</h3></div>";
		//echo "<br>Today's total money spent ".$row1["totalprice"];
		
			}
		}
		else{
			echo "No total found";
		}

    	$sql_total1="select sum(tam_out) as total, sum(tam_price) as ptotal from tam_collection where user_id=".$_SESSION["userid"];
		$result2= $conn->query($sql_total1);
		if ($result2->num_rows>0) {
            while ($row2 = $result2->fetch_assoc()) {			
		echo "<br><div class=p1><h3>overall total : ".$row2["total"]."</h3></div>";
		echo "<br><div class=p1><h3>total money spend : ".$row2["ptotal"]."</h3></div>";
			}
		}
			else{
				echo "no total found";
			}
				
        $sql_select_collection = "Select date_out,date_in,worker_name,remark,tam_out,tam_in from tam_management.tam_collection tamcol join tam_management.tam_workers tamwrk where tamcol.worker_id=tamwrk.worker_id and user_id=".$_SESSION["userid"];
	//	echo $sql_select_collection;
        $result = $conn->query($sql_select_collection);
        if ($result->num_rows>0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["date_out"]."</td>";
                echo "<td>".$row["date_in"]."</td>";
                echo "<td>".$row["worker_name"]."</td>";
                echo "<td>".$row["tam_out"]."</td>";
                echo "<td>".$row["tam_in"]."</td>";
                echo "<td>".$row["remark"]."</td>";
                echo "</tr>";
            }
        } else {
            echo "<br>No record found";
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>