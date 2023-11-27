<?php
    session_start();
    require 'database.php';
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
    <header>
<?php require 'header.php'; ?>
    </header>
    <div class="form center">
        <form method="post">
            <h1>Login for Admin</h1>
            <input class="center" type="text" name="username" id="username" placeholder="Gebruikersnaam"><br><br>
            <input class="center" type="password" name="password" id="password" placeholder="Password"><br><br>

            <?php
            if (isset($_POST["submit"])) {
                $stmt = $conn->prepare("SELECT * FROM `admin` WHERE `username` = :username");
                $stmt->execute([
                    ':username' => $_POST['username']
                ]);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($result && password_verify($_POST['password'], $result['password'])) {
                    $_SESSION['user'] = $result;
                    $_SESSION['sessionid'] = session_id();
                    

                     header("Location: index.php");

                } else {
                    echo '<p class="error">Gebruikersnaam/wachtwoord klopt niet.</p>';
                }
            }
            ?>
            <button class="center reg"  name="submit" type="submit">Login</button>
        </form>


</body>
</html>