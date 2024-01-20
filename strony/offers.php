<?php session_start(); ?>
<?php if (isset($_SESSION["rent_success"])): ?>
    <div class="verify-user"><?php echo $_SESSION["rent_success"]; ?></div>
<?php
    unset($_SESSION["rent_success"]);
    endif;
?>
 <!DOCTYPE html>
<html lang="en">
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
    <title>Lista samochodów</title>
</head>
<body>
<section class="header">
    <?php require_once "../components/navbar.php"; ?>
        <hr>        
        <?php
            // Połączenie z bazą danych
            require_once('../scripts/connect.php');
            
            // Parametry paginacji
            $results_per_page = 9; // liczba wyników na stronę

            // Pobranie numeru bieżącej strony
            if (!isset($_GET['page'])) {
                $page = 1;
            } else {
                $page = $_GET['page'];
            }

            // Obliczenie offsetu dla zapytania SQL
            $offset = ($page - 1) * $results_per_page;

            // Zapytanie SQL z uwzględnieniem LIMIT i OFFSET
            $sql = "SELECT * FROM cars LIMIT $offset, $results_per_page";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<div class='car-container'>";
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='car'>";
                    echo "<a href='strona_samochodu.php?id=" . $row["id_car"] . "'>";
                    echo "<img src='" . $row["img"] . "' alt='Car Image'>";
                    echo "<div class='overlay'>";
                    echo $row["brand"] . " " . $row["model"]; // Opis marki i modelu na przezroczystym tle
                    echo "</div>";
                    echo "</a>";
                    echo "</div>";
                }
                echo "</div>";
            } else {
                echo "Brak dostępnych samochodów";
            }

            // Pobranie liczby wszystkich samochodów
            $sql_count = "SELECT COUNT(*) AS total FROM cars";
            $count_result = $conn->query($sql_count);
            $row_count = $count_result->fetch_assoc();
            $total_results = $row_count['total'];

            // Obliczenie liczby stron
            $total_pages = ceil($total_results / $results_per_page);

            // Wyświetlenie linków do kolejnych stron
            echo "<div class='offers-page'>";
            for ($i = 1; $i <= $total_pages; $i++) {
                echo "<a href='?page=$i'>$i</a> ";
            }
            echo "</div>";

            $conn->close();
            ?>
    </section>
</body>
</html>