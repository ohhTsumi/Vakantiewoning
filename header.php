<?php

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