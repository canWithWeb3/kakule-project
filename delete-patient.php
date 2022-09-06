<?php 
  require "libs/functions.php";

  if(!$users->isAdmin() || !isset($_GET["id"])){
    header("Location: index.php");
    exit;
  }


  if($patients->deletePatientById($_GET["id"])){
    header("Location: patient-list.php");
  }else{
    header("Location: patient-list.php");
  }


?>