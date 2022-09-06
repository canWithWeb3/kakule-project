

<?php 
  require "libs/functions.php";

  if(!$users->isAdmin()){
    header("Location: index.php");
    exit;
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
            <div class="patient-top">
              <div class="d-flex justify-content-between">
                <h3>Protokol Hasta Listesi</h3>
                <a href="add-patient.php" class="btn btn-info text-white">Yeni Hasta Ekle</a>
              </div>
            </div>

            <table class="table table-striped my-5">
              <thead>
                <tr>
                  <th>HASTA ADI</th>
                  <th>DURUM</th>
                  <th>İŞLEM</th>
                </tr>
              </thead>
              <tbody>
                <?php $getPatients = $patients->getPatients(); ?>
                <?php while($patient = mysqli_fetch_assoc($getPatients)): ?>
                  <?php if($patient["situation"] == "Tedavisi devam ediyor"): ?>
                    <tr>
                      <td><?php echo $patient["nameSurname"]; ?></td>
                      <td><?php echo $patient["situation"]; ?></td>
                      <td>
                        <a href="edit-patient.php?id=<?php echo $patient["id"]; ?>" class="btn btn-warning btn-sm me-3"><i class="fas fa-search-plus"></i></a>
                        <a href="delete-patient.php?id=<?php echo $patient["id"]; ?>" class="btn btn-danger btn-sm"><i class="fas fa-times"></i></a>
                      </td>
                    </tr>
                  <?php endif; ?>
                <?php endwhile; ?>
              </tbody>
            </table>
          </div>
        </div>

        
      </div>
    </div>

  </div>

</div>

<?php require "views/_head-finish.php"; ?>