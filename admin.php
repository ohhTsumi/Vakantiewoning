<?php
    session_start();
    require 'database.php';

    $houses = $conn->query('SELECT * FROM product')->fetchAll();

$html_output = '';

    foreach ($houses as $house) {
        $images = $images_by_product_id[$house['product_id']] ?? false;
        $id = $house['product_id'];
        $html_output .= "<table><tr>";
        $html_output .=  "<td>" . $house['titel'] . "</td>";
        $html_output .=  "<td>" . $house['prijs'] . "</td>";
        $html_output .=  "<td>" . $house['adres'] . "</td>";
        $html_output .=  "<td>" . $house['postcode'] . "</td>";
        $html_output .=  "<td>" . $house['plaatsnaam'] . "</td>";
        $html_output .= "<td><form method='post' action='test.php'>";
        $html_output .= "<input name='id' class='invis' value=" .$id . ">";
        $html_output .= "</input>";
        $html_output .= "<button name='submit' type='submit'>Bewerken</button>";
        $html_output .= "</form></td>";
        $html_output .= "</tr>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>

    </title>
</head>
<body>
<?php 
echo $html_output;;
?>
</body>
</html>