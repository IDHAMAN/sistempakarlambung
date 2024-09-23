<?php 
include 'function.php';
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 2) {
        header("location: indexPakar.php");
    } else if ($_SESSION['role'] == 1) {
        header("location: test.php");
    }
} 

?>
<!DOCTYPE html>
<html lang="en">

<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="custom.css" />

<!--Font-->
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,700&display=swap"rel="stylesheet"/>
<script src="https://kit.fontawesome.com/yourcode.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<title>Cek Lambung !</title>
</head>

<body>
<div class="container">
    <div class="card text-center">
        <div class="card-title">
            <h1 class="card-title">Halaman Registrasi</h1>
        </div>
        <div class="card-body ">
            <form id="registrationForm" method="POST" action="function.php?act=register" class="needs-validation" novalidate>
                <div class="form-row">
                    <div class="col">
                        <label class="papan" for="Username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                        <div class="valid-feedback">
                            Bagus!
                        </div>
                        <div class="invalid-feedback">
                            Username tidak boleh kosong
                        </div>
                    </div>
                    <div class="col">
                        <label class="papan" for="nama">Nama Pasien</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" required pattern="[A-Za-z\s]+" title="Nama tidak boleh mengandung angka">
                        <div class="valid-feedback">
                            Bagus!
                        </div>
                        <div class="invalid-feedback">
                            Nama tidak boleh kosong dan tidak boleh mengandung angka
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <label class="papan" for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                        <div class="valid-feedback">
                            Bagus!
                        </div>
                        <div class="invalid-feedback">
                            Email tidak valid
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <label class="papan" for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" minlength="8" placeholder="Password" required>
                        <div class="valid-feedback">
                            Bagus!
                        </div>
                        <div class="invalid-feedback">
                            Password min. 8 karakter
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <label class="papan" for="alamat">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" required>
                        <div class="valid-feedback">
                            Bagus!
                        </div>
                        <div class="invalid-feedback">
                            Alamat tidak boleh kosong
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <label class="papan" for="tgl_lahir">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" required>
                        <div class="invalid-feedback">
                            Masukkan Tahun Lahir
                        </div>
                    </div>
                </div>
                <button type="submit" name="submitButton" id="submitButton" class="registerbtn btn btn-primary">Register</button>
                <br>
                <div class="container signin">
                    <p>Sudah punya akun? <a href="indexAdmin.php">Log In</a></p>
                <!-- Modal -->
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Optional JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Set maximum date for Tanggal Lahir to today's date
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('tgl_lahir').setAttribute('max', today);

    // Bootstrap validation
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
});
</script>
</body>

</html>
