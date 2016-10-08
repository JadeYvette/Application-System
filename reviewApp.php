
<?php
	require_once("support.php");
	require_once ("dbLogin.php"); 
	$flagged = 0;
	$found = 0;
	$scriptName = $_SERVER["PHP_SELF"];
	
	if (isset($_POST["submitdata"])) {
		$email = trim($_POST["email"]);
		$passwordValue = trim($_POST["passwordvalue"]);
	
		
		
		
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
				 				
				 if( $row['email']  == $email && $row['password'] === sha1($passwordValue)){
					$found = 1;
					$nameValue =  trim($row['name']);
					$email = trim($row['email']);
					$gpa = $row['gpa'];
					$year = $row['year'];
					$gender = $row['gender'];
					$flagged = 1;
					
					
				 }
				
				
				
				
				
			}
		}
	}
	
	/* Freeing memory */
	$result->close();
	
	/* Closing connection */
	$db_connection->close();
	if($found == 1){	
	print "<strong>The following entry has been added to the database</strong></br>";
	print "<strong>Name: </strong>$nameValue</br>";
	print "<strong>Email: </strong>$email</br>";
	print "<strong>GPA: </strong>$gpa</br>";
	print "<strong>Year:</strong>$year</br>";
	print "<strong>Gender:</strong>$gender</br>";
	print "</br>";
	
	$scriptName = $_SERVER["PHP_SELF"];
    print sprintf('<form action="%s"method="post">',$scriptName);
	print '<input type="submit"  value = "Return to main menu" name = "return"/>';
	print '</p>';
	print '</form>';
	}else{
		
		print "<p>No entry exists in the database for the specified email and password</p>";
	}
		
	
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