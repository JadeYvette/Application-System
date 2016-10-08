<?php
	require_once("support.php");

	
	
	// superglobals are not accessible in heredoc
	$scriptName = $_SERVER["PHP_SELF"];
	$topPart = <<<EOBODY
	    <h1>Applications</h1>
		<form action="$scriptName" method="post">
        <p>Select fields to Display</p>
			<p>			
				<strong>Select which development environments you have used.</strong><br />
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
                    <option value="gender">gender/option>
					
				</select>
			</p>
            
            
            <p><strong>Filter Condition</strong><input type="text" name="filter" /></p>
		
		</form>		
EOBODY;
	$body = $topPart.$body;
	
	$page = generatePage($body);
	echo $page;
?>