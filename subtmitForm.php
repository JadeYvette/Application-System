
 
 <link href="mainstyle3.css" rel="stylesheet" type="text/css">
<?php
	require_once("support.php");

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
			
          
		<input type=\"submit\" value = \"Submit Data\" /><br/>
		</form>
		<form action="$scriptName" method="post">
		<input type=\"submit\"  value = \"Return to main menu \"/>
		</p>;
		</form>
	
			
EOBODY;
		
$scriptName = $_SERVER["PHP_SELF"];

		


	$page = generatePage($body);
	echo $page;
?>