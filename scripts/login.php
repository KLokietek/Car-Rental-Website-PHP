<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["login-email"];
    $password = $_POST["login-password"];

    // Sprawdzenie czy niepuste dane
    if (isset($email, $password) && !empty($email) && !empty($password)) {
        // echo "Dane nie puste <br>";

        // Czy poprawny adres email
        $filteredEmail = filter_var($email, FILTER_VALIDATE_EMAIL);     // Czy email
        if ($filteredEmail !== false) {
            $normalizedEmail = strtolower($filteredEmail);       // wszystko z małej

            $emailParts = explode('@', $normalizedEmail);       // Sprawdzenie domeny
            $domain = end($emailParts);
            if (!checkdnsrr($domain, 'MX')) {
                $_SESSION["error"] = "Domena niepoprawna";
                header("location: ../strony/logandreg.php");
                exit();
            } else {
                // echo "Adres poprawny";
                $filterPassword = trim($password);      // Bez białych znaków
    
                require_once("./connect.php");
                require_once("./user.php");
                $user = User::findUser($normalizedEmail,$filterPassword,$conn);
                if($user == null) {
                    $_SESSION["error"] = "Błędny e-mail lub hasło";
                    header("location: ../strony/logandreg.php");
                    exit();
                }else{
                    // tutaj przypisanie danych użytkownika do sesji
                    User::logInUser($user);
                    header("location: ../strony/index.php");
                    $conn->close();
                }
            }
        } else {
            // echo "Adres niepoprawny";
            $_SESSION["error"] = "Nieprawidłowy format adresu e-mail";
            header("location: ../strony/logandreg.php");
            exit();
        }
    } else {
        // echo "Dane puste <br>";
        $_SESSION["error"] = "Wprowadź e-mail i hasło";
        header("location: ../strony/logandreg.php");
        exit();
    }
}
?>