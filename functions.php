<?php 

	require("config.php");
	
	// see fail peab olema siis seotud kÃµigiga kus
	// tahame sessiooni kasutada
	// saab kasutada nÃ¼Ã¼d $_SESSION muutujat
	session_start();
	
	$database = "php1";
	// functions.php
	
	function signup($email, $password, $nimi) {
		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("INSERT INTO user_sample (email, password, nimi) VALUE (?, ?, ?)");
		echo $mysqli->error;
		
		$stmt->bind_param("sss", $email, $password, $nimi);
		
		if ( $stmt->execute() ) {
			echo "Ãµnnestus";
		} else {
			echo "ERROR ".$stmt->error;
		}
		
	}
	
	function login($email, $password) {
		
		$notice = "";
		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("
			SELECT id, email, password, created
			FROM user_sample
			WHERE email = ?
		");
		
		echo $mysqli->error;
		
		//asendan kÃ¼simÃ¤rgi
		$stmt->bind_param("s", $email);
		
		//rea kohta tulba vÃ¤Ã¤rtus
		$stmt->bind_result($id, $emailFromDb, $passwordFromDb, $created);
		
		$stmt->execute();
		
		//ainult SELECT'i puhul
		if($stmt->fetch()) {
			// oli olemas, rida kÃ¤es
			//kasutaja sisestas sisselogimiseks
			$hash = hash("sha512", $password);
			
			if ($hash == $passwordFromDb) {
				echo "Kasutaja $id logis sisse";
				
				$_SESSION["userId"] = $id;
				$_SESSION["userEmail"] = $emailFromDb;
				//echo "ERROR";
				
				header("Location: data.php");
				exit();
				
			} else {
				$notice = "parool vale";
			}
			
			
		} else {
			
			//ei olnud Ã¼htegi rida
			$notice = "Sellise emailiga ".$email." kasutajat ei ole olemas";
		}
		
		
		$stmt->close();
		$mysqli->close();
		
		return $notice;
		
		
		
		
		
	}
	
	
	
	function saveEvent($age, $color) {
		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("INSERT INTO whistle (age, color) VALUE (?, ?)");
		echo $mysqli->error;
		
		$stmt->bind_param("is", $age, $color);
		
		if ( $stmt->execute() ) {
			echo "Õnnestus";
		} else {
			echo "ERROR ".$stmt->error;
		}
		header("location: data.php");
		exit;
	}
	
	function getAllPeople(){
		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	
		$stmt = $mysqli->prepare("
			SELECT id, age, color FROM whistle;
		");
		$stmt->bind_result($id, $age, $color);
		$stmt->execute();

		$result = array();


		// t2ida k2sku cmd
		//tsykli sisu toimub nii mitu korda, mitu rida sql lausega tuleb
		while ($stmt->fetch()){
			
			$human = new StdClass();
			$human->id = $id;
			$human->age = $age;
			$human->lightcolor = $color;
			
			
			//echo $color."<br>";
			array_push($result, $human);
			
		
		}
		return $result;	
	}
	
	
	
	
	
	function cleanInput($input){
		
		$input = trim($input);
		
		//v]tab v'lja /
		$input = stripslashes($input);
		// html asendab nt "<" "&lt"
		$input = htmlspecialchars($input);
		
		return $input;
		
	}
	
	
	/*function sum($x, $y) {
		
		return $x + $y;
		
	}
	
	echo sum(12312312,12312355553);
	echo "<br>";
	
	
	function hello($firstname, $lastname) {
		return 
		"Tere tulemast "
		.$firstname
		." "
		.$lastname
		."!";
	}
	
	echo hello("romil", "robtsenkov");
	*/

?>
