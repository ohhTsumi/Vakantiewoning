<?php
    session_start();
    require 'database.php';

    if (isset($_POST["submit"])) { 
    $titel = htmlspecialchars($_POST['titel']);
    $prijs = htmlspecialchars($_POST['prijs']);
    $adres = htmlspecialchars($_POST['adres']);
    $postcode = htmlspecialchars($_POST['postcode']);
    $plaatsnaam = htmlspecialchars($_POST['plaatsnaam']);
    $description = htmlspecialchars($_POST['description']);
    $statement = $conn->prepare("INSERT INTO product 
        (titel,prijs,adres,postcode,plaatsnaam,description) 
        VALUES (:titel,:prijs,:adres,:postcode,:plaatsnaam,:description)");
    $statement->bindParam(":titel",$titel);
    $statement->bindParam(":prijs",$prijs);
    $statement->bindParam(":adres",$adres);
    $statement->bindParam(":postcode",$postcode);
    $statement->bindParam(":plaatsnaam",$plaatsnaam);
    $statement->bindParam(":description",$description);
    $statement->execute(); 
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<form name="form" method="post">
		<input class="" type="text" name="titel" id="titel" placeholder="Titel" required><br><br>
		<input class="" type="text" name="prijs" id="prijs" placeholder="Price" required><br><br>
		<input class="" type="text" name="adres" id="adres" placeholder="Adres" required><br><br>
		<input class="" type="text" name="postcode" id="postcode" placeholder="Postcode" required><br><br>
		<input class="" type="text" name="plaatsnaam" id="plaatsnaam" placeholder="Plaatsnaam" required><br><br>
		<input class="" type="text" name="description" id="description" placeholder="Description" required><br><br>
		<button name="submit" >Submit</button>
	</form>
</body>
</html>