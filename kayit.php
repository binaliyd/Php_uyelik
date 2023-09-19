<?php

include("baglanti.php");

$username_err = "";
$email_err = "";
$parola_err = "";
$parolatkr_err = "";
if (isset($_POST["kaydet"])) {

  //kullanıcı adı sorgulama
  if (empty($_POST["kullanici_adi"])) {
    $username_err = "Kullanıcı adı boş geçilemez.";
  } else if (strlen($_POST["kullanici_adi"]) < 6) {
    $username_err = "Kullanıcı adı en az 6 karekterden oluşmalı.";
  } else if (preg_match('/^[a-z\d_]{5,20}$/i', $_POST["kullanici_adi"])) {
    $username_err = "Kullanıcı adı büyük küçük harf ve rakamlar içermelidir.";
  } else {
    $username = $_POST["kullanici_adi"];
  }



  //email sorgulama
  if (empty($_POST["email"])) {
    $email_err = "Email alanı boş geçilemez.";
  } else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    $email_err = "Geçersiz email formatı.";
  } else {
    $email = $_POST["email"];
  }


  //parola doğrulama kısmı
  if (empty($_POST["parola"])) {
    $parola_err = "Parola boş geçilemez.";
  } else {
    $parola = password_hash($_POST["parola"], PASSWORD_DEFAULT);
  }


  //Parola tekrar sorgulama
  if (empty($_POST["parolatkr"])) {
    $parolatkr_err = "Parola tekrar kısmı boş geçilemez.";
  } else if ($_POST["parola"] != $_POST["parolatkr"]) {
    $parolatkr_err = "Parolalar eşleşmiyor.";
  } else {
    $parolatkr = $_POST["parolatkr"];
  }




if(isset($username) && isset($email) && isset($parola))

{




  $ekle = "INSERT INTO kullanicilar (kullanici_adi, email, parola) VALUES ('$username', '$email', '$parola')";
  $calistirekle = mysqli_query($baglanti, $ekle);

  if ($calistirekle) {
    echo '<div class="alert alert-success" role="alert">
    Kayıt Başarılı Bir Şekilde Yapıldı  
    </div>';
  } else {
    echo '<div class="alert alert-danger" role="alert">
    Kayıt eklenirken bir problem oluştu.
    </div>';
  }
  mysqli_close($baglanti);
}
}

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <title>Üye Kayıt</title>
</head>

<body>

  <div class="container p-5">
    <div class="card p-5 ">

      <form action="kayit.php" method="post">

        <div class="form-group">
          <label for="exampleInputEmail1">Kullanıcı Adı</label>
          <input type="text"  class="form-control
    
    <?php
    if (!empty($username_err)) {
      echo "is-invalid";
    }
    ?>
    
    " id="exampleInputEmail1" name="kullanici_adi">
          <div class="invalid-feedback">
            <?php

            echo $username_err;

            ?>
          </div>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">E-mail</label>
          <input type="email"  class="form-control 
          
          <?php
          if (!empty($email_err)) {
            echo "is-invalid";
          }
          ?>
          
          " id="exampleInputEmail1" name="email">
          <div class="invalid-feedback">
            <?php
            echo $email_err;
            ?>
          </div>
        </div>

        <div class="form-group">
          <label for="exampleInputPassword1">Parola</label>
          <input type="password"  class="form-control 
          
          <?php
          if (!empty($parola_err)) {
            echo "is-invalid";
          }
          ?>

          " id="exampleInputPassword1" name="parola">
          <div class="invalid-feedback">
            <?php
            echo $parola_err;
            ?>
          </div>
        </div>


        <div class="form-group">
          <label for="exampleInputPassword1">Parolatkr</label>
          <input type="password"  class="form-control 
          
          <?php
          if (!empty($parolatkr_err)) {
            echo "is-invalid";
          }
          ?>
          
          " id="exampleInputPassword1" name="parolatkr">
          <div class="invalid-feedback">
            <?php
            echo $parolatkr_err;
            ?>
          </div>
        </div>



        <button type="submit" name="kaydet" class="btn btn-primary">KAYDET</button>
      </form>

    </div>
  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
