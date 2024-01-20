<?php 
session_start(); 
if(!isset($_SESSION["auth_user"])){
    header("location: ./index.php");
} else {
    if($_SESSION["auth_user"]["role"] != 2){
        header("location: ./index.php");
    } else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/offers.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cookie&family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css" integrity="sha384-BY+fdrpOd3gfeRvTSMT+VUZmA728cfF9Z2G42xpaRkUGu2i3DyzpTURDo5A6CaLK" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Lista samochodów</title>
</head>
<body>
    <?php require_once "../components/navbar.php"; ?>
    <div class="car-details">
        <h2>Car List</h2>
        <a href="add_samochod.php">Dodaj samochód do oferty</a>
        <?php include '../scripts/car_scripts.php'; ?>
    </div>
</body>
</html>
<?php 
    }
} 
?>