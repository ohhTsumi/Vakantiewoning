<?php
<<<<<<< HEAD


    session_start();
    require 'database.php';


	//$varnaam = null;
    //for($i=0;$i<10;$i++) {
    //		$varnaam .= sprintf("<li><input type=\"checkbox\" name=\"eigenschap_naam[]\" value=\"%s\">%s</li>",$id,$row["eigenschap_naam"]);;
    //}

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

		foreach($_POST['eigenschap_naam'] as $eigenschapid) {
			$statementeigenschap = $conn->prepare("INSERT INTO product_eigenschappen 
				(eigenschap_id,product_id) 
				VALUES (:eigenschap_id,:product_id)");
			$statementeigenschap->bindParam(":eigenschap_id",$eigenschapid);
			$statementeigenschap->bindParam(":product_id",$product_id);
			$statementeigenschap->execute(); 
			}

		foreach($_POST['liggingopties_naam'] as $liggingoptiesid) {
			$statementliggingopties = $conn->prepare("INSERT INTO product_liggingopties 
				(liggingopties_id,product_id) 
				VALUES (:liggingopties_id,:product_id)");
			$statementliggingopties->bindParam(":liggingopties_id",$liggingoptiesid);
			$statementliggingopties->bindParam(":product_id",$product_id);
			$statementliggingopties->execute(); 
			}
=======
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
>>>>>>> b7f9a99d31e09ed16f53a23d8f2441112f8ece9b
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
<<<<<<< HEAD

	<form name="form" method="post" enctype="multipart/form-data">
=======
	<form name="form" method="post">
>>>>>>> b7f9a99d31e09ed16f53a23d8f2441112f8ece9b
		<input class="" type="text" name="titel" id="titel" placeholder="Titel" required><br><br>
		<input class="" type="text" name="prijs" id="prijs" placeholder="Price" required><br><br>
		<input class="" type="text" name="adres" id="adres" placeholder="Adres" required><br><br>
		<input class="" type="text" name="postcode" id="postcode" placeholder="Postcode" required><br><br>
		<input class="" type="text" name="plaatsnaam" id="plaatsnaam" placeholder="Plaatsnaam" required><br><br>
<<<<<<< HEAD
		<input class="" type="text" name="description" id="description" placeholder="Description" required><br><br>			
		<input type="file" name="images1[]"  accept="image/*"><br><br>
		<input type="file" name="images[]" multiple accept="image/*">
		<ul id="properties">
            <?php
            $sql ="SELECT eigenschap_id,eigenschap_naam FROM 
            eigenschappen";
            $result = $conn->query($sql);


            while($row = $result->fetch()){ 
				$id = $row["eigenschap_id"];

				printf("<li><input type=\"checkbox\" name=\"eigenschap_naam[]\" value=\"%s\">%s</li>",$id,$row["eigenschap_naam"]);


                //echo '<li><input type="checkbox" name="eigenschap_naam[]" value=' . ' '.  . $row["eigenschap_naam"] . '</li>';
                }

            ?>
        </ul>
        <ul id="options">
            <?php
            $sql ="SELECT liggingopties_id,liggingopties_naam FROM 
            liggingopties";
            $result = $conn->query($sql);
            while($row = $result->fetch()){ 
            	$liggingid = $row["liggingopties_id"];

				printf("<li><input type=\"checkbox\" name=\"liggingopties_naam[]\" value=\"%s\">%s</li>",$liggingid,$row["liggingopties_naam"]);

                //echo '<li><input type="checkbox" name="liggingopties_naam[]">' . $row["liggingopties_naam"] . '</li>';
                    }

            ?>


          

        </ul>
		<button name="submit" >Submit</button>
	</form>

	<script>

	</script>

=======
		<input class="" type="text" name="description" id="description" placeholder="Description" required><br><br>
		<button name="submit" >Submit</button>
	</form>
>>>>>>> b7f9a99d31e09ed16f53a23d8f2441112f8ece9b
</body>
</html>