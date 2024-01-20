<?php session_start(); 
if(!isset($_SESSION["auth_user"])){
    header("location: ./index.php");
}
else{
    if($_SESSION["auth_user"]["role"] !=2){
        header("location: ./index.php");
    }
    else{

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
    <title>Lista użytkowników</title>
</head>
<body>
<?php require_once "../components/navbar.php"; ?>
    <div class="car-details">
        <h2>User List</h2>

        <!-- Search form -->
        <form action="user_list.php" method="get">
            <label for="searchAttribute">Szukaj przy pomocy: </label>
            <select name="searchAttribute" id="searchAttribute">
                <option value="id_user">ID</option>
                <option value="name">Imię</option>
                <option value="surname">Nazwisko</option>
                <option value="email">Email</option>
            </select>
            <input type="text" name="searchValue" placeholder="Szukaj...">
            <button type="submit">Szukaj</button>
        </form>

        <?php include '../scripts/user_list.php'; ?>

    </div>
<?php }} ?>
</body>
</html>