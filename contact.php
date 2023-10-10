<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <style>
.contact-div {
    text-align: center;
    padding: 20px;
    background-color: #FFF;
    border: 2px solid black;
    width: 70%; /* Adjust to your preferred width */
    max-width: 800px; /* Limit the width, can be adjusted as per requirements */
    margin: 50px auto; /* Centers the form container horizontally and adds top and bottom margin */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Optional: adds a subtle shadow */
    display: flex;
    flex-direction: column;
    align-items: center;
}

.contact-div p{
    margin-top: 1px;
}

.input-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
}

.input-row input, 
textarea, 
.contact-btn {
    border: 2px solid black;
    padding: 10px;
    background: transparent;
    border-radius: 0; /* To ensure sharp rectangular corners */
    font-size: 16px;
    transition: border-color 0.3s ease;
}

.input-row input {
    flex: 1; /* To ensure equal distribution of space */
    margin-right: 10px; /* Space between inputs */
}

.input-row input:last-child {
    margin-right: 0;
}

textarea {
    width: 100%;
    min-height: 100px; /* You can adjust this as per your requirements */
    margin-bottom: 20px;
}

.contact-btn {
    cursor: pointer;
    padding: 10px 20px; /* Adjust padding for the button */
}

    </style>
</head>
<body>
<header>
    <div class="container">
        <a href="index.php"><img class="logo" src="./assets/img/Vrijwonen_makelaar.png" alt="logo"></a>
        <div class="nav">
            <a href="./woningen.php">woningen</a>
            <a href="contact.php">contact</a>
            <a href="./about.php">about</a>
        </div>
        <a href="" class="login-btn">login</a>
    </div>
</header>

<main>
<div class="contact-div">
    <p>Contact</p>
    
    <div class="input-row">
        <input type="email" id="email" name="email" placeholder="Email">
        <input type="text" id="volledige-naam" name="volledige-naam" placeholder="Volledige Naam">
        <input type="text" id="mobiel" name="mobiel" placeholder="Mobiel">
    </div>

    <textarea id="bericht" name="bericht" rows="5" placeholder="Bericht" style="resize: none;"></textarea>
    <button type="submit" class="contact-btn">Verstuur</button>
</div>

</main>

<footer>
    <img class="logo-footer" src="./assets/img/Vrijwonen_makelaar.png" alt="logo">
    <div class="address">
        <p>Disketteweg 2</p>
        <p>3815 AV Amersfoort</p>
    </div>
    <div class="contact">
        <p>info@vrijwonen.nl</p>
        <p>033-1122334</p>
    </div>
</footer>
</body>
</html>