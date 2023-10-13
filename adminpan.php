<?php
    session_start();
    require 'database.php';

    if (isset($_POST["submit"])) { 


		$uploads_dir = 'uploads';
		$images = [];
		foreach ($_FILES["images"]["error"] as $key => $error) {
		    if ($error == UPLOAD_ERR_OK) {
		        $tmp_name = $_FILES["images"]["tmp_name"][$key];
		        // basename() may prevent filesystem traversal attacks;
		        // further validation/sanitation of the filename may be appropriate
		        $name = md5(time()) . basename($_FILES["images"]["name"][$key]);
		        $images[] = $name;
		        move_uploaded_file($tmp_name, "$uploads_dir/$name");
		    }
		}

		$images1 = [];
		foreach ($_FILES["images1"]["error"] as $key => $error) {
		    if ($error == UPLOAD_ERR_OK) {
		        $tmp_name = $_FILES["images"]["tmp_name"][$key];
		        // basename() may prevent filesystem traversal attacks;
		        // further validation/sanitation of the filename may be appropriate
		        $name1 = md5(time()) . basename($_FILES["images"]["name"][$key]);
		        $primaryimages[] = $name;
		        move_uploaded_file($tmp_name, "$uploads_dir/$name");
		    }
		}


  
		$primary = 1;
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


	    $product_id = $conn->lastInsertId();
	    foreach($images as $image) {
	    $statementafbeelding = $conn->prepare("INSERT INTO afbeelding 
	        (product_id,afbeelding_url) 
	        VALUES (:product_id,:afbeelding_url)");
	    $statementafbeelding->bindParam(":product_id",$product_id);
	    $statementafbeelding->bindParam(":afbeelding_url",$image);
	    $statementafbeelding->execute(); 
	    }

	    foreach($primaryimages as $primaryimage) {
	    $statementprimaryafbeelding = $conn->prepare("INSERT INTO afbeelding 
	        (product_id,afbeelding_url,afbeelding_primary) 
	        VALUES (:product_id,:afbeelding_url,:afbeelding_primary)");
	    $statementprimaryafbeelding->bindParam(":product_id",$product_id);
	    $statementprimaryafbeelding->bindParam(":afbeelding_url",$primaryimage);
	    $statementprimaryafbeelding->bindParam(":afbeelding_primary",$primary);
	    $statementprimaryafbeelding->execute(); 
		}

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
	<form name="form" method="post" enctype="multipart/form-data">
		<input class="" type="text" name="titel" id="titel" placeholder="Titel" required><br><br>
		<input class="" type="text" name="prijs" id="prijs" placeholder="Price" required><br><br>
		<input class="" type="text" name="adres" id="adres" placeholder="Adres" required><br><br>
		<input class="" type="text" name="postcode" id="postcode" placeholder="Postcode" required><br><br>
		<input class="" type="text" name="plaatsnaam" id="plaatsnaam" placeholder="Plaatsnaam" required><br><br>
		<input class="" type="text" name="description" id="description" placeholder="Description" required><br><br>			
		<input type="file" name="images1[]"  accept="image/*"><br><br>
		<input type="file" name="images[]" multiple accept="image/*">
		<button name="submit" >Submit</button>
	</form>
</body>
</html>