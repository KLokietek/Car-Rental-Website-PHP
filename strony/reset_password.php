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
  <title>Reset Hasła</title>
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
  </style>
</head>
<body>

  <div class="container">
    <div class="form-container">
      <h2 class ="fon" >Generowanie nowego hasła</h2>
      <form action="../scripts/reset_password.php" method="post">
        <label class ="fon" for="email">Email:</label>
        <input type="text" id="email" name="email" required>
        <button type="submit">Wyślij na maila nowe hasło </button> <br>
        <button onclick="history.back()">Powrót do logowania</button>
      </form>

    </div>
  </div>

</body>
</html>
