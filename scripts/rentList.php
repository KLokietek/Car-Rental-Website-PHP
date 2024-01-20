<?php
require_once("connect.php");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$userId = $_SESSION["auth_user"]["id"];
$sql = "SELECT rent.id_rent, rent.date_start, rent.date_end, rent.price, cars.model, cars.brand FROM rent JOIN cars ON rent.car_id = cars.id_car WHERE rent.user_id = $userId;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<table>';
    echo '<tr><th>Id Wypożyczenia</th><th>Marka</th><th>Model</th><th>Od</th><th>Do</th></tr>';
    
    while ($row = $result->fetch_assoc()) {
        $start = strtotime($row["date_start"]);
        $end = strtotime($row["date_end"]);
        $start_date = date("Y-m-d", $start);
        $end_date = date("Y-m-d", $end);

        echo '<tr>';
        echo '<td>' . $row['id_rent'] . '</td>';
        echo '<td>' . $row['brand'] . '</td>';
        echo '<td>' . $row['model'] . '</td>';
        echo '<td>' . $start_date . '</td>';
        echo '<td>' . $end_date . '</td>';
        echo '<td>';
        echo '</td>';
        echo '</tr>';
    }
    echo '</table>';
} else {
    echo 'Brak wypożyczeń.';
}

$conn->close();
?>