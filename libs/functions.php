<?php 
  
  class Users{

    function isAdmin(){
      $checked = false;
      if(isset($_COOKIE["admin"]) && $_COOKIE["admin"] == true){
        $checked = true;
      }
      return $checked;
    }

    

  }

  class Patients{

    function getPatients(){
      require "ayar.php";

      $query = "SELECT * FROM patients ORDER BY id DESC";
      $result = mysqli_query($connection, $query);

      mysqli_close($connection);
      return $result;
    }

    function getPatientById($id){
      require "ayar.php";

      $query = "SELECT * FROM patients WHERE id=$id";
      $result = mysqli_query($connection, $query);

      mysqli_close($connection);
      return $result;
    }

    function addPatient($nameSurname,$hospitalName,$birtday,$passportNo,$country,$gender,
      $phone,$email,$heavy,$height,$episode,$entryDate,$endDate,$protocolNo,$description,
      $situation,$job,$currency,$price,$attendantNameSurname,$attendantBirtday,
      $attendantPassportNo,$attendantCountry,$attendantPhone,$attendantEmail){
      require "ayar.php";

      $query = "INSERT INTO patients(nameSurname,hospitalName,birtday,passportNo,country,
        gender,phone,email,heavy,height,episode,entryDate,endDate,protocolNo,description,
        situation,job,currency,price,attendantNameSurname,attendantBirtday,attendantPassportNo,attendantCountry,attendantPhone,attendantEmail) VALUES 
        ('$nameSurname','$hospitalName','$birtday','$passportNo','$country','$gender',
        '$phone','$email','$heavy','$height','$episode','$entryDate','$endDate',
        '$protocolNo','$description','$situation','$job','$currency','$price',
        '$attendantNameSurname','$attendantBirtday','$attendantPassportNo','$attendantCountry','$attendantPhone','$attendantEmail')";
      $result = mysqli_query($connection, $query);

      mysqli_close($connection);
      return $result;
    }

    function editPatient($id, $nameSurname,$hospitalName,$birtday,$passportNo,$country,$gender,$phone,$email,$heavy,$height,$episode,
      $entryDate,$endDate,$protocolNo,$description,$situation,$job,$currency,$price,$attendantNameSurname,$attendantBirtday,
      $attendantPassportNo,$attendantCountry,$attendantPhone,$attendantEmail){
      require "ayar.php";

      $query = "UPDATE patients SET nameSurname='$nameSurname',hospitalName='$hospitalName',
        birtday='$birtday',passportNo='$passportNo',country='$country',gender='$gender',
        phone='$phone',email='$email',heavy='$heavy',height='$height',episode='$episode',
        entryDate='$entryDate',endDate='$endDate',protocolNo='$protocolNo',
        description='$description',situation='$situation',job='$job',currency='$currency',price='$price',
        attendantNameSurname='$attendantNameSurname',attendantBirtday='$attendantBirtday',attendantPassportNo='$attendantPassportNo',
        attendantCountry='$attendantCountry',attendantPhone='$attendantPhone',attendantEmail='$attendantEmail' WHERE id='$id'";
      $result = mysqli_query($connection, $query);

      mysqli_close($connection);
      return $result;
    }

    function deletePatientById($id){
      require "ayar.php";

      $query = "DELETE FROM patients WHERE id='$id'";
      $result = mysqli_query($connection, $query);

      mysqli_close($connection);
      return $result;
    }

  }

  class Others{
    function control_input($data){
      $data = strip_tags($data);
      // $data = htmlspecialchars($data);
      // $data = htmlentities($data);
      $data = stripslashes($data); # sql injection
  
      return trim($data);
    }
  }  



  $users = new Users();
  $patients = new Patients();
  $others = new Others();

?>