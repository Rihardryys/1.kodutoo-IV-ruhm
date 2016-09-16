<?php
//var_dump($_GET);
//echo "<br>";
var_dump($_POST);
// $_post["signupEmail"] //annab muutuja v on muutuja
$signupEmailError = "";

// kas keegi vajutas nuppu ja see on olemas
if (isset ($_POST["signupEmail"])) {
//on olemas
//kas epost on tyhi
if(empty ($_POST["signupEmail"])){
	// on tyhi
	$signupEmailError="vali on kohustlik";
}	
}

var_dump($_POST);
$signupPasswordError= "";
if(isset($_POST["signupPassword"])){
if (empty ($_POST["signupPassword"]))
{
	$signupPasswordError="vali on kohustuslik";
	
	
	
	
}

}

?>



<!DOCTYPE html>

<html>
	<head>
		<title>Sisselogimine</title>
	</head>

	<body>
	<h1> Logi sisse </h1>
		<form method="POST">
			<input type="Email" name="loginEmail" placeholder="naide@naide.ee"><br>
			<input type="password" name="loginpassword" placeholder="parool"><br>

			<input type="submit" value="vajuta">
		</form>
		<h1> Loo kasutaja </h1>
		<form method="POST">
			<input type="Email" name="signupEmail" placeholder="naide@naide.ee"><?php echo $signupEmailError; ?><br>
			<input type="password" name="signupPassword" placeholder="parool"><?php echo $signupPasswordError; ?><br>

			<input type="submit" value="vajuta">
		</form>
	<body>

</html>