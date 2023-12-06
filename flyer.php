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
            $images_by_product_id = [];
            $eigenschap_by_product_id = [];
            $html_output = " ";
            var_dump($eigenschappen['eigenschap']);
            var_dump($product_id);

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

                <img class="flyerLogo" src="https://cdn.discordapp.com/attachments/1024577266312818709/1180077393646469170/Vrijwonen_makelaar.png?ex=657c1bb7&is=6569a6b7&hm=462bb24509c3c7873bf649235cda581b3547af9a897fcef6ad71e7ac3820e32a&"> </img>

                <?php
                echo "<div class='product-details'>";
                echo "<h1>" . $house['plaatsnaam'] . ", " . $house['adres']. "</h1>";
                echo "<p>" . "<strong>" . $house['prijs'] . "</strong>" . "</p>";
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
        ?>
    </div>
</body>
</html>
