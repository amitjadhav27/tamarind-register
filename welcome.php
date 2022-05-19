<html>
<title> Welcome </title>
<link rel="stylesheet" href="css/bootstrap.css" type="text/css">
<link rel="stylesheet" href="css/header.css" type="text/css">
<body>
<div class="header">
    <h1>
        <?php
		session_start();
		 if($_SESSION["username"] == null)
		 {
			 header("location: login.php");
		 }
       echo "<br>Welcome  ".$_SESSION["name"];
        ?>
    </h1>
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
            <a class="nav-link" href="history.php">History</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="logout.php">LogOut</a>
        </li>
    </ul>
    <!-- Navbar text-->
    <span class="navbar-text">
     <form class="form-inline" action="/action_page.php">
    <input class="form-control mr-sm-2" name="search" type="text" placeholder="Search">
    <button class="btn btn-success" type="submit">Search Name</button>
  </form>
  </span>

</nav>
<br>
<div class="container">
    <h2>Collection out</h2>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Date</th>
            <th>Name</th>
            <th>Quantity(kg)</th>
			</tr>
        </thead>
        <tbody>
        <?php
	//	 session_start();
        $dburl = "localhost";
        $dbusername = "root";
        $dbpassword = "admin";
        $dbname = "tam_management";
        $conn = mysqli_connect($dburl, $dbusername, $dbpassword, $dbname);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }if (isset($_POST['search'])) {
			$searchq = $_POST['search'];
			$searchq = preg_replace("#[^0-9a-z]#i","",$searchq);
			$query = mysql_query("Select tam_id,date_out,worker_name,tam_out,tam_in,collect from tam_management.tam_collection tamcol join tam_management.tam_workers tamwrk where tamcol.worker_id=tamwrk.worker_id and user_id='".$_SESSION["userid"]."' and collect='0'") or die("could not search");
			$count = mysql_num_rows($query);
			if($count == 0){
				echo "No record found";
			}
			else{
				while($row = mysql_fetch_array($query)){
					$dateout = $row['date_out'];
					$wname = $row['worker_name'];
					$qty = $row['tam_in'];
				}
			}
	}
		
        $sql_select_collection = "Select tam_id,date_out,worker_name,tam_out,tam_in,collect from tam_management.tam_collection tamcol join tam_management.tam_workers tamwrk where tamcol.worker_id=tamwrk.worker_id and user_id='".$_SESSION["userid"]."' and collect='0'";
		//echo"<br>".$sql_select_collection;
        $result = $conn->query($sql_select_collection);
        if ($result->num_rows>0) {
            while ($row = $result->fetch_assoc()) {
			//	$_SESSION['tam_id']=$row["tam_id"];
                echo "<tr>";
                echo "<td>".$row["date_out"]."</td>";
                echo "<td>".$row["worker_name"]."</td>";
                echo "<td>".$row["tam_out"]."</td>";
				//echo "<td>".$row["collect"]."</td>";
                echo "<td><a href='collect_tam.php?tam_id=".$row['tam_id']."'>Collect</a></td>";
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