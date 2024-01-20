<?php 
session_start();
if(isset($_SESSION["auth_user"]) && session_status()==2){
  header("location: ./index.php");
}?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login and Register Page</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background: linear-gradient(to bottom right, #333, #222);
      color: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

    .container {
      margin-left: 20px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      width: 300px;
    }

    .form-container {
      padding: 20px;
    }

    .form-container h2 {
      text-align: center;
    }

    form {
      display: flex;
      flex-direction: column;
    }

    label {
      margin-bottom: 8px;
    }

    input {
      padding: 8px;
      margin-bottom: 16px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    button {
      margin-top: 5px;
      padding: 10px;
      background-color: #333;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    button:hover {
      background-color: #555;
    }
    .fon {
        color:black;
    }
    .error-message {
        color: red;
        margin-bottom: 5px;
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="form-container">
      <h2 class ="fon" >Logowanie</h2>
        <?php
          if (isset($_SESSION["error"]) && !empty($_SESSION["error"])) {
            echo '<div class="error-message">' . $_SESSION["error"] . '</div>';
            unset($_SESSION["error"]);
          }
        ?>
      <form action="../scripts/login.php" method="post">
        <label class ="fon" for="login-email">Email:</label>
        <input type="text" id="login-email" name="login-email" required>

        <label class ="fon" for="login-password">Hasło:</label>
        <input type="password" id="login-password" name="login-password" required>
        <p class ="fon"> Nie pamiętasz hasła? <a href="reset_password.php"> Reset hasła </a> </p>
        <button type="submit">Logowanie </button>
      </form>

    </div>
  </div>

  <div class="container">
    <div class="form-container">
        <h2 class="fon">Rejestracja</h2>

        <?php if (isset($_SESSION["errors"]["empty"])): ?>
            <div class="error-message"><?php echo $_SESSION["errors"]["empty"]; ?></div>
        <?php endif; ?>

        <form action="../scripts/register.php" method="post">
            <label class="fon" for="register-firstname">Imię:</label>
            <input type="text" id="register-firstname" name="register-firstname" value="<?php echo isset($_SESSION["register-data"]["firstname"]) ? $_SESSION["register-data"]["firstname"] : ''; ?>" required>

            <?php if (isset($_SESSION["errors"]["firstname"])): ?>
                <div class="error-message"><?php echo $_SESSION["errors"]["firstname"]; ?></div>
            <?php endif; ?>

            <label class="fon" for="register-lastname">Nazwisko:</label>
            <input type="text" id="register-lastname" name="register-lastname" value="<?php echo isset($_SESSION["register-data"]["lastname"]) ? $_SESSION["register-data"]["lastname"] : ''; ?>" required>

            <?php if (isset($_SESSION["errors"]["lastname"])): ?>
                <div class="error-message"><?php echo $_SESSION["errors"]["lastname"]; ?></div>
            <?php endif; ?>

            <label class="fon" for="register-email">Email:</label>
            <input type="email" id="register-email" name="register-email" value="<?php echo isset($_SESSION["register-data"]["email"]) ? $_SESSION["register-data"]["email"] : ''; ?>" required>

            <?php if (isset($_SESSION["errors"]["email"])): ?>
                <div class="error-message"><?php echo $_SESSION["errors"]["email"]; ?></div>
            <?php endif; ?>

            <label class="fon" for="register-password">Hasło:</label>
            <input type="password" id="register-password" name="register-password" required>

            <?php if (isset($_SESSION["errors"]["password"])): ?>
                <div class="error-message"><?php echo $_SESSION["errors"]["password"]; ?></div>
            <?php endif; ?>

            <label class="fon" for="register-password2">Powtórz hasło:</label>
            <input type="password" id="register-password2" name="register-password2" required>

            <?php if (isset($_SESSION["errors"]["password2"])): ?>
                <div class="error-message"><?php echo $_SESSION["errors"]["password2"]; ?></div>
            <?php endif; ?>

            <button type="submit">Rejestracja</button>
        </form>

        <?php
        // Wyczyść wszystkie błędy i dane z sesji po ich wyświetleniu
        unset($_SESSION["register-data"]);
        unset($_SESSION["errors"]);
        ?>
    </div>
</div>
</body>
</html>
