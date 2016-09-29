<?php
	var_dump($GLOBALS);


	//functions.php
	//function sum($x, $y){
	<?php
	//var_dump($GLOBALS);


	//functions.php
	//function sum($x, $y){
	
		//return $x + $y;
	//}
	
	//echo sum(12312312123,123123123123);
	//echo "<br>";
	
	//function hello($e, $p){
		//	return "Tere tulemast "
		//.$e
		//.""
		//.$p
		//."";
	//}
	//echo hello("Rihard"," R");
	//echo "<br>"
	//see session fail peab olema sis seotud koigiga kus tahame sessiooni kasutada
	// nyyd saab kasutada $_Session muutujat
	session_start();
	
	
	
	$database = "php1"; 
	function signup($email, $password){
		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("INSERT INTO user_sample (email, password) VALUES (?, ?)");
		echo $mysqli->error; //  kas töötab or nah ei tea
		//asendan küsimärgid
		//iga märgi kohta tuleb lisada üks täht - mis muutuja on
		// s-string
		// i- int
		// d - double
		$stmt->bind_param("ss", $email, $password);
		if($stmt->execute() ) {
			echo "õnnestus";
		}else{"ERROR".$stmt->error;
			
			
		}
	
	}
	
	function login($email, $password){
		
		$notice = "";
		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("
			SELECT id, email, password, created
			FROM user_sample
			WHERE email = ?
		");
		echo $mysqli->error;
		//asendan nüüd "?"
		$stmt->bind_param("s", $email);
		
		$stmt->bind_result($id, $emailFromDb, $passwordFromDb, $created);
		
		$stmt->execute();
		// ainult SELECT'i cmd puhul see rida!
		if($stmt->fetch ()){
			//oli olemas, rida käes
			$hash = hash("sha512", $password);
			if ($hash == $passwordFromDb){
				echo "Kasutaja $id logis sisse";
				
				$_SESSION["userid"] = $id;
				$_SESSION["userEmail"] = $emailFromDb;
				
				header("Location: data.php");	
				
				
			}else {
				
			$notice = "parool on vale";
			}
				
			
			
			
		} else {
			//ei olnud ühtegi rida
			$notice = "Sellise emailiga $email kasutajad ei ole olemas!";
		}
		
		return $notice;
		
	}
	
	
	
	
	
	
	
	
	

?>
		//return $x + $y;
	//}
	
	//echo sum(12312312123,123123123123);
	//echo "<br>";
	
	//function hello($e, $p){
		//	return "Tere tulemast "
		//.$e
		//.""
		//.$p
		//."";
	//}
	//echo hello("Rihard"," R");
	//echo "<br>"
	$database = "php1"; 
	var_dump ($GLOBALS);
	function signup($email, $password){
		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("INSERT INTO user_sample (email, password) VALUES (?, ?)");
		echo $mysqli->error; //  kas töötab or nah ei tea
		//asendan küsimärgid
		//iga märgi kohta tuleb lisada üks täht - mis muutuja on
		// s-string
		// i- int
		// d - double
		$stmt->bind_param("ss", $email, $password);
		if($stmt->execute() ) {
			echo "õnnestus";
		}else{"ERROR".$stmt->error;
			
			
		}
	
	}
	
	function login($email, $password){
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("
			SELECT id, email, password, created
			FROM user_sample
			WHERE email = ?
		");
		echo $mysqli->error;
		//asendan nüüd "?"
		$stmt->bind_param("s", $email);
		
		$stmt->bind_result($id, $emailFromDb, $passwordFromDb, $created);
		
		$stmt->execute();
		// ainult SELECT'i cmd puhul see rida!
		if($stmt->fetch ()){
			//oli olemas, rida käes
			$hash = hash("sha512", $password);
			if ($hash == $passwordFromDb){
				echo "Kasutaja $id logis sisse";
				
			}else {
				
				echo "parool on vale";
			}
				
			
			
			
		} else {
			//ei olnud ühtegi rida
			echo "Sellise emailiga $email kasutajad ei ole olemas!";
		}
		
	}
	
	
	
	
	
	
	
	

?>