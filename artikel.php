<!DOCTYPE html>
<html lang="en">
<head>
  <title>ARTIKEL</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="modul/ckeditor_4.24.0/ckeditor/ckeditor.js"></script>
</head>
<body>

<div class="container-fluid p-5 bg-primary text-white text-center">
  <h1>ARTIKEL PENYAKIT LAMBUNG</h1>
</div>
  
<div class="container mt-5">
  <div class="row">
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
                        <a class="btn px-4 btn-primary ml-2" href="halaman.php" role="button"
                    >Kembali</a>
                    </li>

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
        </div>
    </nav>
<?php
include ("function.php");
if (isset($_GET["id_artikel"])) {
    $id_artikel = $_GET["id_artikel"];
}
else {
    $id_artikel = 0;
}
$sql = "SELECT * FROM artikel where id_artikel=$id_artikel";
$hasil = mysqli_query($koneksi, $sql);

$jmlArtikel = mysqli_num_rows($hasil);
if ($jmlArtikel > 0) {
    while ($row = mysqli_fetch_assoc($hasil)){
?>

    <div class="col-sm-12">
      <h3><?= $row["judul"]; ?> </h3>

      <p>
        <?php
       echo $row["isi"];
        ?>

      </p>
    </div>
<?php
    }
}
?>
  </div>
</div>

</body>
</html>
