<?php session_start(); ?>
<?php if (isset($_SESSION["verify_user"])): ?>
    <div class="verify-user"><?php echo $_SESSION["verify_user"]; ?></div>
<?php
    unset($_SESSION["verify_user"]);
    endif;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cookie&family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css" integrity="sha384-BY+fdrpOd3gfeRvTSMT+VUZmA728cfF9Z2G42xpaRkUGu2i3DyzpTURDo5A6CaLK" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>RentIt</title>
</head>
<body>
    <section class="header">
    <?php require_once "../components/navbar.php"; ?>
        <hr>
        <div class="textbox">
            <h1>RentIt</h1>
            <h4>U nas spełnisz swoje najskrytsze motoryzacyjne marzenia w najlepeszych cenach.</p>
            <p>Nasze samochody premium czekają na ciebie.</p>            
            <?php  if(!isset($_SESSION["auth_user"])){
                echo '<a href="./logandreg.php" class="text-btn">Zaloguj się i sprawdź naszą oferte</a>   ';
            }
            ?>
        </div>    
    </section>
    <!-- Section offer-->
    <section class="offer">
        <div class="content">
            <h1>Samochody w naszej ofercie </h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus officiis maxime maiores cum excepturi nam! Perspiciatis, tenetur voluptatem? Excepturi magnam incidunt sequi laborum voluptate explicabo quia rem voluptates at asperiores!</p>
        <div class="row">
            <div class="offer-col">
                <h3>Samochody sportowe</h3>
                <hr>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio, itaque dignissimos aliquid hic veritatis voluptatem reiciendis molestiae! Sapiente unde fugit eos corrupti tempora, nisi, neque minus error et possimus placeat.</p>
            </div>
            <div class="offer-col">
                <h3>Samochody premium</h3>
                <hr>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi nisi quam laudantium officiis soluta molestiae temporibus qui veniam, ipsam exercitationem architecto autem iusto vero corporis ullam quibusdam ad tenetur vitae?</p>
            </div>
            <div class="offer-col">
                <h3>Samochody Luksusowe</h3>
                <hr>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt architecto alias cupiditate id aliquid, modi vel est vitae! Laboriosam aperiam perferendis sed adipisci ut quibusdam enim consectetur id itaque quo.</p>
            </div>
        </div>
        </div>
    </section>
    <!--Section--company--location-->
    <hr>
    <section class="company-location">
        <div class="content-company-location">
            <h1>Gdzie nas znajdziesz</h1>
        <p>Siedziby naszej firmy znajdziesz pod wskazanymi adresami.</p>
        <div class="row">
            <div class="company-col">
                <img src="../images/poznan-3597198_1920.jpg" alt="">
                <div class="layer">
                    <h3>Poznań</h3>
                </div>
                <p>Ul.św.Marcin 1 80-000</p>
            </div>
            <div class="company-col">
                <img src="../images/city-6529108_1920.jpg" alt="">
                <div class="layer">
                    <h3>Warszawa</h3>
                </div>
                <p>Ul.Złota 55 80-000</p>
            </div>
            <div class="company-col">
                <img src="../images/gdansk-7485703_1920.jpg" alt="">
                <div class="layer">
                    <h3>Gdańsk</h3>
                </div>
                <p>Ul.Nowaka 1 80-000</p>
            </div>
        </div>
        </div>
    </section>
    <hr>
    <!--section--Contact-->
    <section class="contact">
        <div class="content-contact">
            <H1>Zainteresowała się nasza oferta?<br>Jeśli tak to skontaktuj się z nami, jeżeli masz jakieś pytania.</H1>
            <a href="#" class="text-btn">Zadaj pytanie</a>
        </div>
    </section>
    <!--footer--Section-->
    <section class="footer">
        <div class="footer-content">
            <h4>About us</h4>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Beatae laborum ratione veritatis, facere et id dignissimos nesciunt illum doloribus magni odio nam eius aspernatur exercitationem fuga qui nostrum ad architecto?</p>
        </div>
    </section>

</body>
</html>