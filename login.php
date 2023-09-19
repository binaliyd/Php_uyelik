<?php

include("baglanti.php");

$username_err = "";
$parola_err = "";
if (isset($_POST["giris"])) {

    //kullanıcı adı sorgulama
    if (empty($_POST["kullaniciadi"])) {
        $username_err = "Kullanıcı adı boş geçilemez.";
    }



    //parola doğrulama kısmı
    if (empty($_POST["parola"])) {
        $parola_err = "Parola boş geçilemez.";
    } else {
        $parola = $_POST["parola"];
    }




    if (isset($username) && isset($parola)) {

        $secim = "SELECT * FROM kullanicilar WHERE kullanici_adi = $username";
        $calistir = mysqli_query($baglanti, $secim);
        $kayitsayisi = mysqli_num_rows($calistir); //  ya sıfır ya birdir 1-0

        if ($kayitsayisi > 0) {
            $ilgilikayit = mysqli_fetch_assoc($calistir);
            $hashlisifre = $ilgilikayit["parola"];

            if (password_verify($parola, $hashlisifre)) {
                session_start();
                $_SESSION["kullanici_adi"] = $ilgilikayit["kullanici_adi"];
                $_SESSION["email"] = $ilgilikayit["email"];
                header("location:profile.php");
            } else {
                echo '<div class="alert alert-danger" role="alert">
    Parola Yanlış
    </div>';
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">
    Kullanıcı Adı yanlış
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

    <title>Üye Giriş</title>
</head>

<body>

    <div class="container p-5">
        <div class="card p-5 ">

            <form action="login.php" method="POST">

                <div class="form-group">
                    <label for="exampleInputEmail1">Kullanıcı Adı</label>
                    <input type="text" autocomplete="off" class="form-control
    
    <?php
    if (!empty($username_err)) {
        echo "is-invalid";
    }
    ?>
    
    " id="exampleInputEmail1" name="kullaniciadi">
                    <div class="invalid-feedback">
                        <?php

                        echo $username_err;

                        ?>
                    </div>
                </div>



                <div class="form-group">
                    <label for="exampleInputPassword1">Parola</label>
                    <input type="password" autocomplete="off" class="form-control 
          
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



                <button type="submit" name="giris" class="btn btn-primary">GİEİŞ YAP</button>
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
