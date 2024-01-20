<?php

require_once("connect.php");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['deleteCar'])) {
    $carIdToDelete = $_POST['deleteCar'];
    
    $sql = "DELETE FROM cars WHERE id_car = $carIdToDelete";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$sql = "SELECT * FROM cars";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<table>';
    echo '<tr><th>ID</th><th>Marka</th><th>Model</th><th>Action</th></tr>';
    
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['id_car'] . '</td>';
        echo '<td>' . $row['brand'] . '</td>';
        echo '<td>' . $row['model'] . '</td>';
        echo '<td>';
        echo '<form method="post">';
        echo '<input type="hidden" name="deleteCar" value="' . $row['id_car'] . '">';
        echo '<button type="submit">Usuń</button>';
        echo '</form>';
        echo '</td>';
        echo '</tr>';
    }
    
    echo '</table>';
} else {
    echo 'Nie znaleziono samochodów.';
}

$conn->close();
?>
