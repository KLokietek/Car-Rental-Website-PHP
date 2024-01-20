<?php
session_start();
if(!isset($_SESSION["auth_user"])){
    header("location: ./index.php");
}
else{
    if($_SESSION["auth_user"]["role"]!= 2){
        header("location: ./index.php");
    }
}
if (!isset($_GET['id'])) {
    echo 'User ID is missing.';
    exit();
}
$userID = $_GET['id'];
require_once("../scripts/connect.php");
require_once("../scripts/user.php");

$user = User::findUserById($userID,$conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize user input here
    require_once "../scripts/user.php";
    $newFirstName = $_POST['firstname'];
    $newLastName = $_POST['surname'];
    $role = $_POST['role'] == "admin" ? 2 : 1;

$editUser = new User($userID,$newFirstName,$newLastName,$user->email,$user->password,$role,$user->ver_code);
    User::updateUser($userID,$editUser,$conn);
}

$conn->close();
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
    <title>Edytuj użytkownika <?php echo $user->email ?></title>
</head>
<body>
<?php require_once "../components/navbar.php"; ?>
    <div class="car-details">
        <h2>Edycja użytkownika</h2>

        <form method="post" action="">
            <label for="firstname">Imię:</label>
            <input type="text" id="firstname" name="firstname" value="<?php echo $user->name; ?>" required> <br>

            <label for="surname">Nazwisko:</label>
            <input type="text" id="surname" name="surname" value="<?php echo $user->surname; ?>" required><br>
            <label><input type="radio" name="role" value="user" <?php if($user->role ==1) {echo "checked";} ?>>Użytkownik  </label>
            <br>
            <label><input type="radio" name="role" value="admin"<?php if($user->role ==2) {echo "checked";} ?>>Admin</label>
            <br>
            <button type="submit">Zapisz zmiany</button>
        </form>
    </div>

</body>
</html>