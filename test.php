<?php
    session_start();
    require 'database.php';
<<<<<<< HEAD
=======
    var_dump($_POST);
>>>>>>> bad87a18e91ae073ca9786c638e84e14fb008933
    $html_output = '';
	$id = $_POST['id'] ;

	$houses = $conn->query("SELECT * FROM product WHERE product_id = '$id' ")->fetchAll();

    foreach ($houses as $house) {
<<<<<<< HEAD
    $html_output .= "<form name='form' class='adminpanform' method='post'>";
    $html_output .= "<input name='id' class='invis' value=" .$id . ">";
    $html_output .= "</input>";
        $html_output .= "<label> Titel: </label>";
    $html_output .= "<input type='text' name='titel' id='titel' value='" . $house['titel'] ."' required><br><br>";
        $html_output .= "<label> Price: </label>";
    $html_output .= "<input type='text' name='prijs' id='prijs' value='" . $house['prijs'] ."' required><br><br>";
    $html_output .= "<label> Adres: </label>";
    $html_output .= "<input type='text' name='adres' id='adres' value='" . $house['adres'] ."' required><br><br>";
    $html_output .= "<label> Postcode: </label>";
    $html_output .= "<input type='text' name='postcode' id='postcode' value='" . $house['postcode'] ."' required><br><br>";
    $html_output .= "<label> City: </label>";
    $html_output .= "<input type='text' name='plaatsnaam' id='plaatsnaam' value='" . $house['plaatsnaam'] ."' required><br><br>";
    $html_output .= "<label> Description: </label>";
=======
    $html_output .= "<form name='form' method='post'>";
    $html_output .= "<input name='id' class='invis' value=" .$id . ">";
    $html_output .= "</input>";
    $html_output .= "<label> Titel: ";
    $html_output .= "<input type='text' name='titel' id='titel' value='" . $house['titel'] ."' required><br><br>";
    $html_output .= "<label> Price: ";
    $html_output .= "<input type='text' name='prijs' id='prijs' value='" . $house['prijs'] ."' required><br><br>";
    $html_output .= "<label> Adres: ";
    $html_output .= "<input type='text' name='adres' id='adres' value='" . $house['adres'] ."' required><br><br>";
    $html_output .= "<label> Postcode: ";
    $html_output .= "<input type='text' name='postcode' id='postcode' value='" . $house['postcode'] ."' required><br><br>";
    $html_output .= "<label> City: ";
    $html_output .= "<input type='text' name='plaatsnaam' id='plaatsnaam' value='" . $house['plaatsnaam'] ."' required><br><br>";
    $html_output .= "<label> Description: ";
>>>>>>> bad87a18e91ae073ca9786c638e84e14fb008933
    $html_output .= "<input type='text' name='description' id='description' value='" . $house['description'] ."' required><br><br>";
    $html_output .= "<button name='submit1'>Submit</button>";
    $html_output .= "</form>";
	}

	if (isset($_POST['submit1'])) {
		$titel = htmlspecialchars($_POST['titel']);
		$prijs = htmlspecialchars($_POST['prijs']);
	    $adres = htmlspecialchars($_POST['adres']);
	    $postcode = htmlspecialchars($_POST['postcode']);
	    $plaatsnaam = htmlspecialchars($_POST['plaatsnaam']);
	    $description = htmlspecialchars($_POST['description']);
	    $id = $_POST['id'] ;
<<<<<<< HEAD
=======

>>>>>>> bad87a18e91ae073ca9786c638e84e14fb008933
		$sql = "UPDATE product SET  titel = :titel ,adres = :adres , postcode = 
		:postcode , plaatsnaam = :plaatsnaam, prijs = :prijs, description = :description WHERE product_id = :id";
		$stmt = $conn->prepare($sql);
	    $stmt->bindParam(":titel",$titel);
	    $stmt->bindParam(":prijs",$prijs);
	    $stmt->bindParam(":adres",$adres);
	    $stmt->bindParam(":postcode",$postcode);
	    $stmt->bindParam(":plaatsnaam",$plaatsnaam);
	    $stmt->bindParam(":description",$description);
	    $stmt->bindParam(":id",$id);
		$stmt->execute();
		header("Location: admin.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<?php 
<<<<<<< HEAD
require "header.php";
=======
>>>>>>> bad87a18e91ae073ca9786c638e84e14fb008933
echo $html_output;
?>
</body>
</html>