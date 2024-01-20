<?php

$searchAttribute = isset($_GET['searchAttribute']) ? $_GET['searchAttribute'] : 'id_user';
$searchValue = isset($_GET['searchValue']) ? $_GET['searchValue'] : '';

require_once("connect.php");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM users WHERE $searchAttribute LIKE '%$searchValue%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<table>';
    echo '<tr><th>ID</th><th>Imię </th><th>Nazwisko </th><th>Email</th><th></th></tr>';
    
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['id_user'] . '</td>';
        echo '<td>' . $row['name'] . '</td>';
        echo '<td>' . $row['surname'] . '</td>';
        echo '<td>' . $row['email'] . '</td>';
        echo '<td><a href="./edit_user.php?id=' . $row['id_user'] . '">Edytuj </a>';
        echo '<button onclick="deleteUser(' . $row['id_user'] . ')">Usuń</button></td>';
        echo '</tr>';
    }
    
    echo '</table>';
} else {
    echo 'Nie znaleziono użytkowników.';
}

$conn->close();
?>
