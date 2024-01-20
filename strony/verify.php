<?php
session_start();
require_once "../scripts/user.php";
require_once "../scripts/connect.php";
if (isset($_POST['verify'])) {
    
    $verificationCode = $_GET['ver_code'];
    User::verifyUser($verificationCode,$conn);
    $_SESSION["verify_user"] = "Weryfikacja przebiegła pomyślnie!";
    header("location: ./index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/verify.css">
    <title>Weryfikacja maila</title>
</head>
<body>
    <form method="post">
        <h1>Weryfikacja maila</h1>
        <p> Naciśnij poniższy przycisk</p>
        <button type="submit" name="verify">Zweryfikuj</button>
    </form>
</body>
</html>