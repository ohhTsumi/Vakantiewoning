<?php
    session_start();
    require 'database.php';

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="styles.css">
	<title>
		
	</title>
</head>
<body>
	<?php 
		$houses = $conn->query('SELECT * FROM product')->fetchAll();
		$images = $conn->query('SELECT * FROM afbeelding')->fetchAll();
		$images_by_product_id = [];
		
		foreach($images as $image) {
			if(!isset($images_by_product_id[$image['product_id']])) {
				$images_by_product_id[$image['product_id']] = [];
			}
		
			$images_by_product_id[$image['product_id']][] = $image;
		}
		$html_output = " ";
		foreach ($houses as $index => $house) {
			$images = $images_by_product_id[$house['product_id']] ?? false;
			$html_output .= "<div class='Jan'>";
			$html_output .= "<strong>" . "Titel: " . "</strong>" . $house['titel'] . "<br>";
			$html_output .= "<strong>" . "Prijs: " . "</strong>" . $house['prijs'] . "<br>";
			$html_output .= "<strong>" . "Locatie: " . "</strong>" . $house['plaatsnaam'] . " " .$house['adres'] . " " . $house['postcode'] . "<br>";
			$html_output .= "<strong>" . "Beschrijving: " . "</strong>" . $house['description'] . "<br>";
			$html_output .= ' <br>';
		
			if($images) foreach($images as $image) {
				$html_output .= '<img class="afbeeldingen" src="uploads/'. $image['afbeelding_url'] . '"></img>';
				
			}
			$html_output .= "</div";
			$html_output .= ' <br>';
		
		}
echo $html_output;
	

	?>


</body>
</html>