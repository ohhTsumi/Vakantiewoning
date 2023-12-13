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
    <title></title>
</head>
<body>
    <?php 
        $houses = $conn->query('SELECT * FROM product')->fetchAll();
        $primaryimages = $conn->query('SELECT * FROM afbeelding where afbeelding_primary = 1')->fetchAll();
        $images = $conn->query('SELECT * FROM afbeelding where afbeelding_primary = 0')->fetchAll();
        $images_by_product_id = [];
        $primaryimages_by_product_id = [];

        foreach ($images as $image) {
            if (!isset($images_by_product_id[$image['product_id']])) {
                $images_by_product_id[$image['product_id']] = [];
            }
            $images_by_product_id[$image['product_id']][] = $image;
        }

        foreach ($primaryimages as $primaryimage) {
            if (!isset($primaryimages_by_product_id[$primaryimage['product_id']])) {
                $primaryimages_by_product_id[$primaryimage['product_id']] = [];
            }
            $primaryimages_by_product_id[$primaryimage['product_id']][] = $primaryimage;
        }

        $html_output = " ";
        foreach ($houses as $index => $house) {
            $images = $images_by_product_id[$house['product_id']] ?? false;
            $primaryimages = $primaryimages_by_product_id[$house['product_id']] ?? false;
            $html_output .= "<a class='houseclick' href='flyer.php?id=" . $house['product_id'] . "' >";
            $html_output .= "<div class='house-card'>";
            $html_output .= "<p class='ptext'>";
            $html_output .= "<label>" . "Locatie: " . "</label>" . $house['plaatsnaam'] . " " .$house['adres'] . " " . $house['postcode'] . "<br>";
            $html_output .= "<strong>" . "Prijs: " . "</strong>" . $house['prijs'] . "<br>";
            $html_output .= "</p>";
            $html_output .= ' <br>';

            if ($primaryimages) {
                foreach ($primaryimages as $primaryimage) {
                    $html_output .= '<img class="afbeeldingen" src="uploads/'. $primaryimage['afbeelding_url'] . '"></img>';
                }
            }

            $html_output .= "</div>";
            $html_output .= "</a>";
            $html_output .= ' <br>';
        }
        echo $html_output;
    ?>
</body>
</html>
