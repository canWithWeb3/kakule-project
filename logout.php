<?php 
  require "libs/functions.php";

  setcookie("admin", true, time() - 3600 * 30);

  header("Location: index.php");
?>