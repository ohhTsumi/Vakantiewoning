<?php
    session_start();
    require 'database.php';

    if (isset($_POST["submit"])) { 
        $eigenschappen = htmlspecialchars($_POST['eigenschappen']);
        $statement = $conn->prepare("INSERT INTO eigenschappen 
            (eigenschap_naam) 
            VALUES (:eigenschappen)");
        $statement->bindParam("eigenschappen",$eigenschappen);
        $statement->execute(); 
    }

    if (isset($_POST["submit1"])) { 
        $liggingopties = htmlspecialchars($_POST['liggingopties']);
        $statement1 = $conn->prepare("INSERT INTO liggingopties 
            (liggingopties_naam) 
            VALUES (:liggingopties)");
        $statement1->bindParam("liggingopties",$liggingopties);
        $statement1->execute(); 
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
        <input class="" type="text" name="eigenschappen" id="eigenschappen" placeholder="Eigenschappen">
        <button name="submit">Submit</button><br><br>
        <input class="" type="text" name="liggingopties" id="liggingopties" placeholder="Liggingopties">
        <button name="submit1" >Submit</button>
        <ul>
            <?php
            $sql ="SELECT eigenschap_id,eigenschap_naam FROM 
            eigenschappen";
            $result = $conn->query($sql);
            while($row = $result->fetch()){ 
                echo '<li><input type="checkbox">' . $row["eigenschap_naam"] . '</li>';
                    }

            ?>
        </ul>
        <ul>
            <?php
            $sql ="SELECT liggingopties_id,liggingopties_naam FROM 
            liggingopties";
            $result = $conn->query($sql);
            while($row = $result->fetch()){ 
                echo '<li><input type="checkbox">' . $row["liggingopties_naam"] . '</li>';
                    }

            ?>

        </ul>
    </form>
</body>
</html>