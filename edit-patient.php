

<?php 
  require "libs/functions.php";

  if(!$users->isAdmin() || !isset($_GET["id"])){
    header("Location: index.php");
    exit;
  }

  $getPatient = $patients->getPatientById($_GET["id"]);
  $patient = mysqli_fetch_assoc($getPatient);
  if($patient["nameSurname"] == null){
    header("Location: patient-list.php");
  }

  $nameSurname = $patient["nameSurname"];
  $hospitalName = $patient["hospitalName"];
  $birtday = $patient["birtday"];
  $passportNo = $patient["passportNo"];
  $country = $patient["country"];
  $gender = $patient["gender"];
  $phone = $patient["phone"];
  $email = $patient["email"];
  $heavy = $patient["heavy"];
  $height = $patient["height"];
  $episode = $patient["episode"];
  $entryDate = $patient["entryDate"];
  $endDate = $patient["endDate"];
  $protocolNo = $patient["protocolNo"];
  $description = $patient["description"];
  $situation = $patient["situation"];
  $job = $patient["job"];
  $currency = $patient["currency"];
  $price = $patient["price"];

  $attendantNameSurname = $patient["attendantNameSurname"];
  $attendantBirtday = $patient["attendantBirtday"];
  $attendantPassportNo = $patient["attendantPassportNo"];
  $attendantCountry = $patient["attendantCountry"];
  $attendantPhone = $patient["attendantPhone"];
  $attendantEmail = $patient["attendantEmail"];
  $error = "";

  if(isset($_POST["editPatient"])){
    // validation attendantNameSurname
    if(empty(trim($_POST["attendantNameSurname"]))){
      $error = "Refakatçi Adı ve soyadı boş bırakılamaz.";
    }elseif(strlen(trim($_POST["attendantNameSurname"])) < 3 || strlen(trim($_POST["attendantNameSurname"])) > 30){
      $error = "Refakatçi Adı ve soyadı 3 ile 30 karakter içerebilir.";
    }else{
      $attendantNameSurname = $others->control_input($_POST["attendantNameSurname"]);
    }

    // validation attendantBirtday
    $checked = date("Y-m-d", strtotime($_POST["attendantBirtday"]));
    if($checked == "1970-01-01"){
      $error = "Refakatçi Doğum Tarihi girmediniz.";
    }elseif($checked > date("Y-m-d")){
      $error = "Refakatçi Doğum tarihi, şimdiki zamandan büyük olamaz.";
    }else{
      $attendantBirtday = $others->control_input($checked);
    }

    // validation attendantPassportNo
    if(empty(trim($_POST["attendantPassportNo"]))){
      $error = "Refakatçi pasaport no boş bırakılamaz";
    }else{
      $attendantPassportNo = $others->control_input($_POST["attendantPassportNo"]);
    }

    // validation attendantCountry
    if(empty(trim($_POST["attendantCountry"]))){
      $error = "Refakatçi ülke boş bırakılamaz";
    }else{
      $attendantCountry = $others->control_input($_POST["attendantCountry"]);
    }

    // validation attendantCountry
    if(empty(trim($_POST["attendantPhone"]))){
      $error = "Refakatçi telefon boş bırakılamaz";
    }else{
      $attendantPhone = $others->control_input($_POST["attendantPhone"]);
    }

    // validation attendantEmail
    if(empty(trim($_POST["attendantEmail"]))){
      $error = "Refakatçi Email boş bırakılamaz";
    }elseif (!filter_var($_POST["attendantEmail"], FILTER_VALIDATE_EMAIL)) {
      $error = "Refakatçi email hatalı girdiniz.";
    }else{
      $attendantEmail = $others->control_input($_POST["attendantEmail"]);
    }


    // validation nameSurname
    if(empty(trim($_POST["nameSurname"]))){
      $error = "Adı ve soyadı boş bırakılamaz.";
    }elseif(strlen(trim($_POST["nameSurname"])) < 3 || strlen(trim($_POST["nameSurname"])) > 30){
      $error = "Adı ve soyadı 3 ile 30 karakter içerebilir.";
    }else{
      $nameSurname = $others->control_input($_POST["nameSurname"]);
    }

    // validation hospitalName
    if(empty(trim($_POST["hospitalName"]))){
      $error = "Hastane adı boş bırakılamaz";
    }else{
      $hospitalName = $others->control_input($_POST["hospitalName"]);
    }

    // validation birtday
    $checked = date("Y-m-d", strtotime($_POST["birtday"]));
    if($checked == "1970-01-01"){
      $error = "Doğum Tarihi girmediniz.";
    }elseif($checked > date("Y-m-d")){
      $error = "Doğum tarihi, şimdiki zamandan büyük olamaz.";
    }else{
      $birtday = $others->control_input($checked);
    }

    // validation passportNo
    if(empty(trim($_POST["passportNo"]))){
      $error = "Pasaport No boş bırakılamaz";
    }elseif(!str_starts_with($_POST["passportNo"], "U")){
      $error = "Pasaport No, U ile başlamalıdır ve toplamda 9 karakter içerebilir.";
    }else{
      $passportNo = $others->control_input($_POST["passportNo"]);
    }

    // validation country
    if(empty(trim($_POST["country"]))){
      $error = "Ülke boş bırakılamaz";
    }else{
      $country = $others->control_input($_POST["country"]);
    }

    // validation gender
    if(empty(trim($_POST["gender"]))){
      $error = "Cinsiyet boş bırakılamaz";
    }else{
      $gender = $others->control_input($_POST["gender"]);
    }

    // validation phone
    if(empty(trim($_POST["phone"]))){
      $error = "Telefon boş bırakılamaz";
    }elseif(strlen(trim($_POST["phone"])) != 11){
      $error = "Telefon toplamda 11 karakter içerebilir.";
    }else{
      $phone = $others->control_input($_POST["phone"]);
    }

    // validation email
    if(empty(trim($_POST["email"]))){
      $error = "Email boş bırakılamaz";
    }elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
      $error = "Hatalı email girdiniz.";
    }else{
      $email = $others->control_input($_POST["email"]);
    }

    // validation heavy
    $heavy = $_POST["heavy"];

    // validation height
    $height = $_POST["height"];

    // validation episode
    if(empty(trim($_POST["episode"]))){
      $error = "Bölüm boş bırakılamaz";
    }else{
      $episode = $others->control_input($_POST["episode"]);
    }

    // validation entryDate
    $checked = date("Y-m-d", strtotime($_POST["entryDate"]));
    if($checked == "1970-01-01"){
      $entryDate = "";
    }elseif($checked > date("Y-m-d")){
      $error = "Giriş tarihi, şimdiki tarihten büyük olamaz";
    }else{
      $entryDate = $others->control_input($checked);
    }

    // validation endDate
    $checked = date("Y-m-d", strtotime($_POST["endDate"]));
    if($checked == "1970-01-01"){
      $endDate = "";
    }elseif($checked > date("Y-m-d")){
      $error = "Çıkış tarihi, şimdiki tarihten büyük olamaz";
    }else{
      $endDate = $others->control_input($checked);
    }

    // validation protocolNo
    $protocolNo = $others->control_input($_POST["protocolNo"]);

    // validation description
    if(empty(trim($_POST["description"]))){
      $error = "Açıklama boş bırakılamaz";
    }else{
      $description = $others->control_input($_POST["description"]);
    }

    // validation situation
    $situation = $others->control_input($_POST["situation"]);

    // validation job
    $job = $others->control_input($_POST["job"]);

    // validation currency
    $currency = $others->control_input($_POST["currency"]);

    // validation price
    $price = $others->control_input($_POST["price"]);

    if(empty($error)){
      if($patients->editPatient($patient["id"],$nameSurname,$hospitalName,
        $birtday,$passportNo,$country,$gender,$phone,$email,$heavy,$height,
        $episode,$entryDate,$endDate,$protocolNo,$description,$situation,
        $job,$currency,$price,$attendantNameSurname,$attendantBirtday,$attendantPassportNo,$attendantCountry,$attendantPhone,$attendantEmail)){
          
        header("Location: patient-list.php");
      }else{
        $error = "Hasta ekleme hatası";
      }
    }


  }

?>

<?php require "views/_head-start.php"; ?>

<div id="admin-home" class="d-flex">

  <?php include "views/_admin-menu.php"; ?>

  <div class="admin-dashboard w-100">

    <?php require "views/_admin-top.php"; ?>

    <div class="bg-secondary h-100 py-5">
      <div class="container">

        <div class="card">
          <div class="card-body">
            <h3 class="text-center">Hasta Düzenle</h3>

            <?php if(!empty($error)): ?>
              <div class="alert alert-danger">
                <?php echo $error; ?>
              </div>
            <?php endif; ?> 

            <form method="POST">

              <!-- attendant -->
              <div id="attendant" class="card my-3">
                <div class="card-header">Refakatçi Düzenle</div>
                <div class="d-flex p-2 gap-3 flex-wrap">
                  <div class="mb-3">
                    <label for="attendantNameSurname" class="form-label">Refakatçi Adı Soyadı:</label>
                    <input type="text" name="attendantNameSurname" class="form-control" value="<?php echo $attendantNameSurname; ?>">
                  </div>
                  <div class="mb-3">
                    <label for="attendantBirtday" class="form-label">Refakatçi Doğum Tarihi:</label>
                    <input type="date" name="attendantBirtday" class="form-control" value="<?php echo $attendantBirtday; ?>">
                  </div>
                  <div class="mb-3">
                    <label for="attendantPassportNo" class="form-label">Refakatçi Pasaport No:</label>
                    <input type="text" name="attendantPassportNo" class="form-control" value="<?php echo $attendantPassportNo; ?>">
                  </div>
                  <div class="mb-3">
                    <label for="attendantCountry" class="form-label">Refakatçi Ülke:</label>
                    <input type="text" name="attendantCountry" class="form-control" value="<?php echo $attendantCountry; ?>">
                  </div>
                  <div class="mb-3">
                    <label for="attendantPhone" class="form-label">Refakatçi Telefon:</label>
                    <input type="text" name="attendantPhone" class="form-control" value="<?php echo $attendantPhone; ?>">
                  </div>
                  <div class="mb-3">
                    <label for="attendantEmail" class="form-label">Refakatçi Email:</label>
                    <input type="text" name="attendantEmail" class="form-control" value="<?php echo $attendantEmail; ?>">
                  </div>
                </div>
              </div>
              <hr> 

              <div>
                <div class="d-flex flex-wrap gap-md-5 gap-sm-3">
                  <div class="mb-3">
                    <label for="nameSurname" class="form-label">Adı Soyadı:</label>
                    <input type="text" name="nameSurname" class="form-control" value="<?php echo $nameSurname; ?>">
                  </div>
                  <div class="mb-3">
                    <label for="hospitalName" class="form-label">Hastane Adı:</label>
                    <input type="text" name="hospitalName" class="form-control" value="<?php echo $hospitalName; ?>">
                  </div>
                  <div class="mb-3">
                    <label for="birtday" class="form-label">Doğum Tarihi:</label>
                    <input type="date"name="birtday" class="form-control" value="<?php echo $birtday; ?>">
                  </div>
                  <div class="mb-3">
                    <label for="passportNo" class="form-label">Pasaport No:</label>
                    <input type="text" name="passportNo" class="form-control" value="<?php echo $passportNo; ?>">
                  </div>
                  <div class="mb-3">
                    <label for="country" class="form-label">Ülke:</label>
                    <input type="text" name="country" class="form-control" value="<?php echo $country; ?>">
                  </div>
                  <div class="mb-3">
                    <label for="gender" class="form-label">Cinsiyet:</label>
                    <input type="text" name="gender" class="form-control" value="<?php echo $gender; ?>">
                  </div>
                  <div class="mb-3">
                    <label for="phone" class="form-label">Telefon:</label>
                    <input type="text" name="phone" class="form-control" value="<?php echo $phone; ?>">
                  </div>
                  <div class="mb-3">
                    <label for="email" class="form-label">Mail:</label>
                    <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                  </div>
                  <div class="mb-3">
                    <label for="heavy" class="form-label">Kilo:</label>
                    <input type="text" name="heavy" class="form-control" value="<?php echo $heavy; ?>">
                  </div>
                  <div class="mb-3">
                    <label for="height" class="form-label">Boy:</label>
                    <input type="text" name="height" class="form-control" value="<?php echo $height; ?>">
                  </div>
                  <div class="mb-3">
                    <label for="episode" class="form-label">Bölüm:</label>
                    <input type="text" name="episode" class="form-control" value="<?php echo $episode; ?>">
                  </div>
                  <div class="mb-3">
                    <label for="entryDate" class="form-label">Hasta Giriş Tarihi:</label>
                    <input type="date" name="entryDate" class="form-control" value="<?php echo $entryDate; ?>">
                  </div>
                  <div class="mb-3">
                    <label for="endDate" class="form-label">Hasta Çıkış Tarihi:</label>
                    <input type="date" name="endDate" class="form-control" value="<?php echo $endDate; ?>">
                  </div>
                  <div class="mb-3">
                    <label for="protocolNo" class="form-label">Protokol No:</label>
                    <input type="text" name="protocolNo" class="form-control" value="<?php echo $protocolNo; ?>">
                  </div>
                  <div class="mb-3">
                    <label for="description" class="form-label">Açıklama:</label>
                    <textarea type="text" name="description" class="form-control"><?php echo $description; ?></textarea>
                  </div>
                  <div class="mb-3">
                    <label for="situation" class="form-label">Durum:</label>
                    <select class="form-select" name="situation" aria-label="Default select example">
                      <option value="Bekleniyor" <?php if($situation=="Bekleniyor"){ echo "selected"; } ?>>Bekleniyor</option>
                      <option value="Giriş yapacak" <?php if($situation=="Giriş yapacak"){ echo "selected"; } ?>>Giriş yapacak</option>
                      <option value="Tedavisi devam ediyor" <?php if($situation=="Tedavisi devam ediyor"){ echo "selected"; } ?>>Tedavisi devam ediyor</option>
                      <option value="Ayakta tedavi oldu" <?php if($situation=="Ayakta tedavi oldu"){ echo "selected"; } ?>>Ayakta tedavi oldu</option>
                      <option value="Çıkış yapacak" <?php if($situation=="Çıkış yapacak"){ echo "selected"; } ?>>Çıkış yapacak</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="job" class="form-label">Meslek:</label>
                    <input type="text" name="job" class="form-control" value="<?php echo $job; ?>">
                  </div>
                  <div class="mb-3">
                    <label for="currency" class="form-label">Döviz:</label>
                    <select class="form-select" name="currency" aria-label="Default select example">
                      <option value="₺" <?php if($currency=="₺"){ echo "selected"; } ?>>₺</option>
                      <option value="$" <?php if($currency=="$"){ echo "selected"; } ?>>$</option>
                      <option value="€" <?php if($currency=="€"){ echo "selected"; } ?>>€</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="price" class="form-label">Tedavi Fiyatı:</label>
                    <input type="text" name="price" class="form-control" value="<?php echo $price; ?>">
                  </div>
                </div>

                <button type="submit" name="editPatient" class="btn btn-primary">Düzenle</button>
              </div>

            </form>
          </div>
        </div>

        
      </div>
    </div>

  </div>

</div>


<?php require "views/_head-finish.php"; ?>