
<?php
	require_once("support.php");
	require_once ("dbLogin.php"); 
	$flagged = 0;
	$scriptName = $_SERVER["PHP_SELF"];
	
	  
      
  

 
	
	
	
	
	
	
	
	
	if (isset($_POST["submitdata"])) {
		$nameValue = trim($_POST["name"]);
		$passwordValue = trim($_POST["passwordvalue"]);
	    $passwordE = sha1($passwordValue);
		$email = trim($_POST["email"]);
		$gpa = trim($_POST["gpa"]);
		$year = $_POST["year"];
		$gender = $_POST["gender"];
		$flagged = 1;
		
	/* Connecting to the database */		
	$db_connection = new mysqli($host, $user, $password, $database);
	if ($db_connection->connect_error) {
		die($db_connection->connect_error);
	} else {
		
	}
	
	/* Query */
	$query = "insert into applicants values('$nameValue', '$email',$gpa,$year,'$gender','$passwordE')";

	
			
	/* Executing query */
	$result = $db_connection->query($query);
	if (!$result) {
		die("Insertion failed: " . $db_connection->error);
	} else {
		
	}
	
	/* Closing connection */
	$db_connection->close();
	
	 $scriptName = $_SERVER["PHP_SELF"];
	print "<strong>The following entry has been added to the database</strong></br>";
	print "<strong>Name: </strong>$nameValue</br>";
	print "<strong>Email: </strong>$email</br>";
	print "<strong>GPA: </strong>$gpa</br>";
	print "<strong>Year:</strong>$year</br>";
	print "<strong>Gender:</strong>$gender</br>";
	print "</br>";
	
	
	print sprintf('<form action="%s"method="post">',$scriptName);
	print '<input type="submit"  value = "Return to main menu" name = "return"/>';
	print '</p>';
	print '</form>';
			
		
		
		
		
	
		}else{
			
		   $nameValue = "";
		   $passwordValue = "";
		   $email = "";
		   $gpa = "";
		   $year = "";
		   $gender = "";
		  
		  
		   
	
		}
		
	
	
	
	if (isset($_POST["return"])) {
		
	   header('Location:main.html');
		
	
		}
	
	
	
	if($flagged == 0){
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
				<input type="radio" name="year" value="10" />&nbsp; 10
				<input type="radio" name="year" value="11" />&nbsp; 11
				<input type="radio" name="year" value="12" />&nbsp; 12
				
			</p>
			
			<p>
				<strong>Gender:</strong>
				<input type="radio" name="gender" value="M" />&nbsp; M
				<input type="radio" name="gender" value="F" />&nbsp; F
				
			</p>
			
			
			 <p><strong>Password: </strong><input type="password" name="passwordvalue" /><br /><br />
				<strong>Verify Password: </strong><input type="password" name="passwordverify" /> <br /><br />
				
				
			</p>
			
          
		<input type="submit" value = "Submit Data" name ="submitdata" /><br/>
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