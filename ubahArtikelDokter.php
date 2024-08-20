<?php


include "function.php";
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 1) {
        header("location: halaman.php");
    }
} else {
    header("location:index.php");
}

$id_artikel = $_GET["id_artikel"];

$queryArtikel = mysqli_query($koneksi, "SELECT * FROM artikel WHERE id_artikel = '$id_artikel'");
$artikel = mysqli_fetch_assoc($queryArtikel);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="styles.css">
    <link
        rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
        crossorigin="anonymous"/>
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:300,400,700&display=swap"
        rel="stylesheet"/>
</head>

<body >
<div class="kiri">
        <section class="logo">
            <img src="gambar/logo sistem.png" alt="logo" height="150px" />
        </section>
        <div class="sidebar-heading">
            <h5 class="font-weight-bold text-white text-uppercase teks">Gejala & Penyakit</h5> 
        </div>
        <section class="isi">
            <a class="nav-link" href="indexPenyakitDokter.php">
            <span>Data Penyakit</span>
            </a>
        </section>
        <section class="isi">
            <a class="nav-link" href="indexGejalaDokter.php">
            <span>Data Gejala</span>
            </a>
        </section>
        <section class="isi">
            <a class="nav-link" href="indexRelasiDokter.php">
            <span>Relasi</span>
            </a>
        </section>
        <div class="sidebar-heading">
            <h5 class="font-weight-bold text-white text-uppercase teks">Solusi</h5> 
        </div>
        <section class="isi">
            <a class="nav-link" href="indexSolusiDokter.php">
            <span>Data Solusi</span>
            </a>
        </section>
        <section class="isi">
            <a class="nav-link" href="indexArtikelDokter.php">
            <span>Data Artikel</span>
            </a>
        </section>
        <section class="isi">
            <a class="nav-link" href="logout.php">
            <span>Logout</span>
            </a>
        </section>
    </div>
    <div class="kanan">
        <div class="container-fluid">

        <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Ubah Isi Artikel </h1>
            </div>

        <!-- Content Row -->
        <div class="row">
            <form action="function.php?act=ubahArtikelDokter&id_artikel=<?= $artikel['id_artikel']; ?>" id="ubah" method="POST">
                    <div class="form-group">
                        <label for="judulArtikel">Judul Artikel</label>
                        <input type="text" class="form-control" id="judulArtikel" name="judulArtikel" value="<?= $artikel['judul']; ?>"">
                    </div>
                    <div class="form-group">
                        <label for="isiArtikel">Isi Artikel</label>
                        <textarea name="isiArtikel" id='isi_Artikel' class="form-control" placeholder="Isi Artikel" rows="8" cols="80"><?php $artikel['isi']; ?></textarea>
                    </div>
                    <input type="submit" name="ubah_btn" id="ubah" class="btn btn-primary" value="Ubah">
                </form>

        </div>
    </div>
</body>
</html>
