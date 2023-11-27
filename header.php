<?php
<<<<<<< HEAD

if (isset($_SESSION['sessionid'])) {
	echo '    <header>
		<nav>
		  <ul class="navul" >
		    <li class="navli" ><a href="index.php"><img class="logo" src="assets/logo.png"></a></li>
		    <li class="navli" ><a href="woning.php">Woning</a></li>
		    <li class="navli" ><a href="about.php">About</a></li>
		    <li class="navli" ><a href="contact.php">Contact</a></li>
		    <li class="navli" ><a onclick="doLogout()">Logout</a></li>
		    <li class="navli" ><a href="adminpan.php">Admin</a></li>
		  </ul>
		</nav>
    </header>';
} else {
	echo '<header>
		<nav>
		  <ul class="navul">
		    <li class="navli" ><a href="index.php"><img class="logo" src="assets/logo.png"></a></li>
		    <li class="navli"><a href="woning.php">Woning</a></li>
		    <li class="navli"><a href="about.php">About</a></li>
		    <li class="navli"><a href="contact.php">Contact</a></li>
		    <li class="navli"><a href="login.php">Login</a></li>
		  </ul>
		</nav>
    </header>';
}
?>
<script>
    
     function doLogout() {
         window.location.replace("logout.php");
     }
    
</script>
=======
    session_start();
    require 'database.php';

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="styles.css">
	<title></title>
</head>
<body>
    <header>
		<nav>
		  <ul>
		    <li><a href="#home"><img class="logo" src="assets/logo.png"></a></li>
		    <li><a href="#about">Woning</a></li>
		    <li><a href="#services">About</a></li>
		    <li><a href="#contact">Contact</a></li>
		    <li><a href="#blog">Login</a></li>
		  </ul>
		</nav>
    </header>
</body>
</html>
>>>>>>> bad87a18e91ae073ca9786c638e84e14fb008933
