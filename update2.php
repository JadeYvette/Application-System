
<?php
	require_once("support.php");
	require_once ("dbLogin.php");
    require_once ("user.php");
    
	$flagged = 0;
	$found = 0;
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
    $query = sprintf("update applicants set name='%s',email='%s',gpa=%f,year=%d,gender='%s',password='%s' where email='%s'",$nameValue,$email,$gpa,$year,$gender,$passwordE, unserialize($_COOKIE['update'])->getEmail()); 

			
			
	/* Executing query */
	$result = $db_connection->query($query);
	if (!$result) {
		die("Insertion failed: " . $db_connection->error);
	} else {
		
	}
	
	/* Closing connection */
	$db_connection->close();
	
	
	print "<strong>The entry has been updated in the database and the new values are</strong></br>";
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
	
    
    
    
    
    if(isset($_COOKIE['update']) && $flagged == 0){
        $update = unserialize($_COOKIE['update']);
		
        $passwordValue = $update->getPassword() ;
        $nameValue = $update->getName();
        $email = $update->getEmail();
		$oldemail = $update->getEmail();
        $gender = $update->getGender();
        $year = $update->getYear();
        $gpa = $update->getGpa();
        
        
        		 $scriptName = $_SERVER["PHP_SELF"];
		$body = <<<EOBODY
		  
			<form action="$scriptName" method="post">
		
			<p><strong>Name:</strong><input type="text" name="name" value="$nameValue" /><br /><br />
				<strong>Email:</strong><input type="email" name="email" value="$email" /> <br /><br />
				<strong>GPA:</strong><input type="text" name="gpa" value="$gpa" /> <br /><br />
				
			</p>
			
			
EOBODY;



		if($year == 10){
            
          
      $body .=    '<p>
				<strong>Year:</strong>
				<input type="radio" name="year" value="10" checked />&nbsp; 10
				<input type="radio" name="year" value="11" />&nbsp; 11
				<input type="radio" name="year" value="12" />&nbsp; 12
				
			</p>';
            
            
            
            
        }
			
            
  if($year == 11){
            
       $body .=  '<p>
				<strong>Year:</strong>
				<input type="radio" name="year" value="10" />&nbsp; 10
				<input type="radio" name="year" value="11" checked />&nbsp; 11
				<input type="radio" name="year" value="12" />&nbsp; 12
				
			</p>';
            
            
            
            
        }
        
        
        
        
    if($year == 12){
            
      $body .=   '<p>
				<strong>Year:</strong>
				<input type="radio" name="year" value="10" />&nbsp; 10
				<input type="radio" name="year" value="11" check />&nbsp; 11
				<input type="radio" name="year" value="12" />&nbsp; 12
				
			</p>';
            
            
            
            
        }
			
			
            
      if($gender == "M"){
        
        $body.=	'<p>
				<strong>Gender:</strong>
				<input type="radio" name="gender" value="M" checked />&nbsp; M
				<input type="radio" name="gender" value="F" />&nbsp; F
				
			</p>';
			
        
        
        
      }
      
      
      if($gender == "F"){
        
        
        $body.=	'<p>
				<strong>Gender:</strong>
				<input type="radio" name="gender" value="M" />&nbsp; M
				<input type="radio" name="gender" value="F" checked />&nbsp; F
				
			</p>';
			
        
      }
			
		
			
	$body.= sprintf('<p><strong>Password: </strong><input type="password" name="passwordvalue" value="%s" /><br /><br />
				<strong>Verify Password: </strong><input type="password" name="passwordverify" value="%s" /> <br /><br />
				
				
			</p>
			
          
		<input type="submit" value = "Submit Data" name ="submitdata" /><br/>
		</form>
		<form action="%s" method="post">
		<input type="submit"  value = "Return to main menu" name = "return"/>
		</p>
		</form>',$passwordValue,$passwordValue,$scriptName);
	
	

	$page = generatePage($body);
	echo $page;
		
   
        
        
    }
    
   
       
?>