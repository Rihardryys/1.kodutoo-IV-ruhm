<?php

	//yhendan sessiooniga
	require("functions.php");
	
	//kui pole sisse logitud, siis suunan login lehele tagasi
	if (!isset($_SESSION["userEmail"])) {
		header("Location: tund.php");
	}
	
	
	//kas aadressi real on logout
	if (isset($_GET["logout"])) {
			session_destroy();
	
		header("Location: tund.php");
		
	}
	



?>
<h1>Data</h1>

<p>
	Tere tulemast <?=$_SESSION["userEmail"];?>!
	<a href="?logout=1">logi valja</>
</p>