<?php 
  require "libs/functions.php";

  $username = $password = $error = "";

  if($users->isAdmin()){
    header("Location: admin.php");
    exit;
  }

  if(isset($_POST["login"])){

    if(empty($_POST["username"])){
      $error = "Kullanıcı adı boş bırakılamaz";
    }else{
      $username = trim($_POST["username"]);
    }

    if(empty($_POST["password"])){
      $error = "Parola boş bırakılamaz";
    }else{
      $password = strval(trim($_POST["password"]));
    }

    if(empty($error)){
      if($username == "admin" && $password == "123456"){
        setcookie("admin", true, time() + 3600 * 30);
        header("Location: admin.php");
      }else{
        $error = "Kullanıcı adı veya parola hatalı";
      }
    }

  }

?>

<?php require "views/_head-start.php"; ?>

<div id="login">
  <div class="position-relative">
    <img style="height: 100vh;" width="100%;" src="img/login.jpg" alt="">
    <form method="POST">
      <div class="login-content">
        <div class="logo-title">
          <h1>LOGO</h1>
        </div>

        <?php if(!empty($error)): ?>
          <div class="alert alert-danger">
            <?php echo $error; ?>
          </div>
        <?php endif; ?>  

        <div class="login-inputs d-flex justify-content-center align-items-center my-5 gap-3 flex-wrap">
          <div class="d-flex border-bottom border-danger">
            <i class="fas fa-user"></i>
            <input type="text" name="username" class="form-control border-0"
            value="<?php echo $username; ?>">
          </div>
          <div class="d-flex border-bottom border-danger">
            <i class="fas fa-key"></i>
            <input type="password" name="password" class="form-control border-0"
            value="<?php echo $password; ?>">
          </div>
        </div>
        
        <div>
          <button type="submit" name="login" class="btn btn-outline-danger"><i class="fas fa-sign-in"></i></button>
        </div>
      </div>
    </form>
  </div>
</div>

<?php require "views/_head-finish.php"; ?>