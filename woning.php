<?php
    session_start();
    require 'database.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<<<<<<< HEAD
	<link rel="stylesheet" type="text/css" href="styles.css">
=======
	<link rel="stylesheet" href="styles.css">
>>>>>>> bad87a18e91ae073ca9786c638e84e14fb008933
	<title>
		
	</title>
</head>
<body>
<<<<<<< HEAD
	<header>
		<?php require 'header.php'; ?>
	</header>
=======
	<?php 
		$houses = $conn->query('SELECT * FROM product')->fetchAll();
		$primaryimages = $conn->query('SELECT * FROM afbeelding where afbeelding_primary = 1')->fetchAll();
		$images = $conn->query('SELECT * FROM afbeelding where afbeelding_primary = 0')->fetchAll();
		$images_by_product_id = [];
		
		foreach($images as $image) {
			if(!isset($images_by_product_id[$image['product_id']])) {
				$images_by_product_id[$image['product_id']] = [];
			}
		
			$images_by_product_id[$image['product_id']][] = $image;
		}

		foreach($primaryimages as $primaryimage) {
			if(!isset($primaryimages_by_product_id[$primaryimage['product_id']])) {
				$primaryimages_by_product_id[$primaryimage['product_id']] = [];
			}
		
			$primaryimages_by_product_id[$primaryimage['product_id']][] = $primaryimage;
		}


		$html_output = " ";
		foreach ($houses as $index => $house) {
			$images = $images_by_product_id[$house['product_id']] ?? false;
			$primaryimages = $primaryimages_by_product_id[$house['product_id']] ?? false;
			$html_output .= "<div class='house-card'>";
			$html_output .= "<strong>" . "Titel: " . "</strong>" . $house['titel'] . "<br>";
			$html_output .= "<strong>" . "Prijs: " . "</strong>" . $house['prijs'] . "<br>";
			$html_output .= "<strong>" . "Locatie: " . "</strong>" . $house['plaatsnaam'] . " " .$house['adres'] . " " . $house['postcode'] . "<br>";
			$html_output .= "<strong>" . "Beschrijving: " . "</strong>" . $house['description'] . "<br>";
			$html_output .= ' <br>';
			if($primaryimages) foreach($primaryimages as $primaryimage) {
				$html_output .= '<img class="afbeeldingen" src="uploads/'. $primaryimage['afbeelding_url'] . '"></img>';
				
			}
			if ($images) {
			foreach($images as $image) {
				$html_output .= '<img class="afbeeldingen" src="uploads/'. $image['afbeelding_url'] . '"></img>';
				}
			}
			$html_output .= "</div";
			$html_output .= ' <br>';
		
		}
echo $html_output;
	

	?>

>>>>>>> bad87a18e91ae073ca9786c638e84e14fb008933

</body>
</html>