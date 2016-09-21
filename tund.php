<?php
//var_dump($_GET);
//echo "<br>";
// $_post["signupEmail"] //annab muutuja v on muutuja
//muutujad
// <?php echo on sama mis <?=$m
$signupEmailError = "";
$signupEmail = "";


$signupEmailError = "";

// kas keegi vajutas nuppu ja see on olemas
if (isset ($_POST["signupEmail"])) {
//on olemas
//kas epost on tyhi
if(empty ($_POST["signupEmail"])){
	// on tyhi
	$signupEmailError="vali on kohustlik";
}
	else{ 
	$signupEmail = $_POST["signupEmail"];
}
}

$signupPasswordError= "";
if(isset($_POST["signupPassword"])){
if (empty ($_POST["signupPassword"]))

{
	$signupPasswordError="vali on kohustuslik";
	
}

}
$loginPasswordError= "";
if(isset($_POST["loginPassword"])){
if (empty ($_POST["loginPassword"]))
{
	$loginPasswordError="vali on kohustuslik";
	
}

}
$loginEmailError= "";
if(isset($_POST["loginEmail"])){
if (empty ($_POST["loginEmail"]))
{
	$loginEmailError="väli on kohustuslik";
	
}

}
$male_status = 'unchecked';
$female_status = 'unchecked';

if (isset($_POST['Submit1'])) {

$selected_radio = $_POST['gender'];

if ($selected_radio = 'male') {

$male_status = 'checked';

}
else if ($selected_radio = 'female') {

$female_status = 'checked';

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
			<input type="Email" name="loginEmail" placeholder="naide@naide.ee"><?php echo $loginEmailError; ?><br>
			<input type="password" name="loginpassword" placeholder="parool"><?php echo $loginPasswordError; ?><br>

			<input type="submit" value="vajuta">
		</form>
		<h1> Loo kasutaja </h1>
		<form method="POST">
			<input type="Email" name="signupEmail" placeholder="naide@naide.ee" value="<?=$signupEmail;?>"><?php echo $signupEmailError; ?><br>
			<input type="password" name="signupPassword" placeholder="parool"><?php echo $signupPasswordError; ?><br>

			<input type="submit" value="vajuta">
		</form>
		<FORM name ="form1" method ="post" action ="radioButton.php">

		<Input type = 'Radio' Name ='gender' value= 'male'
		<?PHP print $male_status; ?>
		>Male

		<Input type = 'Radio' Name ='gender' value= 'female' 
		<?PHP print $female_status; ?>
		>Female

		</FORM>
	</body>

</html>