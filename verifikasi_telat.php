<?php 
session_start() ;
include('conn/koneksi.php');
?>

<?php 
    if(isset($_POST["verify"])){
        $email = $_SESSION['mail'];
        $otp_code = $_POST['otp_code'];
        $otp = $_SESSION['otp'];

        if($otp != $otp_code){
                echo "<script>alert('Kode verifikasi salah!')</script>";
        }else{
            mysqli_query($koneksi, "UPDATE masyarakat SET verif = 1 WHERE email = '$email'");
            ?>
            <script>
                echo "alert('Selamat, akun anda telah diverifikasi')";
                window.location.replace("cek.php");
            </script>
            <?php
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Verifikasi Telat</title>
    <link rel="stylesheet" href="css/verifikasi.css">
    <link rel="stylesheet" href="css/all.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/main.js"></script>
    <link rel="icon" href="../image/otp.png">
</head>

<body>
    <div class="box">
        <div class="form">
            <form action="#" method="POST">
                <h2>Silahkan masukkan kode verifikasi telat anda</h2>
                    <div class="inputBox">
                        <input type="text" id="otp" name="otp_code" required="required" autocomplete="off" autofocus>
                        <span>Kode Verifikasi</span>
                        <i></i>
                    </div>
                    <br>
                    <input type="submit" value="Verifikasi" name="verify">
                    <br>
                </form>
        </div>
    </div>
</body>