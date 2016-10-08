
<?php
	require_once("support.php");
			require_once "dbLogin.php"; 
	
	if (isset($_POST["Return to main menu"])) {
		$nameValue = trim($_POST["name"]);
		$passwordValue = trim($_POST["password"]);
		$email = trim($_POST["email"]);
		$gpa = trim($_POST["gpa"]);
		$year = $_POST["year"];
		$gender = $_POST["gender"];
		
		
		


	/* Connecting to the database */		
	$db_connection = new mysqli($host, $user, $password, $database);
	if ($db_connection->connect_error) {
		die($db_connection->connect_error);
	} else {
		echo "Connection to database established<br><br>";
	}
	
	/* Query */
	$query = "insert into friends values($nameValue, $email,$gpa,$year,$gender,$passwordValue)";

	
			
	/* Executing query */
	$result = $db_connection->query($query);
	if (!$result) {
		die("Insertion failed: " . $db_connection->error);
	} else {
		echo "Insertion completed.<br>";
	}
	
	/* Closing connection */
	$db_connection->close();
	header("Location:preview.php");	
		
	
		}else{
			
		   $nameValue = "";
		   $passwordValue = "";
		   $email = "";
		   $gpa = "";
		   $year = "";
		   $gender = "";
		
		   
	
		}
		
	
	
	
	if (isset($_POST["Submit Data"])) {
		$nameValue = trim($_POST["name"]);
		$passwordValue = trim($_POST["password"]);
		
	

	/* Connecting to the database */		
	$db_connection = new mysqli($host, $user, $password, $database);
	if ($db_connection->connect_error) {
		die($db_connection->connect_error);
	} else {
		echo "Connection to database established<br><br>";
	}
	
	/* Query */
	$query = "insert into friends values($nameValue, $email,$gpa,$year,$gender,$passwordValue)";
			
	/* Executing query */
	$result = $db_connection->query($query);
	if (!$result) {
		die("Insertion failed: " . $db_connection->error);
	} else {
		echo "Insertion completed.<br>";
	}
	
	/* Closing connection */
	$db_connection->close();
	header("Location:main.php");
		
			
		}else{
			
		  	
		   $nameValue = "";
		   $passwordValue = "";
		   $email = "";
		   $gpa = "";
		   $year = "";
		   $gender = "";
	
		}
	

        $scriptName = $_SERVER["PHP_SELF"];
		$body = <<<EOBODY
		  
			<form action="$scriptName" method="post">
		
			<p><strong>Name:</strong><input type="text" name="name" /><br /><br />
				<strong>Email:</strong><input type="email" name="email" /> <br /><br />
				<strong>GPA:</strong><input type="text" name="gpa" /> <br /><br />
				
			</p>
                     	
			<!-- Shipping Radio Buttons -->
			<p>
				<strong>Year:</strong>
				<input type="radio" name="year" value="UPSS" />&nbsp; 10
				<input type="radio" name="year" value="FedEXC" />&nbsp; 11
				<input type="radio" name="year" value="USMAIL" />&nbsp; 12
				<input type="radio" name="year" value="Other" />
			</p>
			
			<p>
				<strong>Gender:</strong>
				<input type="radio" name="gender value="M" />&nbsp; M
				<input type="radio" name="gender" value="F" />&nbsp; F
				
			</p>
			
			
			 <p><strong>Password: </strong><input type="password" name="name" /><br /><br />
				<strong>Verify Password: </strong><input type="password" name="email" /> <br /><br />
				
				
			</p>
			
          
		<input type="submit" value = "Submit Data" /><br/>
		</form>
		<form action="$scriptName" method="post">
		<input type="submit"  value = "Return to main menu"/>
		</p>;
		</form>
	
			
EOBODY;
		
$scriptName = $_SERVER["PHP_SELF"];

		


	$page = generatePage($body);
	echo $page;
?>