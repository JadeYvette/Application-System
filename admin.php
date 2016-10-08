<?php
	require_once("support.php");
	require_once ("dbLogin.php");
	require_once ("user.php");
	
	
	$LoginSuccessful = false;
 
// Check username and password:
if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])){
 
    $Username = $_SERVER['PHP_AUTH_USER'];
    $Password = $_SERVER['PHP_AUTH_PW'];
 
    if ($Username == 'main' && $Password == 'terps'){
        $LoginSuccessful = true;
    }
}
 
// Login passed successful?
if (!$LoginSuccessful){
 
   
    header('WWW-Authenticate: Basic realm="Secret page"');
    header('HTTP/1.0 401 Unauthorized');
 
    print "Login failed!\n";
	
}
else {
    
}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	if($LoginSuccessful){
	
	if (isset($_POST["return"])) {
		
	   header("Location:main.html");
		
			
		}
		
   if (isset($_POST["submitdata"])){
	 
	
	
    $flagged = 1;
	$gpaSet = false;
		$nameSet = false ;
		$emailSet = false;
		$yearSet = false ;
		$genderSet = false ;
		$applicantsArray = array();
		
		print '<h1>Applicants</h1>';
		print "<table border=\"1\">\n";
		print "<tr>";
		
		
	   
		
		
		
		
		
		
		foreach ($_POST["fields"] as $entry) {
		    
			if($entry == "name"){
				
				$nameSet = true;
				print "<th>Name</th>";
			}
			
			if($entry == "email"){
				$emailSet = true;
				print "<th>Email</th>";
			}
			
			
			if($entry == "gpa"){
				
				$gpaSet = true;
				print "<th>Gpa</th>";
				
			}
			
			
			if($entry == "year"){
				$yearSet = true;
				print "<th>Year</th>";
				
			}
			
			
			if($entry == "gender"){
				$genderSet = true;
				print "<th>Gender</th>";
			}
			
			
			
			
			
		}
		
		print "</tr>";
		
		
	
	$db_connection = new mysqli($host, $user, $password, $database);
	if ($db_connection->connect_error) {
		die($db_connection->connect_error);
	} else {

	}
	
	
	 if(isset($_POST["filter"]) && ($_POST["filter"] != "") ){
		/* Query */
		$query = sprintf('select * from applicants where %s order by %s',$_POST["filter"],$_POST["sort"] );
	  
		}else{
			/* Query */
	      $query = sprintf('select * from applicants order by %s',$_POST["sort"]);	
		}
		
		
	
	
			
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
				
				    $nameValue =  trim($row['name']);
					$email = trim($row['email']);
					$gpa = $row['gpa'];
					$year = $row['year'];
					$gender = $row['gender'];
					$flagged = 1;
					
			$currUser1 = new User($nameValue,$email,$gpa,$year,$gender,"na");
			
			    array_push($applicantsArray,$currUser1);
			
		
			}
		}
	}
	
	/* Freeing memory */
	$result->close();
	
	/* Closing connection */
	$db_connection->close();
		
	
	
	
	foreach ($applicantsArray as $users){
		$tempName = $users->getName();
		$tempEmail = $users->getEmail();
		$tempGpa = $users->getGpa();
		$tempYear = $users->getYear();
		$tempGender = $users->getGender();
		
		print "<tr>";
		
		if($nameSet == true){
		print "	<td>$tempName</td>";
		}
		
		
		if($emailSet == true){
			print "	<td>$tempEmail</td>";
		}
		
		if($gpaSet == true){
			print "	<td>$tempGpa</td>";
		}
		
		if($yearSet == true){
			print "	<td>$tempYear</td>";
		}
		
		if($genderSet == true){
		  print "	<td>$tempGender</td>";
		}
		
		print"</tr>";
		
	}
	
	
	print "</table>";
	$scriptName = $_SERVER["PHP_SELF"];
    print sprintf('<form action="%s"method="post">',$scriptName);
	print '<input type="submit"  value = "Return to main menu" name = "return"/>';
	print '</p>';
	print '</form>';
	
	
   }else{
	
	
	$body ="";
	// superglobals are not accessible in heredoc
	$scriptName = $_SERVER["PHP_SELF"];
	$topPart = <<<EOBODY
	    <h1>Applications</h1>
		<form action="$scriptName" method="post">
        
			<p>			
				<strong>Select fields to display</strong><br />
				<select name="fields[]" multiple="multiple">
					<option value="name">name</option>
					<option value="email">email</option>
					<option value="gpa">gpa</option>
					<option value="year">year</option>
                    <option value="gender">gender</option>
				</select>	
			</p>
			
           
           	<p>
				<strong>Select field to sort applications</strong>
				<select name="sort">
					<option value="name">name</option>
					<option value="gpa">gpa</option>
                    <option value="email">email</option>
                    <option value="year">year</option>
                    <option value="gender">gender</option>
					
				</select>
			</p>
            
            
          <p><strong>Filter Condition</strong><input type="text" name="filter" /></p>
				<input type="submit" name ="submitdata" /><br/>
		</form>
		<form action="$scriptName" method="post">
		<input type="submit"  value = "Return to main menu" name = "return"/>
		</p>
		</form>		
EOBODY;
	$body = $topPart.$body;
	
	$page = generatePage($body);
	echo $page;
     }
	}
?>
	
   
	
	
	
	