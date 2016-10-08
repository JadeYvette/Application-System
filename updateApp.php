<?php
	require_once("support.php");
	require_once ("dbLogin.php");
	require_once ("user.php");
	 
	$flagged = 0;
	$found = 0;
	$scriptName = $_SERVER["PHP_SELF"];
	
	if (isset($_POST["submitdata"])) {
		$email = trim($_POST["email"]);
		$passwordValue = trim($_POST["passwordvalue"]);
	
			$flagged = 1;
		
		
	$db_connection = new mysqli($host, $user, $password, $database);
	if ($db_connection->connect_error) {
		die($db_connection->connect_error);
	} else {

	}
	
	/* Query */
	$query = "select * from applicants";
			
	/* Executing query */
	$result = $db_connection->query($query);
	if (!$result) {
		die("Retrieval failed: ". $db_connection->error);
	} else {
		/* Number of rows found */
		$num_rows = $result->num_rows;
		if ($num_rows === 0) {
			echo "Empty Table<br>";
		} else {
			for ($row_index = 0; $row_index < $num_rows; $row_index++) {
				$result->data_seek($row_index);
				$row = $result->fetch_array(MYSQLI_ASSOC);
				
				 if( $row['email']  == $email && $row['password']  === sha1($passwordValue)){
					
					$nameValue =  trim($row['name']);
					$email = trim($row['email']);
					$gpa = $row['gpa'];
					$year = $row['year'];
					$gender = $row['gender'];
				
					$found = 1;
					
					$currUser = new User($nameValue,$email,$gpa,$year,$gender,$passwordValue);
					$expiration = time() + 3600; /* one hour from now */
					$path = "/"; /* a cookie should be sent for any page within the server environment */
					$domain = "";  /* adjust with appropriate domain name */
					$sentOnlyOverSecureConnection = 0; /* 1 for secure connection */
					setcookie("update", serialize($currUser), $expiration, $path, $domain, $sentOnlyOverSecureConnection);
					
					header("Location:update2.php");
					
				 }
				
				
				
				
				
			}
		}
	}
	
	/* Freeing memory */
	$result->close();
	
	/* Closing connection */
	$db_connection->close();
		
	
	
	$scriptName = $_SERVER["PHP_SELF"];
	print "<p>No entry exists in the database for the specified email and password</p>";
	$flagged = 0 ;	
		
	
		}else{
			
		   $nameValue = "";
		   $passwordValue = "";
		   $email = "";
		   $gpa = "";
		   $year = "";
		   $gender = "";
		  
		  
		   
	
		}
		
	
	
	
	if (isset($_POST["return"])) {
		
	   header("Location:main.html");
		
			
		}
	

	if($flagged == 0){
		 $scriptName = $_SERVER["PHP_SELF"];
		$body = <<<EOBODY
		  
			<form action="$scriptName" method="post">
		
			<p><strong>Email:</strong><input type="text" name="email" /><br/>
		    <p><strong>Password: </strong><input type="password" name="passwordvalue" /><br/>
				
				
				
			</p>
			
          
		<input type="submit" name ="submitdata" /><br/>
		</form>
		<form action="$scriptName" method="post">
		<input type="submit"  value = "Return to main menu" name = "return"/>
		</p>
		</form>
	
			
EOBODY;
		

	$page = generatePage($body);
	echo $page;
		
		
		
		
	}
	
	

       
?>