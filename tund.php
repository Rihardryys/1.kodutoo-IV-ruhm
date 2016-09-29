<?php 
	require("config.php");
	require("functions.php");
	//var_dump($_GET);
	
	//echo "<br>";
	if (isset($_SESSION["userEmail"])) {
		header("Location: data.php");
	}
	//var_dump($_POST);
	
	//MUUTUJAD
	$signupEmailError = "";
	$signupEmail = "";
	
	//kas email on olemas
	
	if (isset ($_POST["signupEmail"])) {
		
		//on olemas
		// kas emaili v�li on t�hi
		if (empty ($_POST["signupEmail"])) {
			
			// kui on t�hi
			$signupEmailError = " V�li on kohustuslik!";
			
		} else {
			// email on olemas ja �ige
			$signupEmail = $_POST["signupEmail"];
			
		}
		
	} 
	
	$signupPasswordError = "";
	
	if (isset ($_POST["signupPassword"])) {
		
		if (empty ($_POST["signupPassword"])) {
			
			$signupPasswordError = "V�li on kohustuslik!";
			
		} else {
			
			// parool ei olnud t�hi
			
			if ( strlen($_POST["signupPassword"]) < 8 ) {
			
				$signupPasswordError = "Parool peab olema v�hemalt 8 t�hem�rkki pikk!";
				
			}
			
		}
		
	}
	
	if ( $signupEmailError == "" AND
		$signupPasswordError == "" &&
		isset ($_POST["signupEmail"]) &&
		isset($_POST["signupPassword"])
	//viga ei olnud, k�ik v�ljad on t�idetud (&&)
	
	){
		echo "salvestan...<br>";
		echo "email ".$signupEmail."<br>";
		echo "parool".$_POST["signupPassword"]."<br>";
		
		$password = hash("sha512",$_POST["signupPassword"]);
		
		echo $password."<br>";
		//loon �henduse andembaasi
		signup($signupEmail, $password);
			
			
		}
	//vaikimisi v��rtus, radio buttonid
	$gender = "";
	
	if (isset ($_POST["gender"])) {
		if (empty ($_POST["gender"])) {
			$genderError = "V�li on kohustuslik!";
		} else {
			$gender = $_POST["gender"];
		}
		
	} $notice = "";
		//kontrolin kas kasutaja tahab sisse logida
		if(isset($_POST["loginPassword"])&&
		isset($_POST["loginEmail"])&&
		!empty($_POST["loginPassword"])&&
		!empty($_POST["loginEmail"])
		
		){
		
		$notice = login($_POST["loginEmail"], $_POST["loginPassword"]);	
			
		}

?>


<!DOCTYPE html>

<html>
	<head>
		<title>Sisselogimine</title>
	</head>

	<body>

		<h1>Logi sisse</h1>
		<p style="color:red;"><?=$notice;?></p>
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