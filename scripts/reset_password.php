<?php  
require_once "./mailer.php";
require_once "./user.php";
require_once "./connect.php";
$nowe_haslo = User::generateSafePassword();
User::resetPassword($mail, "jakubmikolajczak1ti@gmail.com",$nowe_haslo,$conn);


?>