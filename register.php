<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'database.php';

$error_message = '';

if (!empty($_POST)) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];


    $stmt = $conn->prepare("SELECT * FROM `admin` WHERE `username` = :username");
    $stmt->execute([':username' => $username]);
    $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($existingUser) {
        $error_message = 'Deze gebruikersnaam is al in gebruik.';
        echo $error_message;
    } else {
 
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO `admin` (`username`, `password`, `email`) VALUES (:username, :password, :email)");
        $result = $stmt->execute([':username' => $username, ':password' => $hashedPassword, ':email' => $email]);
        if ($result) {
            header("Location: index.php");
            exit();
        } else {
            $error_message = 'Er is een fout opgetreden bij het registreren van het account. Probeer het later opnieuw.';
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
        <link rel="stylesheet" href="css/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Knowitall</title>
</head>
<?php
require 'header.php';
?>
<body>
    <div class="background">
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
</div>
    <div class="form center">
        <form method="post">
            <h1>KnowItAll</h1>
            <p>Registreer nu!</p>
            <input class="center" type="text" name="username" id="username" placeholder="Gebruikersnaam"><br><br>
            <input class="center" type="password" name="password" id="password" placeholder="Password"><br><br>
            <input class="center" type="text" name="email" id="email" placeholder="Email"><br>
        <p class="center ">Heeft u all een account? <a class="loginhref" href="login.php">Login nu</a></p>
        <button type="submit" class="center reg">Register</a></button>
        </form>
    </div>
</body>
</html>