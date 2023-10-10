<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <style>
.overons {
    background-color: #FFF;
    border: 2px solid black;
    display: flex;
    padding: 40px;  /* Increased from 20px to 40px for more space */
    max-width: 900px;
    margin: 20px auto;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
}


.overons-logo {
    width: 22.5%; /* Adjusted to be 10% smaller than before */
    max-height: 100%; 
    margin-right: 20px;
}

.overons-content {
    display: flex;
    flex-direction: column;
    width: 77.5%; /* Adjusted to ensure the total width is 100% */
}

.overons-content p.title {
    margin: 0 0 10px 0;
    font-size: 1.2em; 
    text-align: center; 
}

.overons-content p {
    margin: 0;
    font-size: 0.85em;
    line-height: 1.4;
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
<div class="overons">
    <img class="overons-logo" src="./assets/img/Vrijwonen_makelaar.png" alt="logo">
    <div class="overons-content">
        <p class="title">over ons</p>
        <p>Bij Vrij Wonen begrijpen we dat een huis meer is dan alleen een plek om te wonen. Het is de plek waar uw dromen en toekomstige herinneringen worden gevormd. Ons toegewijde team van fictieve makelaars staat klaar om u te begeleiden op uw reis naar het vinden van de perfecte woning, zelfs als die woning nog niet bestaat!</p>
    </div>
</div>


<div class="listing">
    <!-- Image section -->
    <div class="listing-images">
        <img class="main-image" src="./assets/img/woning 1/hoofd.jpg" alt="Main House Image">
        <div class="more-images">
            <img src="./assets/img/woning 1/1.jpg" alt="House Image 1">
            <img src="./assets/img/woning 1/2.jpg" alt="House Image 2">
            <img src="./assets/img/woning 1/3.jpg" alt="House Image 3">
            <button class="arrow-btn">&gt;</button>

        </div>

    </div>

    <!-- Text section -->
    <div class="listing-info">
        <h2>Koningshoeve 3, Putten</h2>
        <p>Deze prachtige in 2020 gebouwde bungalow is ideaal voor een gezin dat wil genieten van de rust op de Veluwe. Het is gevestigd op Recreatiepark Het Hertje, en heeft 3 kamers waarbij het geschikt is voor 5 personen. Het komt met een royale tuin met veel privacy. De getoonde verkoopprijs is inclusief koopkavel, parkeerplaats en aansluitkosten.</p>

        <!-- New container for price and button -->
        <div class="price-info">
            <div class="listing-price">€ 121240</div>
            <button class="more-info">Meer Info</button>
        </div>
    </div>

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