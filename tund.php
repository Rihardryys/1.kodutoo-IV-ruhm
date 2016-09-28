<?php 
	require("config.php");
	echo $serverPassword;
	//var_dump($_GET);
	
	//echo "<br>";
	
	//var_dump($_POST);
	
	//MUUTUJAD
	$signupEmailError = "";
	$signupEmail = "";
	
	//kas email on olemas
	
	if (isset ($_POST["signupEmail"])) {
		
		//on olemas
		// kas emaili väli on tühi
		if (empty ($_POST["signupEmail"])) {
			
			// kui on tühi
			$signupEmailError = " Väli on kohustuslik!";
			
		} else {
			// email on olemas ja õige
			$signupEmail = $_POST["signupEmail"];
			
		}
		
	} 
	
	$signupPasswordError = "";
	
	if (isset ($_POST["signupPassword"])) {
		
		if (empty ($_POST["signupPassword"])) {
			
			$signupPasswordError = "Väli on kohustuslik!";
			
		} else {
			
			// parool ei olnud tühi
			
			if ( strlen($_POST["signupPassword"]) < 8 ) {
			
				$signupPasswordError = "Parool peab olema vähemalt 8 tähemärkki pikk!";
				
			}
			
		}
		
	}
	
	if ( $signupEmailError == "" AND
		$signupPasswordError == "" &&
		isset ($_POST["signupEmail"]) &&
		isset($_POST["signupPassword"])
	//viga ei olnud, kõik väljad on täidetud (&&)
	
	){
		echo "salvestan...<br>";
		echo "email ".$signupEmail."<br>";
		echo "parool".$_POST["signupPassword"]."<br>";
		
		$password = hash("sha512",$_POST["signupPassword"]);
		
		echo $password."<br>";
		//loon ühenduse andembaasi
		$database = "php1"; 		// Vaata üle databaasi nimi, täida ära, tee tabelid tund 3 järgi "" vahele.
		
		$mysqli = new mysqli($serverHost, $serverPassword, $serverUsername, $database);
		$stmt = $mysqli->prepare("INSERT INTO user_sample (email, password) VALUES (?, ?)");
		echo $mysqli->error; //  kas töötab or nah ei tea
		//asendan küsimärgid
		//iga märgi kohta tuleb lisada üks täht - mis muutuja on
		// s-string
		// i- int
		// d - double
		$stmt->bind_param("ss", $signupEmail, $password);
		if($stmt->execute() ) {
			echo "õnnestus";
		}else{"ERROR".$stmt->error;
			
			
		}
	
	
	
	
	
	
	}
	//vaikimisi väärtus, radio buttonid
	$gender = "";
	
	if (isset ($_POST["gender"])) {
		if (empty ($_POST["gender"])) {
			$genderError = "* Väli on kohustuslik!";
		} else {
			$gender = $_POST["gender"];
		}
		
	} 


?>


<!DOCTYPE html>

<html>
	<head>
		<title>Sisselogimine</title>
	</head>

	<body>

		<h1>Logi sisse</h1>
		
		<form method="POST" >
			
			<label>E-post</label><br>
			<input name="loginEmail" type="email">
			
			<br><br>

			<input name="loginPassword" placeholder="Parool" type="password">
			
			<br><br>
			
			<input type="submit" value="Logi sisse">	
		
		
		<h1>Loo kasutaja</h1
			
			<label>E-post</label><br>
			<input name="signupEmail" type="email" value="<?=$signupEmail;?>"> <?php echo $signupEmailError; ?>
			
			<br><br>

			<input name="signupPassword" placeholder="Parool" type="password"> <?php echo $signupPasswordError; ?>
			
			<br><br>
					
			<?php if ($gender == "female") { ?>
				<input type="radio" name="gender" value="female" checked> female<br>
			<?php } else { ?>
				<input type="radio" name="gender" value="female" > female<br>
			<?php } ?>
			
			<?php if ($gender == "male") { ?>
				<input type="radio" name="gender" value="male" checked> male<br>
			<?php } else { ?>
				<input type="radio" name="gender" value="male" > male<br>
			<?php } ?>
			
			<input type="submit" value="Loo kasutaja">
		
		</form>

	</body>

</html>