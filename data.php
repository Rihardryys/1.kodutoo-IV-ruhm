<?php 
	//Ã¼hendan sessiooniga
	require("functions.php");
	
	//kui ei ole sisseloginud, suunan login lehele
	if (!isset($_SESSION["userId"])) {
		header("Location: tund5.php");
		exit();
	}
	
	
	//kas aadressireal on logout
	if (isset($_GET["logout"])) {
		
		session_destroy();
		
		header("Location: tund5.php");
		exit();
		
	}
	
	
	if ( isset($_POST["age"]) && 
		 isset($_POST["color"]) && 
		 !empty($_POST["age"]) &&
		 !empty($_POST["color"]) 
	) {
		saveEvent(cleanInput ($_POST["age"], $_POST["color"]));
	}
	//header("location: data.php"); ----------- Läheb functioni sisse, landing page on data.php Function saveEvent.
	//exit;                         -----------
	$people = getAllPeople();
	echo"<pre>";
	var_dump($people);
	echo"<pre>";
?>
<h1>Data</h1>

<?php echo$_SESSION["userEmail"];?>

<?=$_SESSION["userEmail"];?>

<p>
	Tere tulemast <?=$_SESSION["userEmail"];?>!
	<a href="?logout=1">logi vÃ¤lja</a>
</p>

<h2>Salvesta sÃ¼ndmus</h2>
<form method="POST" >
	
	<label>Vanus</label><br>
	<input name="age" type="number">
	
	<br><br>
	<label>Varv</label><br>
	<input name="color" type="color">
	
	<br><br>
	
	<input type="submit" value="Salvesta">

</form>


<h2>Arhiiv</h2>
<?php

	$html = "<table>";
		$html .= "<tr>";
		
			$html .= "<th>ID</th>";
			$html .= "<th>Vanus</th>";
			$html .= "<th>Värv</th>";			
			
		$html .= "</tr>";
		//iga liikme jaoks massiiv
		foreach ($people as $p) {
			
		$html .= "<tr>";		
			$html .= "<td>".$p->id."</td>";
			$html .= "<td>".$p->age."</td>";
			$html .= "<td>".$p->lightcolor."</td>";
		$html .= "</tr>";
		}
	
	$html .= "</table>";

	echo $html;

?>

<h2>Midagi huvitavat</h2>
<?php

	foreach($people as $p){
	$style ="	
		background-color:".$p->lightcolor.";
		width: 40px;
		height: 40px;
		border-radius: 20px;
		text-align: center;
		line-height: 39px;
		float: left;
		margin: 20px;
			
		
		
		";
		echo"<p style = ' ".$style."   '>".$p->age."</p>";
		
		
		
	}








?>

