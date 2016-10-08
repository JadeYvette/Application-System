<?php
	class User{
	
		private $name;
		private $email;
		private $gpa;
		private $year;
		private $gender;
		private $password;
	
		public function __construct($nameIn, $emailIn,$gpaIn,$year,$genderIn,$passwordIn) {
			
			$this->name= $nameIn;		// Notice this->name (no $ for name)
			$this->email = $emailIn;
			$this->gpa = $gpaIn;
			$this->year = $year;
			$this->gender = $genderIn;
			$this->password = $passwordIn;
			
		
		

		}
	
		public function __toString() {
			return "<b>Name:</b> ".$this->name."</br>".
					"<b>Email:</b> ".$this->email."</br>
					<b>Gpa:</b> ".$this->gpa."</br>
					<b>Year:</b> ".$this->year."</br>
					<b>Gender:</b> ".$this->gender 
					;
					
										

		}

		public function getName() {
			return $this->name;
		}
	
		public function getEmail() {
			return $this->email;
		}
		
		public function getStudents() {
			return $this->students;
		}
		
			public function getGpa() {
			return $this-> gpa;
		}
		
			public function getYear() {
			return $this->year;
		}
			public function getGender() {
			return $this->gender;
		}
		
			public function getPassword() {
			return $this->password;
		}
		
	
		public function __destruct() {
			
		}
		
		public function getInfo() {
			echo "Class Information: ", get_class($this);
		}
	}


?>