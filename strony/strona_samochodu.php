<?php session_start();
require_once "../scripts/user.php";
require_once "../scripts/mailer.php";
require_once "../scripts/connect.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Rezerwacja</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/offers.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cookie&family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css" integrity="sha384-BY+fdrpOd3gfeRvTSMT+VUZmA728cfF9Z2G42xpaRkUGu2i3DyzpTURDo5A6CaLK" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<?php require_once "../components/navbar.php"; 

if(!isset($_SESSION["auth_user"])){
echo "<div class = 'container'>";
    echo "<div class ='popup'>";
        echo "<h2> Zaloguj się </h2>";
        echo "<p>Zaloguj się aby sprawdzić ofertę</p>";
        echo "<a href='./offers.php' class='text-btn'>wróć do ofert</a>";
    echo "</div>";
echo "</div>";
}
else{
?>

<div class="car-details">
<?php
    if (isset($_GET['id'])) {
        $car_id = $_GET['id'];
        
        // Pobranie szczegółów samochodu z bazy danych
        $sql_car = "SELECT * FROM cars WHERE id_car = $car_id";
        $result_car = $conn->query($sql_car);

        if ($result_car->num_rows > 0) {
            $row_car = $result_car->fetch_assoc();
            $sql_city = "SELECT id, address FROM Cities";
            $result = $conn->query($sql_city);

            // Wyświetlenie informacji o samochodzie
            echo "<div class='car-info'>";
            echo "<img src='" . $row_car['img'] . "' alt='Car Image'>";
            echo "<h2>" . $row_car['brand'] . " " . $row_car['model'] . "</h2>";
            echo "<p>" . $row_car['description'] . "</p>";
            echo "<p>Cena za dobę: " . $row_car['price'] . " PLN</p>";
            echo "</div>";

            // Formularz rezerwacji
            echo "<div class='reservation-form'>";
            echo "<h3>Zarezerwuj</h3>";
            echo "<form method='post'>";
            echo "<label>Data rozpoczęcia: </label>";
            echo "<input type='date' name='start_date' required><br>";
            echo "<label>Data zakończenia: </label>";
            echo "<input type='date' name='end_date' required><br>";
            echo '<label for="city">Wybierz lokalizację: </label>';
            echo '<select name="city" id="city">';
            
            while ($city_row = $result->fetch_assoc()) {
                echo '<option value="' . $city_row['id'] . '">' . $city_row['address'] . '</option>';
            }
        
            echo '</select>';
            echo "<br><br><input type='submit' name='reserve_submit' value='Zarezerwuj'>";
            echo "</form>";

            // Obsługa rezerwacji
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reserve_submit'])) {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    if ($start_date > $end_date) {
        echo "<p>Data zakończenia rezerwacji nie może być wcześniejsza niż data rozpoczęcia.</p>";
    } else if ($start_date < date('Y-m-d')) {
        echo "<p>Nie można cofać się w czasie - wybierz datę późniejszą niż dzisiaj.</p>";
    } else {
        $car_id = $_GET['id'];

        // Obliczanie liczby dni
        $datetime1 = new DateTime($start_date);
        $datetime2 = new DateTime($end_date);
        $interval = $datetime1->diff($datetime2);
        $num_of_days = $interval->format('%a');

        // Obliczanie ceny
        $price_per_day = 500; // Cena za dobę
        $price = ($num_of_days +1) * $price_per_day;
                    // Sprawdzenie dostępności terminu
                    $check_availability = "SELECT * FROM rent WHERE car_id = $car_id AND ((date_start <= '$start_date' AND date_end >= '$start_date') OR (date_start <= '$end_date' AND date_end >= '$end_date'))";
                    $result_availability = $conn->query($check_availability);

                    $duplicate_found = false;
                    if ($result_availability->num_rows > 0) {
                        while ($row = $result_availability->fetch_assoc()) {
                            // Sprawdź, czy znaleziony termin dotyczy tego samego samochodu
                            if ($row['car_id'] == $car_id && ($row['date_start'] == $start_date || $row['date_end'] == $end_date)) {
                                $duplicate_found = true;
                                break;
                            }
                        }
                    }

                    if ($duplicate_found) {
                        echo "<p>Ten termin jest już zarezerwowany.</p>";
                    } else {
                        $stmt = $conn->prepare("INSERT INTO rent (date_start, date_end, user_id, car_id,city_id, price) VALUES (?,?,?,?,?,?);");
                        $stmt->bind_param('ssiiii', $start_date, $end_date, $_SESSION["auth_user"]["id"], $car_id,$_POST["city"], $price);
                        if ($stmt->execute()) {
                            User::sentRentInfo($mail,$_SESSION["auth_user"],$row_car, $start_date, $end_date, $price);
                            $_SESSION["rent_success"] =  "Rezerwacja zakończona pomyślnie! Cena za wypożyczenie: " . $price . " zł";
                            header("location: ./offers.php");
                        } else {
                            echo "Błąd podczas rezerwacji: " . $conn->error;
                        }
                        $stmt->close();
                    }
                }
            }
            echo "</div>";
        } else {
            echo "Nie znaleziono samochodu.";
        }
    } else {
        echo "Brak wybranego samochodu.";
    }
$conn->close();
    ?>
</div>
<?php } ?>
</body>
</html>