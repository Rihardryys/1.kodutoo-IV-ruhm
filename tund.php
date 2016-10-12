<?php 
	//MVP idee on pm fitness page, kuhu üritan panna võimalikult palju funktsioone. 1 rep max kalkulaatorid 5x5 seeriatest.
	//lisaks mõte toiteväärtuste tabeli tegemisest



	//var_dump($_POST);
	//var_dump(isset($_POST["signupEmail"]));
	
	
	require("functions.php");
	
	// kui on sisseloginud siis suunan data lehele
	if (isset($_SESSION["userId"])) {
		header("Location: data.php");
		exit();
	}
	
	//var_dump($_GET);
	
	//echo "<br>";
	
	//var_dump($_POST);
	
	//MUUTUJAD
	$signupEmailError = "*";
	$signupEmail = "";
	$loginEmailError = "";
	$loginEmail = "";
	$nimi = "";
	$nimiError = "";
	//kas keegi vajutas nuppu ja see on olemas
	
	if (isset ($_POST["loginEmail"])) {
		
		//on olemas
		// kas epost on tÃ¼hi
		if (empty ($_POST["loginEmail"])) {
			
			// on tÃ¼hi
			$loginEmailError = "* Väli on kohustuslik!";
			
		} else {
			// email on olemas ja Ãµige
			$loginEmail = $_POST["loginEmail"];
			
		}
		
	} 
	
	
	
	
	
	
	
	
	
	if (isset ($_POST["signupEmail"])) {
		
		//on olemas
		// kas epost on tÃ¼hi
		if (empty ($_POST["signupEmail"])) {
			
			// on tÃ¼hi
			$signupEmailError = "* Väli on kohustuslik!";
			
		} else {
			// email on olemas ja Ãµige
			$signupEmail = $_POST["signupEmail"];
			
		}
		
	} 
	
	$signupPasswordError = "*";
	
	if (isset ($_POST["signupPassword"])) {
		
		if (empty ($_POST["signupPassword"])) {
			
			$signupPasswordError = "* VÃ¤li on kohustuslik!";
			
		} else {
			
			// parool ei olnud tÃ¼hi
			
			if ( strlen($_POST["signupPassword"]) < 8 ) {
				
				$signupPasswordError = "* Parool peab olema vÃ¤hemalt 8 tÃ¤hemÃ¤rkki pikk!";
				
			}
			
		}
		
		/* GENDER */
		
		if (!isset ($_POST["gender"])) {
			
			//error
		}else {
			// annad vÃ¤Ã¤rtuse
		}
		
	}
	
	//vaikimisi vÃ¤Ã¤rtus
	$gender = "";
	
	if (isset ($_POST["gender"])) {
		if (empty ($_POST["gender"])) {
			$genderError = "* VÃ¤li on kohustuslik!";
		} else {
			$gender = $_POST["gender"];
		}
		
	} 
	$nimi = "";
	
	if (isset ($_POST["nimi"])) {
		if (empty ($_POST["nimi"])) {
			$nimiError = " Väli on kohustuslik!";
		} else {
			$nimi = $_POST["nimi"];
		}
		
	} 
	
	
	
	if ( $signupEmailError == "*" AND
		 $signupPasswordError == "*" &&
		 isset($_POST["signupEmail"]) && 
		 isset($_POST["signupPassword"]) 
	  ) {
		
		//vigu ei olnud, kÃµik on olemas	
		echo "Salvestan...<br>";
		echo "email ".$signupEmail."<br>";
		echo "parool ".$_POST["signupPassword"]."<br>";
		
		$password = hash("sha512", $_POST["signupPassword"]);
		
		echo $password."<br>";
		
		signup($signupEmail, $password, $nimi);
		
		
	}
	
	$notice = "";
	//kas kasutaja tahab sisse logida
	if ( isset($_POST["loginEmail"]) && 
		 isset($_POST["loginPassword"]) && 
		 !empty($_POST["loginEmail"]) &&
		 !empty($_POST["loginPassword"]) 
	) {
		
		$notice = login($_POST["loginEmail"], $_POST["loginPassword"]);
		
	}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Sisselogimise leht</title>
	</head>
	<body>

		<h1>Logi sisse</h1>
		<p style="color:red;"><?=$notice;?></p>
		<form method="POST" >
			
			<label>E-post</label><br>
			<input name="loginEmail" type="email" value="<?=$loginEmail;?>"> <?php echo $loginEmailError; ?>
			
			<br><br>

			<input name="loginPassword" placeholder="Parool" type="password">
			
			<br><br>
			
			<input type="submit" value="Logi sisse">
		
		</form>
		
		<h1>Loo kasutaja</h1>
		
		<form method="POST" >
			
			<label>E-post</label><br>
			<input name="signupEmail" type="email" value="<?=$signupEmail;?>"> <?php echo $signupEmailError; ?>
			
			<br><br>

			<input name="signupPassword" placeholder="Parool" type="password"> <?php echo $signupPasswordError; ?>
			
			<br><br>
			
			<label>Eesnimi</label><br>
			<input name="nimi" type="nimi" value="<?=$nimi;?>">
			
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
			
			
			<?php if ($gender == "other") { ?>
				<input type="radio" name="gender" value="other" checked> other<br>
			<?php } else { ?>
				<input type="radio" name="gender" value="other" > other<br>
			<?php } ?>
			
	
			<input type="submit" value="Loo kasutaja">
			
			
			
		
		</form>

	</body>
</html>
