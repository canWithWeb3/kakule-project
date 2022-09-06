

<?php 
  require "libs/functions.php";

  if(!$users->isAdmin()){
    header("Location: index.php");
    exit;
  }

?>

<?php require "views/_head-start.php"; ?>

<div id="admin-home">

  <?php include "views/_admin-menu.php"; ?>

  <?php require "views/_admin-top.php"; ?>

</div>

<?php require "views/_head-finish.php"; ?>