<?php
session_start();
require_once "./user.php";
User::logOut();
header("location: ../strony/index.php");
?>