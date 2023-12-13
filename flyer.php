<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>House Flyer</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="flyer">
        <?php
            session_start();
            require 'database.php';
            $product_id = $_GET['id'];
            $houses = $conn->query('SELECT * FROM product')->fetchAll();
            $primaryimages = $conn->query('SELECT * FROM afbeelding where afbeelding_primary = 1')->fetchAll();
            $images = $conn->query('SELECT * FROM afbeelding where afbeelding_primary = 0 ')->fetchAll();
            $eigenschappen = $conn->prepare('SELECT * FROM product_eigenschappen where product_id = :id');
            $eigenschappen->bindParam(':id', $product_id, PDO::PARAM_INT);
            $eigenschappen->execute();
            $eigenschappen = $eigenschappen->fetchAll();
            $images_by_product_id = [];
            $eigenschap_by_product_id = [];
            $html_output = " ";

            foreach ($eigenschappen as $row) {
                $eigenschappenHouse = $row['eigenschap_id'];

            }

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

            // Check of 'id' parameter bestaat in de URL
            if (isset($_GET['id'])) {

                // Retrieve house details based on the product ID
                $house_details_query = $conn->prepare('SELECT * FROM product WHERE product_id = ?');
                $house_details_query->execute([$product_id]);
                $house = $house_details_query->fetch();

                // Display product details

                ?>

                <div class="flex-container-img">
                    <div><img class="flyerLogo" src="https://cdn.discordapp.com/attachments/1024577266312818709/1180077393646469170/Vrijwonen_makelaar.png?ex=657c1bb7&is=6569a6b7&hm=462bb24509c3c7873bf649235cda581b3547af9a897fcef6ad71e7ac3820e32a&"> </img></div>
                    <div class="info1">Vakantiewoningmakelaar Vrij Wonen<br>
                    Disketteweg 2<br>
                    3815 AV Amersfoort<br><br>
                    info@vrijwonen.nl<br>
                    033-112233</div>
                </div>

                <?php
                echo "<div class='product-details'>";
                echo "<h3>" . $house['plaatsnaam'] . ", " . $house['adres']. "</h3>";
                echo "<p>" . "Prijs: " . "<strong>" . $house['prijs'] . "</strong>" . " euro" . "</p>";
                echo "</div>";

                // Display primary image
                if (isset($primaryimages_by_product_id[$product_id][0])) {
                    $primaryimage = $primaryimages_by_product_id[$product_id][0];
                    echo '<div class="primary-image">';
                    echo '<img class="afbeelding-primary" src="uploads/' . $primaryimage['afbeelding_url'] . '"></img>';
                    echo '</div>';
                }

                // Display secondary images
                if (isset($images_by_product_id[$product_id])) {
                    echo '<div class="secondary-images">';
                    $secondary_images = $images_by_product_id[$product_id];
                    $count_secondary_images = count($secondary_images);

                    for ($i = 0; $i < min($count_secondary_images, 4); $i++) {
                        $secondary_image = $secondary_images[$i];
                        echo '<img class="afbeelding-secondary" src="uploads/' . $secondary_image['afbeelding_url'] . '" ></img>';
                    }
                    echo '</div>';
                    echo '<div class="description">'. $house['description'].'</div>';


                    // echo $eigenschap['product_id'];
            
                }
            } else {
                echo "No product ID specified";
            }

            $getEigenschap = $conn->prepare('SELECT eigenschap_naam FROM eigenschappen WHERE eigenschap_id = :eigenschappenhouse');
            $getEigenschap->bindParam(':eigenschappenhouse', $eigenschappenHouse, PDO::PARAM_INT);
            $getEigenschap->execute();
            $getEigenschap = $getEigenschap->fetchAll();

            $getLigging = $conn->prepare('SELECT liggingopties_naam FROM liggingopties; WHERE liggingopties_id = :ligginghouse');
            $getLigging->bindParam(':ligginghouse', $liggingHouse, PDO::PARAM_INT);
            $getLigging->execute();
            $getLigging = $getLigging->fetchAll();
            $html_eigenschap = "";
            $html_ligging = "";
            foreach ($getEigenschap as $eigenschappelen) {
                $html_eigenschap .= "<li class='eigenschapList'>" . $eigenschappelen['eigenschap_naam'] . "</li>";
            }
            foreach ($getLigging as $liggers) {
                $html_ligging .= "<li class='liggingList'>" . $liggers['liggingopties_naam'] . "</li>";
                
            }
        ?>
    <div class="flex-container">
    <div class="liggy">
        <h3>Liggingopties</h3>
        <ul>
        <?php echo $html_ligging;?>
        </ul>
    </div>
    <div class="eiggy">
        <h3>Eigenschappen</h3>
        <ul>
        <?php echo $html_eigenschap; ?>
        </ul>
    </div>
    </div>
    </div>
</body>
</html>
