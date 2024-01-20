<?php
require_once "../scripts/connect.php";
require_once "../scripts/user.php";
session_start();

if(!isset($_SESSION["auth_user"])){
    header("location: ./index.php");
}
else{
    if($_SESSION["auth_user"]["role"]!= 2){
        header("location: ./index.php");
    }
}
function addRecord($brand_name, $model, $description, $image_path,$conn) {
    $price = 500;
    $stmt = $conn->prepare("INSERT INTO cars (brand, model, description, img, price) VALUES (?, ?, ?, ?,?)");
    $stmt->bind_param("ssssi", $brand_name, $model, $description, $image_path,$price);
    
    if ($stmt->execute()) {
        $_SESSION["add_car"] = "Pomyślnie dodano samochód";
        return true;
    } else {
        return false;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $brand_name = $_POST["brand_name"];
    $model = $_POST["model"];
    $description = $_POST["description"];
    
    $target_dir = "../uploads/"; 
    $image_path = $target_dir . basename($_FILES["image"]["name"]);
    
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $image_path)) {
        if (addRecord($brand_name, $model, $description, $image_path,$conn)) {
            echo "Record added successfully!";
        } else {
            echo "Error adding record.";
        }
    } else {
        echo "Error uploading image.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/main.css">
    <link rel="stylesheet" href="../CSS/offers.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cookie&family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css" integrity="sha384-BY+fdrpOd3gfeRvTSMT+VUZmA728cfF9Z2G42xpaRkUGu2i3DyzpTURDo5A6CaLK" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Dodaj samochód do oferty</title>
</head>
<body>
<?php if (isset($_SESSION["add_car"])): ?>
    <div class="verify-user"><?php echo $_SESSION["add_car"]; ?></div>
<?php
    unset($_SESSION["add_car"]);
    endif;
?>
<?php  require_once "../components/navbar.php"; ?>
<div class="car-details">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        Marka samochodu: <input type="text" name="brand_name" required><br>
        Model: <input type="text" name="model" required><br>
        Opis: <textarea name="description" required></textarea><br>
        Zdjęcie: <input type="file" name="image" accept="image/*" required><br>
        <input type="submit" value="Dodaj pojazd">
    </form>
</div>


</body>
</html>

<?php
$conn->close();
?>
