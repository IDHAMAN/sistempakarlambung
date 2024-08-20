<?php 
include 'function.php';
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 0) {
        header("location: indexAdmin.php");
    } else if ($_SESSION['role'] == 2) {
        header("location: indexPakar.php");
    }
}

if(!isset($_SESSION['persentase'])){
    $_SESSION['persentase'] = [];
}


$gejala = mysqli_query($koneksi, "SELECT * FROM gejala");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
    rel="stylesheet"
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
    crossorigin="anonymous"/>
    <link
    href="https://fonts.googleapis.com/css?family=Poppins:300,400,700&display=swap"
    rel="stylesheet"/>
    <link rel="stylesheet" href="custom.css" />
    <title>DIAGNOSA LAMBUNG</title>
</head>
<body>
    <nav class="navbar py-2 navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#"
            ><img src="gambar/logo sistem.png" width="100" alt="logo"
            /></a>
            <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
            >
            <span class="navbar-toggler-icon"></span>
            </button>

            <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
            >
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li>
                        <a class="btn px-4 btn-primary ml-2" href="logout.php" role="button"
                    >Log Out</a>
                    </li>
                    
                </ul>
            </div>
        </div>
    </nav>

    <section class="test mt-5">
        <div class="container">
            <div class="row">
                <div class="col align-self-center">
                    <h2 class="mb-4">Pertanyaan : </h2>
                    <form action="" method="post" enctype="multipart/form-data" role="form">
                    <?php
                        $id_penyakit=1;
                        $id = gejala($id_penyakit);
                        $id_gejala = intval($id);
                        if(!isset($_SESSION['id_gejala'])){
                            $_SESSION['id_gejala'] = $id_gejala;
                        }else{
                            $id_gejala = $_SESSION['id_gejala'];
                        }
                        $data = mysqli_query($koneksi, "SELECT gejala FROM gejala WHERE id_gejala = '$id_gejala'");
                        $row = mysqli_fetch_assoc($data);
                    ?>
                    <p class="mb-4">
                        Apakah anda mengalami <?= $row ['gejala']; ?> ?
                    </p>
                    <?php 
                        echo'<input type="submit" class="btn btn-primary mr-2 px-4 py-2" name="ya" value="Ya">';
                        echo'<input type="submit" class="btn btn-danger px-3 py-2" name="tidak" value="Tidak">';
                        $persentase = $_SESSION['persentase'];
                        $temp = 0;
                        $_SESSION['id_gejala'] = $id_gejala;
                        $next_gejala = $_SESSION['id_gejala'];
                        if(isset($_POST['ya'])){
                            if(isset($id_gejala)){
                                $temp = $id_gejala;
                                array_push($persentase, $temp);
                            }
                            $_SESSION['persentase'] = $persentase;
                            $next_gejala = $id_gejala + 1;
                            $_SESSION['id_gejala'] = $next_gejala;
                        } 
                        else if(isset($_POST['tidak'])){
                            $next_gejala = $id_gejala + 1;
                            $_SESSION['id_gejala'] = $next_gejala;
                        }
                        if($_SESSION['id_gejala'] > 35) {
                        
                        // Aturan pada sistem pakar untuk mendiagnosa penyakit dari id gejala pada database
                        $gerd = array(2,4,7,11,15,18,20,21,23,24,27,28,32);
                        $gastritis = array(2,4,6,12,13,14,19,22,26,31);
                        $dispepsia = array(2,12,22,33);
                        $ulkusPeptikum = array(2,7,9,22,33,34);
                        $kolikAbdomen = array(1,3,7,10,15,16,19,22,28);
                        $kangkerLambung = array(1,2,3,4,6,7,9,11,12,13,17,18,19,20,28,29,31);
                        $appendicitis = array (1,3,5,6,7,13,14);
                        $gastroentiritis = array(1,3,4,5,13,14,16,17,22,25,31);
                        
                        

                        // Perhitungan dari gejala yang di pilih untuk menghasilkan hasil dari penaykit
                        $nilai = 0;
                        foreach ($persentase as $value) {
                            if (in_array($value, $gerd)) {
                                $nilai += 1;
                            }else{
                                $nilai += 0;
                            } 
                        }
                        $GErd = $nilai/count($gerd);
                        $gerd = number_format($GErd,3);
                        $hasilGErd = $gerd *100;
                        $_SESSION['gerd'] = $hasilGErd;
                        $nilai = 0;
                        foreach ($persentase as $value) {
                            if (in_array($value, $gastritis)) {
                                $nilai += 1;
                            }else{
                                $nilai += 0;
                            }
                        }
                        $Gastritis = $nilai/count($gastritis);
                        $GasTritis = number_format($Gastritis,3);
                        $hasilGastritis = $GasTritis *100;
                        $_SESSION['gastritis'] = $hasilGastritis;
                        $nilai = 0;
                        foreach ($persentase as $value) {
                            if (in_array($value, $dispepsia)) {
                                $nilai += 1;
                            }else{
                                $nilai += 0;
                            }
                        }
                        $Dispepsia = $nilai/count($dispepsia);
                        $disPepsia = number_format($Dispepsia,3);
                        $hasilDispepsia = $disPepsia *100;
                        $_SESSION['dispepsia'] = $hasilDispepsia;
                        $nilai = 0;
                        foreach ($persentase as $value) {
                            if (in_array($value, $ulkusPeptikum)) {
                                $nilai += 1;
                            }else{
                                $nilai += 0;
                            }
                        }
                        $UlkusPeptikum = $nilai/count($ulkusPeptikum);
                        $ulkus = number_format($UlkusPeptikum,3);
                        $hasilUlkusPeptikum = $ulkus *100;
                        $_SESSION['ulkuspeptikum'] = $hasilUlkusPeptikum;
                        $nilai = 0;
                        foreach ($persentase as $value) {
                            if (in_array($value, $kolikAbdomen)) {
                                $nilai += 1;
                            }else{
                                $nilai += 0;
                            }
                        }
                        $Kolikabdomen = $nilai/count($kolikAbdomen);
                        $Kolik = number_format($Kolikabdomen,3);
                        $hasilKolikabdomen = $Kolik *100;
                        $_SESSION['kolik abdomen'] = $hasilKolikabdomen;
                        $nilai = 0;
                        foreach ($persentase as $value) {
                            if (in_array($value, $kangkerLambung)) {
                                $nilai += 1;
                            }else{
                                $nilai += 0;
                            }
                        }
                        $KangkerLambung = $nilai/count($kangkerLambung);
                        $Kanker = number_format($KangkerLambung,3);
                        $hasilKankerLambung = $Kanker *100;
                        $_SESSION['kangkerlambung'] = $hasilKankerLambung;
                        $nilai = 0;
                        foreach ($persentase as $value) {
                            if (in_array($value, $appendicitis)) {
                                $nilai += 1;
                            }else{
                                $nilai += 0;
                            }
                        }
                        $Appendicitis = $nilai/count($appendicitis);
                        $AppenDicitis = number_format($Appendicitis,3);
                        $hasilAppendicitis = $AppenDicitis *100;
                        $_SESSION['appendicitis'] = $hasilAppendicitis;
                        $nilai = 0;
                        foreach ($persentase as $value) {
                            if (in_array($value, $gastroentiritis)) {
                                $nilai += 1;
                            }else{
                                $nilai += 0;
                            }
                        }
                        $Gastroentiritis = $nilai/count($gastroentiritis);
                        $ritis = number_format($Gastroentiritis,3);
                        $hasilGastroentiritis = $ritis *100;
                        $_SESSION['gastroentiritis'] = $hasilGastroentiritis;
                        header('Location:hasil.php');
                    }
                    ?>
                    <br>
                    
                </div>
                    </form>
                <div class="col d-none d-sm-block">
                    <img width="500" src="gambar/jawab.png" alt="hero" />
                </div>
            </div>
        </div>
    </section>
</body>

<script
    src="https://code.jquery.com/jquery-3.4.1.js"
    integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
    crossorigin="anonymous"
></script>
<script
    src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"
></script>
<script
    src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"
></script>
<script
    src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"
></script>
</html>