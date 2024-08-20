<?php 
include 'function.php';
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 0) {
        header("location: test.php");
    } 
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

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li>
                        <a class="btn px-2 py-2 btn-success ml-2" href="function.php?act=ulang" role="button">Cek Ulang</a>
                    </li>
                    <li>
                        <a class="btn px-2 py-2 btn-primary ml-2" href="logout.php" role="button"
                    >Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="hasil mt-4">
        <div class="container">
            <div class="row">
                <div class="col align-self-center">
                    <h3 class="mb-4">Penyakit yang anda alami : </h3>
                    <?php
                        if(isset($_SESSION)) {
                            $penyakit = [
                                "Gerd" => $_SESSION['gerd'],
                                "Gastritis" => $_SESSION['gastritis'],
                                "Dispepsia" => $_SESSION['dispepsia'],
                                "Ulkuspeptikum" => $_SESSION['ulkuspeptikum'],
                                "Kolik Abdomen" => $_SESSION['kolik abdomen'],
                                "Kangker Lambung" => $_SESSION['kangkerlambung'],
                                "Appendicitis" => $_SESSION['appendicitis'],
                                "Gastroentiritis" => $_SESSION['gastroentiritis']
                            ];
                            
                            // Urutkan penyakit berdasarkan persentase secara descending
                            arsort($penyakit);
                            
                            // Ambil 3 penyakit dengan persentase tertinggi
                            $penyakit_teratas = array_slice($penyakit, 0, 3, true);
                            
                            // Tampilkan hasil
                            foreach ($penyakit_teratas as $nama => $persentase) {
                                echo "<div class='py-1'><strong>$nama = $persentase%</strong></div>";
                            }
                        }
                    ?>                    
                    <h3 class="mb-4">Solusi untuk penyakit anda adalah : </h3>
                    <form action="" method="post" enctype="multipart/form-data" role="form">
                    <?php
                        function maximum($a, $b, $c, $d, $e, $f)
                        {
                            $max = $a;
                            $kode =1; 
                            if ($b> $max) { 
                            $max = $b;
                            $kode = 2;
                            } 
                            if ($c > $max) { 
                            $max = $c;
                            $kode = 3;
                            } 
                            if ($d > $max) { 
                            $max = $d;
                            $kode = 4;
                            } 
                            if ($e > $max) { 
                            $max = $e;
                            $kode = 5;
                            } 
                            if ($f > $max) { 
                            $max = $f;
                            $kode = 6;
                            } 
                            return $kode;
                        };
                        $id_penyakit = maximum($_SESSION['gerd'], $_SESSION['gastritis'], $_SESSION['dispepsia'], 
                        $_SESSION['ulkuspeptikum'], $_SESSION['kolik abdomen'], $_SESSION['kangkerlambung'], $_SESSION['appendicitis'], $_SESSION['gastroentiritis']);
                            $query = "SELECT * FROM solusi WHERE id_penyakit = '$id_penyakit'";
                            $data = mysqli_query($koneksi, $query);
                            while ($row = mysqli_fetch_array($data)) {
                            
                                echo '<p>' . $row['solusi_penyakit'] . '</p>';

                            }
                        // Ambil solusi untuk penyakit dengan persentase tertinggi
                        $penyakit_pertama = key($penyakit_teratas);
                        $query = "SELECT * FROM solusi WHERE solusi_penyakit = '$penyakit_pertama'";
                        $data = mysqli_query($koneksi, $query);
                        while ($row = mysqli_fetch_array($data)) {
                            echo '<p>' . $row['solusi_penyakit'] . '</p>';
                        }
                    ?>                    
                </div>
                    </form>
                <div class="col d-none d-sm-block">
                    <img width="500" src="gambar/hasil.png" alt="hero" />
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