<?php
    session_start();
    require 'database.php';

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
    <title>

    </title>
</head>
<body>
<?php 
echo $html_output;;
?>
</body>
    <script>
        function confirmSubmit() {
            // Display a confirmation dialog
            var confirmed = confirm("Are you sure you want to delete this listing?");
            
            // If user clicks OK, the form will be submitted; otherwise, it won't.
            return confirmed;
        }
    </script>
</html>