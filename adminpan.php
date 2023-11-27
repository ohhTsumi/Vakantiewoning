<?php


    session_start();
    require 'database.php';


	//$varnaam = null;
    //for($i=0;$i<10;$i++) {
    //		$varnaam .= sprintf("<li><input type=\"checkbox\" name=\"eigenschap_naam[]\" value=\"%s\">%s</li>",$id,$row["eigenschap_naam"]);;
    //}

    if (isset($_POST["submit"])) { 

		$uploads_dir = 'uploads';

				$images1 = [];
		foreach ($_FILES["images1"]["error"] as $key => $error) {
		    if ($error == UPLOAD_ERR_OK) {
		        $tmp_name = $_FILES["images1"]["tmp_name"][$key];
		        // basename() may prevent filesystem traversal attacks;
		        // further validation/sanitation of the filename may be appropriate
		        $name = md5(time()) . basename($_FILES["images1"]["name"][$key]);
		        $primaryimages[] = $name;
		        move_uploaded_file($tmp_name, "$uploads_dir/$name");
		    }
		}

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
	}
    if (isset($_POST["submitEigenschap"])) { 
        $eigenschappen = htmlspecialchars($_POST['eigenschappen']);
        $statement = $conn->prepare("INSERT INTO eigenschappen 
            (eigenschap_naam) 
            VALUES (:eigenschappen)");
        $statement->bindParam("eigenschappen",$eigenschappen);
        $statement->execute(); 
    }

    if (isset($_POST["submitLiggingopties"])) { 
        $liggingopties = htmlspecialchars($_POST['liggingopties']);
        $statement1 = $conn->prepare("INSERT INTO liggingopties 
            (liggingopties_naam) 
            VALUES (:liggingopties)");
        $statement1->bindParam("liggingopties",$liggingopties);
        $statement1->execute(); 
    }

        $houses = $conn->query('SELECT * FROM product')->fetchAll();

$html_output = '';

    foreach ($houses as $house) {
        $images = $images_by_product_id[$house['product_id']] ?? false;
        $id = $house['product_id'];
        $html_output .= "<table><tr class='tableHeader' >";
        $html_output .=  "<td class='spaceUnder, tabelTitel' >" . $house['titel'] . "</td>";
        $html_output .=  "<td class='spaceUnder, tabelPrijs'>" . $house['prijs'] . "</td>";
        $html_output .=  "<td class='spaceUnder, tabelAdres'>" . $house['adres'] . "</td>";
        $html_output .=  "<td class='spaceUnder, tabelPostcode'>" . $house['postcode'] . "</td>";
        $html_output .=  "<td class='spaceUnder, tabelPlaatsnaam'>" . $house['plaatsnaam'] . "</td>";

        $html_output .= "<td class='spaceUnder'><form method='post' action='test.php'>";
        $html_output .= "<input name='id' class='invis' value=" .$id . ">";
        $html_output .= "</input>";
        $html_output .= "<button name='submit' type='submit'>Bewerken</button>";
        $html_output .= "</form>";

        $html_output .= "<td class='spaceUnder'><form method='post' onsubmit='return confirmSubmit()' >";
        $html_output .= "<input name='id' class='invis' value=" .$id . ">";
        $html_output .= "</input>";
        $html_output .= "<button name='verwijder' type='submit'>verwijder</button>";
        $html_output .= "</form>";
        $html_output .= "</tr>";
}
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
<?php 
require "header.php";
?>
<button onclick="showform()" class="buttonAdmin">Add Listing</button><br><br>
<button onclick="showadd()" class="buttonAdmin">Add Eigenschap/Liggingopties</button><br><br>
<button onclick="showHouses()" class="buttonAdmin" >Edit/Verwijderen</button>
<div id="adminpanform" >
	<form name="form" class="adminpanform"  method="post">
		<input class="adminpaninput" type="text" name="titel" id="titel" placeholder="Titel" required><br><br>
		<input class="adminpaninput" type="text" name="prijs" id="prijs" placeholder="Price" required><br><br>
		<input class="adminpaninput" type="text" name="adres" id="adres" placeholder="Adres" required><br><br>
		<input class="adminpaninput" type="text" name="postcode" id="postcode" placeholder="Postcode" required><br><br>
		<input class="adminpaninput" type="text" name="plaatsnaam" id="plaatsnaam" placeholder="Plaatsnaam" required><br><br>

		<input class="adminpaninput" type="text" name="description" id="description" placeholder="Description" required><br><br>		
		<label class="labelimage" for="primaryimages" >Upload Primary image</label>
		<input class="adminpaninput" id="primaryimages" type="file" name="images1[]"  accept="image/*">
		<label class="labelimage" for="images" >Upload Secondary image</label>
		<input class="adminpaninput" id="images" type="file" name="images[]" multiple accept="image/*" maxlength="3">
		<ul class="ul" id="properties">
            <?php
            $sql ="SELECT eigenschap_id,eigenschap_naam FROM 
            eigenschappen";
            $result = $conn->query($sql);


            while($row = $result->fetch()){ 
				$id = $row["eigenschap_id"];

				printf("<li class='li' ><input type=\"checkbox\" name=\"eigenschap_naam[]\" value=\"%s\">%s</li>",$id,$row["eigenschap_naam"]);


                //echo '<li><input type="checkbox" name="eigenschap_naam[]" value=' . ' '.  . $row["eigenschap_naam"] . '</li>';
                }

            ?>
        </ul>
        <ul class="ul" id="options">
            <?php
            $sql ="SELECT liggingopties_id,liggingopties_naam FROM 
            liggingopties";
            $result = $conn->query($sql);
            while($row = $result->fetch()){ 
            	$liggingid = $row["liggingopties_id"];

				printf("<li class='li'><input type=\"checkbox\" name=\"liggingopties_naam[]\" value=\"%s\">%s</li>",$liggingid,$row["liggingopties_naam"]);

                //echo '<li><input type="checkbox" name="liggingopties_naam[]">' . $row["liggingopties_naam"] . '</li>';
                    }

            ?>
        </ul>
		<button class="adminpanbtn" name="submit" >Submit</button>
	</form>
</div>
	<div id="formadd">
	<form class="adminpanform" name="form" method="post" enctype="multipart/form-data">
        <input class="adminpaninput" type="text" name="eigenschappen" id="eigenschappen" placeholder="Eigenschappen">
        <button class="adminpanbtn" name="submitEigenschap">Submit</button><br><br>
        <input class="adminpaninput" type="text" name="liggingopties" id="liggingopties" placeholder="Liggingopties">
        <button class="adminpanbtn" name="submit1Liggingopties">Submit</button>
    </form>
</div>
<div id="houselist">
	<?php echo $html_output; ?>
</div>

<script type="text/javascript">
	let addListing = document.getElementById('adminpanform');
	let add = document.getElementById('formadd');
	let housingList = document.getElementById('houselist');
	function showform() {
		addListing.style.display= "block";
		add.style.display = "none";
		housingList.style.display = "none";
	}
	function showadd() {
		addListing.style.display = "none";
		add.style.display = "block";
		housingList.style.display = "none";
	}
	function showHouses() {
		addListing.style.display = "none";
		add.style.display = "none";
		housingList.style.display = "block";		
	}

</script>
</body>
</html>