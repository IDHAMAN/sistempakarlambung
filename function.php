<?php
$koneksi = mysqli_connect('localhost', 'root', '', 'db_penyakitlambung');

if (mysqli_connect_errno()) {
    echo "Koneksi Database Gagal : " . mysqli_connect_error();
}

//
session_start();
if (isset($_GET["act"])) {
    $act = $_GET["act"];
    if ($act == "register") {
        register();
    } else if ($act == "login") {
        login();
    } else if ($act == "registerPakar") {
        registerPakar();
    } else if ($act == "tambahGejalaDokter") {
        tambahGejalaDokter(); 
    } else if ($act == "tambahGejala") {
        tambahGejala();
    } else if ($act == "tambahPenyakit") {
        tambahPenyakit();
    } else if ($act == "tambahPenyakitDokter") {
        tambahPenyakitDokter();
    } else if ($act == "tambahSolusiDokter") {
        tambahSolusiDokter(); 
    } else if ($act == "tambahSolusi") {
        tambahSolusi();
    } else if ($act == "tambahArtikelDokter") {
        tambahArtikelDokter();
    } else if ($act == "tambahArtikel") {
        tambahArtikel();
    } else if ($act == "tambahRelasiDokter") {
        tambahRelasiDokter(); 
    } else if ($act == "tambahRelasi") {
        tambahRelasi();
    } else if ($act == "hapusGejalaDokter") {
        $id_gejala = $_GET["id_gejala"];
        hapusGejalaDokter($id_gejala); 
    } else if ($act == "hapusGejala") {
        $id_gejala = $_GET["id_gejala"];
        hapusGejala($id_gejala);
    } else if ($act == "hapusPenyakitDokter") {
        $id_penyakit = $_GET["id_penyakit"];
        hapusPenyakitDokter($id_penyakit); 
    } else if ($act == "hapusPenyakit") {
        $id_penyakit = $_GET["id_penyakit"];
        hapusPenyakit($id_penyakit);
    } else if ($act == "hapusPasien") {
        $username = $_GET["username"];
        hapusPasien($username);
    } else if ($act == "hapusPakar") {
        $id_user = $_GET["id_user"];
        hapusPakar($id_user);
    } else if ($act == "hapusSolusiDokter") {
        $id_solusi = $_GET["id_solusi"];
        hapusSolusiDokter($id_solusi);
    } else if ($act == "hapusSolusi") {
        $id_solusi = $_GET["id_solusi"];
        hapusSolusi($id_solusi);
    } else if ($act == "hapusArtikelDokter") {
        $id_artikel = $_GET["id_artikel"];
        hapusArtikelDokter($id_artikel); 
    } else if ($act == "hapusArtikel") {
        $id_artikel = $_GET["id_artikel"];
        hapusArtikel($id_artikel); 
    } else if ($act == "hapusRelasiDokter") {
        $id_relasi = $_GET['id_relasi'];
        hapusRelasiDokter($id_relasi); 
    } else if ($act == "hapusRelasi") {
        $id_relasi = $_GET['id_relasi'];
        hapusRelasi($id_relasi);
    } else if ($act == "ubahGejalaDokter") {
        $id_gejala = $_GET["id_gejala"];
        ubahGejalaDokter($id_gejala); 
    } else if ($act == "ubahGejala") {
        $id_gejala = $_GET["id_gejala"];
        ubahGejala($id_gejala);
    } else if ($act == "ubahPasien") {
        $id_user = $_GET["id_user"];
        ubahPasien($id_user);
    } else if ($act == "ubahPakar") {
        $id_user = $_GET["id_user"];
        ubahPakar($id_user);
    } else if ($act == "ubahPenyakitDokter") {
        $id_penyakit = $_GET["id_penyakit"];
        ubahPenyakitDokter($id_penyakit); 
    } else if ($act == "ubahPenyakitDokter") {
        $id_penyakit = $_GET["id_penyakit"];
        ubahPenyakitDokter($id_penyakit); 
    } else if ($act == "ubahPenyakit") {
        $id_penyakit = $_GET["id_penyakit"];
        ubahPenyakit($id_penyakit);
    } else if ($act == "ubahSolusiDokter") {
        $id_solusi = $_GET["id_solusi"];
        ubahSolusiDokter($id_solusi); 
    } else if ($act == "ubahSolusi") {
        $id_solusi = $_GET["id_solusi"];
        ubahSolusi($id_solusi);
    }  else if ($act == "ubahArtikelDokter") {
        $id_artikel = $_GET["id_artikel"];
        ubahArtikelDokter($id_artikel);
    } else if ($act == "ubahArtikel") {
        $id_artikel = $_GET["id_artikel"];
        ubahArtikel($id_artikel);
    } else if($act == "ulang"){
        ulang();
    }
}

function ulang(){
    session_unset();
    session_destroy();
    header("location: test.php");
}

function register()
{
    global $koneksi;

    // Mengambil data dari form dengan aman menggunakan htmlspecialchars
    $username = htmlspecialchars($_POST['username']);
    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash(htmlspecialchars($_POST['password']), PASSWORD_DEFAULT);
    $alamat = htmlspecialchars($_POST['alamat']);
    $tgl_lahir = $_POST['tgl_lahir'];

    // Cek apakah username sudah ada di database
    $check_query = "SELECT * FROM user WHERE username = '$username'";
    $check_result = mysqli_query($koneksi, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        // Jika username sudah terdaftar, tampilkan notifikasi
        echo "<script>
            alert('Username sudah terdaftar! Silahkan gunakan username lain.');
            document.location.href = 'register.php';
        </script>";
        return; // Menghentikan eksekusi fungsi
    }

    // Query untuk memasukkan data ke database
    $query_user = "INSERT INTO user (username, role, nama, email, alamat, tgl_lahir, password) VALUES ('$username', '1', '$nama', '$email', '$alamat', '$tgl_lahir', '$password')";
    $exe = mysqli_query($koneksi, $query_user);

    // Cek apakah query berhasil dijalankan
    if (!$exe) {
        die('Query Error: ' . mysqli_errno($koneksi) . ' - ' . mysqli_error($koneksi));
    } else {
        echo "<script>
            alert('Berhasil Registrasi! Silahkan Login');
            document.location.href = 'index.php';
        </script>";
    }
}


function registerPakar()
{
    global $koneksi;
    $username = htmlspecialchars($_POST['username']);
    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash(htmlspecialchars($_POST['password']), PASSWORD_DEFAULT);
    $alamat = htmlspecialchars($_POST['alamat']);
    $tgl_lahir = $_POST['tgl_lahir'];

    // Cek apakah username sudah ada di database
    $check_query = "SELECT * FROM user WHERE username = '$username'";
    $check_result = mysqli_query($koneksi, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        // Jika username sudah terdaftar, tampilkan notifikasi
        echo "<script>
            alert('Username sudah terdaftar! Silahkan gunakan username lain.');
            document.location.href = 'register_pakar.php';
        </script>";
        return; // Menghentikan eksekusi fungsi
    }

    // Query untuk memasukkan data ke database
    $query_pakar = "INSERT INTO user VALUES ('$username','2','$nama', '$email', '$alamat', '$tgl_lahir','$password')";
    $exe = mysqli_query($koneksi, $query_pakar);

    // Cek apakah query berhasil dijalankan
    if (!$exe) {
        die('Query Error: ' . mysqli_errno($koneksi) . ' - ' . mysqli_error($koneksi));
    } else {
        echo "<script>
            alert('Berhasil Registrasi Dokter! Silahkan Login');
            document.location.href = 'indexAdmin.php';
        </script>";
    }
}

function login() {
    global $koneksi;
    $username = htmlspecialchars($_POST["username"]);
    $input_pass = htmlspecialchars($_POST['password']);
    $query = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");
    $data = mysqli_fetch_assoc($query);

    if($data) {
        $password = $data['password'];
        $role = $data['role'];

        if(password_verify($input_pass, $password)) {
            if($role == "1") {
                $_SESSION['role'] = 1;
                echo "<script>
                    document.location.href = 'test.php';
                    </script>";
            } elseif($role == "0") {
                $_SESSION['role'] = 0;
                echo "<script>
                    document.location.href = 'indexAdmin.php';
                    </script>";
            } elseif($role == "2") {
                $_SESSION['role'] = 2;
                echo "<script>
                    document.location.href = 'indexDokter.php';
                    </script>";
            }
        } else {
            echo "<script>
                alert('Password salah!');
                document.location.href = 'index.php';
                </script>";
        }
    } else {
        echo "<script>
            alert('Username tidak ditemukan!');
            document.location.href = 'index.php';
            </script>";
    }
}

function tambahGejalaDokter()
{
    global $koneksi;
    $gejala = htmlspecialchars($_POST['namaGejala']);
    $id_penyakit = htmlspecialchars($_POST['id_penyakit']);
    $queryGejala = "INSERT INTO gejala VALUES ('','$gejala')";
    
    $exe = mysqli_query($koneksi, $queryGejala);
    
    if (!$exe) {
        die('Error pada database');
    }   
        echo "<script>
        alert('Gejala berhasil ditambahkan');
        document.location.href = 'indexGejalaDokter.php'</script>";
}

function tambahGejala()
{
    global $koneksi;
    $gejala = htmlspecialchars($_POST['namaGejala']);
    $id_penyakit = htmlspecialchars($_POST['id_penyakit']);
    $queryGejala = "INSERT INTO gejala VALUES ('','$gejala')";
    
    $exe = mysqli_query($koneksi, $queryGejala);
    
    if (!$exe) {
        die('Error pada database');
    }   
        echo "<script>
        alert('Gejala berhasil ditambahkan');
        document.location.href = 'indexGejala.php'</script>";
}

function tambahPenyakitDokter()
{
    global $koneksi;
    $penyakit = htmlspecialchars($_POST['namaPenyakit']);
    $queryPenyakit = "INSERT INTO penyakit VALUES ('','$penyakit')";
    $exe = mysqli_query($koneksi, $queryPenyakit);
    if (!$exe) {
        die('Error pada database');
    }
            echo "<script>
            alert('Penyakit berhasil ditambahkan');
            document.location.href = 'indexPenyakitDokter.php'</script>";
}

function tambahPenyakit()
{
    global $koneksi;
    $penyakit = htmlspecialchars($_POST['namaPenyakit']);
    $queryPenyakit = "INSERT INTO penyakit VALUES ('','$penyakit')";
    $exe = mysqli_query($koneksi, $queryPenyakit);
    if (!$exe) {
        die('Error pada database');
    }
            echo "<script>
            alert('Penyakit berhasil ditambahkan');
            document.location.href = 'indexPenyakit.php'</script>";
}

function tambahSolusiDokter()
{
    global $koneksi;
    $solusi = htmlspecialchars($_POST['namaSolusi']);
    $id_penyakit = htmlspecialchars($_POST['id_penyakit']);
    $querySolusi = "INSERT INTO solusi VALUES ('', '$id_penyakit', '$solusi')";
    $exe = mysqli_query($koneksi, $querySolusi);
    if (!$exe) {
        die('Error pada database');
    }
            echo "<script>
            alert('Solusi berhasil ditambahkan');
            document.location.href = 'indexSolusiDokter.php'</script>";
}

function tambahSolusi()
{
    global $koneksi;
    $solusi = htmlspecialchars($_POST['namaSolusi']);
    $id_penyakit = htmlspecialchars($_POST['id_penyakit']);
    $querySolusi = "INSERT INTO solusi VALUES ('', '$id_penyakit', '$solusi')";
    $exe = mysqli_query($koneksi, $querySolusi);
    if (!$exe) {
        die('Error pada database');
    }
            echo "<script>
            alert('Solusi berhasil ditambahkan');
            document.location.href = 'indexSolusi.php'</script>";
}

function tambahArtikelDokter()
{
    global $koneksi;
    $artikel = htmlspecialchars($_POST['isi']);
    $id_artikel = htmlspecialchars($_POST['judul']);
    $queryArtikel = "INSERT INTO artikel VALUES ('', '$id_artikel', '$artikel')";
    $exe = mysqli_query($koneksi, $queryArtikel);
    if (!$exe) {
        die('Error pada database');
    }
            echo "<script>
            alert('Artikel berhasil ditambahkan');
            document.location.href = 'indexArtikelDokter.php'</script>";
}


function tambahArtikel()
{
    global $koneksi;
    $artikel = htmlspecialchars($_POST['isi']);
    $id_artikel = htmlspecialchars($_POST['judul']);
    $queryArtikel = "INSERT INTO artikel VALUES ('', '$id_artikel', '$artikel')";
    $exe = mysqli_query($koneksi, $queryArtikel);
    if (!$exe) {
        die('Error pada database');
    }
            echo "<script>
            alert('Artikel berhasil ditambahkan');
            document.location.href = 'indexArtikel.php'</script>";
}

function tambahRelasiDokter()
{
    global $koneksi;
    $id_gejala = htmlspecialchars($_POST['id_gejala']);
    $id_penyakit = htmlspecialchars($_POST['id_penyakit']);

    $queryRelasi = "INSERT INTO relasi (id_gejala, id_penyakit) VALUES ('$id_gejala', '$id_penyakit')";
    $exe = mysqli_query($koneksi, $queryRelasi);
    
    if (!$exe) {
        die('Error pada database: ' . mysqli_error($koneksi));
    } else {
        // Jika sukses
        echo "<script>
        alert('Relasi berhasil ditambahkan');
        document.location.href = 'indexRelasiDokter.php';
        </script>";
    }
}


function tambahRelasi()
{
    global $koneksi;
    $id_gejala = htmlspecialchars($_POST['id_gejala']);
    $id_penyakit = htmlspecialchars($_POST['id_penyakit']);

    $queryRelasi = "INSERT INTO relasi (id_gejala, id_penyakit) VALUES ('$id_gejala', '$id_penyakit')";
    $exe = mysqli_query($koneksi, $queryRelasi);
    
    if (!$exe) {
        die('Error pada database: ' . mysqli_error($koneksi));
    } else {
        // Jika sukses
        echo "<script>
        alert('Relasi berhasil ditambahkan');
        document.location.href = 'indexRelasi.php';
        </script>";
    }
}

function ubahGejalaDokter($id_gejala)
{
    global $koneksi;
    $gejala = htmlspecialchars($_POST['namaGejala']);
    $queryGejala = "UPDATE gejala SET gejala = '$gejala' WHERE id_gejala = '$id_gejala'";
    $exe = mysqli_query($koneksi, $queryGejala);
    if (!$exe) {
        die('Error pada database');
    }
            echo "<script>
            alert('Data Gejala berhasil diubah!');
            document.location.href = 'indexGejalaDokter.php'</script>";
}

function ubahGejala($id_gejala)
{
    global $koneksi;
    $gejala = htmlspecialchars($_POST['namaGejala']);
    $queryGejala = "UPDATE gejala SET gejala = '$gejala' WHERE id_gejala = '$id_gejala'";
    $exe = mysqli_query($koneksi, $queryGejala);
    if (!$exe) {
        die('Error pada database');
    }
            echo "<script>
            alert('Data Gejala berhasil diubah!');
            document.location.href = 'indexGejala.php'</script>";
}

function ubahArtikelDokter($id_artikel)
{
    global $koneksi;

    $judul = htmlspecialchars($_POST['judulArtikel']);
    $isi = htmlspecialchars($_POST['isiArtikel']);

    $queryArtikel = "UPDATE Artikel SET judul = '$judul', isi = '$isi' WHERE id_artikel = '$id_artikel'";
    $artikel = mysqli_query($koneksi, $queryArtikel);

    if (!$artikel) {
        die('Error pada database: ' . mysqli_error($koneksi));
    }

    echo "<script>
            alert('Data Artikel berhasil diubah!');
            document.location.href = 'indexArtikelDokter.php';
          </script>";
}

function ubahArtikel($id_artikel)
{
    global $koneksi;

    $judul = htmlspecialchars($_POST['judulArtikel']);
    $isi = htmlspecialchars($_POST['isiArtikel']);

    $queryArtikel = "UPDATE Artikel SET judul = '$judul', isi = '$isi' WHERE id_artikel = '$id_artikel'";
    $artikel = mysqli_query($koneksi, $queryArtikel);

    if (!$artikel) {
        die('Error pada database: ' . mysqli_error($koneksi));
    }

    echo "<script>
            alert('Data Artikel berhasil diubah!');
            document.location.href = 'indexArtikel.php';
          </script>";
}

function ubahSolusiDokter($id_solusi)
{
    global $koneksi;
    $solusi = htmlspecialchars($_POST['namaSolusi']);
    $id_penyakit = htmlspecialchars($_POST['id_penyakit']);
    $querySolusi = "UPDATE solusi SET solusi_penyakit = '$solusi', id_penyakit = '$id_penyakit' WHERE id_solusi = '$id_solusi'";
    $exe = mysqli_query($koneksi, $querySolusi);
    if (!$exe) {
        die('Error pada database');
    }
            echo "<script>
            alert('Data Solusi berhasil diubah!');
            document.location.href = 'indexSolusiDokter.php'</script>";
}


function ubahSolusi($id_solusi)
{
    global $koneksi;
    $solusi = htmlspecialchars($_POST['namaSolusi']);
    $id_penyakit = htmlspecialchars($_POST['id_penyakit']);
    $querySolusi = "UPDATE solusi SET solusi_penyakit = '$solusi', id_penyakit = '$id_penyakit' WHERE id_solusi = '$id_solusi'";
    $exe = mysqli_query($koneksi, $querySolusi);
    if (!$exe) {
        die('Error pada database');
    }
            echo "<script>
            alert('Data Solusi berhasil diubah!');
            document.location.href = 'indexSolusi.php'</script>";
}

function ubahPenyakitDokter($id_penyakit)
{
    global $koneksi;
    $penyakit = htmlspecialchars($_POST['namaPenyakit']);
    $queryPenyakit = "UPDATE penyakit SET penyakit = '$penyakit' WHERE id_penyakit = '$id_penyakit'";
    $exe = mysqli_query($koneksi, $queryPenyakit);
    if (!$exe) {
        die('Error pada database');
    }
            echo "<script>
            alert('Data Penyakit berhasil diubah!');
            document.location.href = 'indexPenyakitDokter.php'</script>";
}

function ubahPenyakit($id_penyakit)
{
    global $koneksi;
    $penyakit = htmlspecialchars($_POST['namaPenyakit']);
    $queryPenyakit = "UPDATE penyakit SET penyakit = '$penyakit' WHERE id_penyakit = '$id_penyakit'";
    $exe = mysqli_query($koneksi, $queryPenyakit);
    if (!$exe) {
        die('Error pada database');
    }
            echo "<script>
            alert('Data Penyakit berhasil diubah!');
            document.location.href = 'indexPenyakit.php'</script>";
}

function ubahPasien($username)
{
    global $koneksi;
    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $tgl_lahir = htmlspecialchars($_POST['tgl_lahir']);
    $queryUser = "UPDATE user SET nama = '$nama', email = '$email', alamat = '$alamat', tgl_lahir = '$tgl_lahir' WHERE username = '$username'";
    $exe = mysqli_query($koneksi, $queryUser);
    if (!$exe) {
        die('Error pada database');
    }
            echo "<script>
            alert('Data Pasien berhasil diubah!');
            document.location.href = 'indexAdmin.php'</script>";
}

function ubahPakar($username)
{
    global $koneksi;
    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $tgl_lahir = htmlspecialchars($_POST['tgl_lahir']);
    
    $queryUser = "UPDATE user SET nama = '$nama', email = '$email', alamat = '$alamat', tgl_lahir = '$tgl_lahir' WHERE username = '$username'";
    
    $exe = mysqli_query($koneksi, $queryUser);
    if (!$exe) {
        die('Error pada database');
    }
            echo "<script>
            alert('Data Dokter berhasil diubah!');
            document.location.href = 'indexPakar.php'</script>";
}

function hapusGejalaDokter($id_gejala)
{
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM gejala WHERE id_gejala  = $id_gejala");
    $result = mysqli_affected_rows($koneksi);
    if ($result > 0) {
        echo "
        <script>
                alert('Gejala berhasil dihapus!');
                document.location.href = 'indexGejalaDokter.php';
            </script>	
        ";
    } else {
        echo "
        <script>
                alert('Gejala gagal dihapus, karena masih terikat dengan penyakit!');
                document.location.href = 'indexGejalaDokter.php';
            </script>	
        ";
    }
}

function hapusGejala($id_gejala)
{
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM gejala WHERE id_gejala  = $id_gejala");
    $result = mysqli_affected_rows($koneksi);
    if ($result > 0) {
        echo "
        <script>
                alert('Gejala berhasil dihapus!');
                document.location.href = 'indexGejala.php';
            </script>	
        ";
    } else {
        echo "
        <script>
                alert('Gejala gagal dihapus, karena masih terikat dengan penyakit!');
                document.location.href = 'indexGejala.php';
            </script>	
        ";
    }
}

function hapusPasien($username)
{
    global $koneksi;

    // Escape the username to prevent SQL Injection
    $username = mysqli_real_escape_string($koneksi, $username);

    // SQL query to delete the user with the specified username
    $query = "DELETE FROM user WHERE username = '$username'";

    mysqli_query($koneksi, $query);

    $result = mysqli_affected_rows($koneksi);

    if ($result > 0) {
        echo "
        <script>
                alert('Akun Pasien berhasil dihapus!');
                document.location.href = 'indexAdmin.php';
            </script>	
        ";
    } else {
        echo "
        <script>
                    alert('Akun Pasien gagal dihapus!');
                    document.location.href = 'indexAdmin.php';
            </script>	
        ";
    }
}


function hapusPakar($username)
{
    global $koneksi;

    // Escape the username to prevent SQL Injection
    $username = mysqli_real_escape_string($koneksi, $username);

    // SQL query to delete the user with the specified username
    $query = "DELETE FROM user WHERE username = '$username'";

    mysqli_query($koneksi, $query);

    $result = mysqli_affected_rows($koneksi);

    if ($result > 0) {
        echo "
        <script>
                alert('Akun Dokter berhasil dihapus!');
                document.location.href = 'indexAdmin.php';
            </script>	
        ";
    } else {
        echo "
        <script>
                    alert('Akun Dokter gagal dihapus!');
                    document.location.href = 'indexAdmin.php';
            </script>	
        ";
    }
}

function hapusPenyakitDokter($id_penyakit)
{
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM penyakit WHERE id_penyakit = $id_penyakit");
    $result = mysqli_affected_rows($koneksi);
    if ($result > 0) {
        echo "
        <script>
                alert('Penyakit berhasil dihapus!');
                document.location.href = 'indexPenyakitDokter.php';
            </script>	
        ";
    } else {
        echo "
        <script>
                    alert('Penyakit gagal dihapus, karena masih terikat dengan gejala!');
                    document.location.href = 'indexPenyakitDokter.php';
            </script>	
        ";
    }
}


function hapusPenyakit($id_penyakit)
{
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM penyakit WHERE id_penyakit = $id_penyakit");
    $result = mysqli_affected_rows($koneksi);
    if ($result > 0) {
        echo "
        <script>
                alert('Penyakit berhasil dihapus!');
                document.location.href = 'indexPenyakit.php';
            </script>	
        ";
    } else {
        echo "
        <script>
                    alert('Penyakit gagal dihapus, karena masih terikat dengan gejala!');
                    document.location.href = 'indexPenyakit.php';
            </script>	
        ";
    }
}

function hapusSolusiDokter($id_solusi)
{
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM solusi WHERE id_solusi = $id_solusi");
    $result = mysqli_affected_rows($koneksi);
    if ($result > 0) {
        echo "
        <script>
                alert('Solusi berhasil dihapus!');
                document.location.href = 'indexSolusiDokter.php';
            </script>	
        ";
    } else {
        echo "
        <script>
                    alert('Solusi gagal dihapus!');
                    document.location.href = 'indexSolusiDokter.php';
            </script>	
        ";
    }
}

function hapusSolusi($id_solusi)
{
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM solusi WHERE id_solusi = $id_solusi");
    $result = mysqli_affected_rows($koneksi);
    if ($result > 0) {
        echo "
        <script>
                alert('Solusi berhasil dihapus!');
                document.location.href = 'indexSolusi.php';
            </script>	
        ";
    } else {
        echo "
        <script>
                    alert('Solusi gagal dihapus!');
                    document.location.href = 'indexSolusi.php';
            </script>	
        ";
    }
}

function hapusArtikelDokter($id_artikel)
{
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM artikel WHERE id_artikel = $id_artikel");
    $result = mysqli_affected_rows($koneksi);
    if ($result > 0) {
        echo "
        <script>
                alert('Artikel berhasil dihapus!');
                document.location.href = 'indexArtikelDokter.php';
            </script>	
        ";
    } else {
        echo "
        <script>
                    alert('Artikel gagal dihapus!');
                    document.location.href = 'indexArtikelDokter.php';
            </script>	
        ";
    }
}

function hapusArtikel($id_artikel)
{
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM artikel WHERE id_artikel = $id_artikel");
    $result = mysqli_affected_rows($koneksi);
    if ($result > 0) {
        echo "
        <script>
                alert('Artikel berhasil dihapus!');
                document.location.href = 'indexArtikel.php';
            </script>	
        ";
    } else {
        echo "
        <script>
                    alert('Artikel gagal dihapus!');
                    document.location.href = 'indexArtikel.php';
            </script>	
        ";
    }
}

function hapusRelasiDokter($id_relasi)
{
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM relasi WHERE id_relasi = $id_relasi");
    $result = mysqli_affected_rows($koneksi);
    if ($result > 0) {
        echo "
        <script>
                alert('Relasi berhasil dihapus!');
                document.location.href = 'indexRelasiDokter.php';
            </script>	
        ";
    } else {
        echo "
        <script>
                    alert('Relasi gagal dihapus, karena masih terikat dengan gejala!');
                    document.location.href = 'indexRelasiDokter.php';
            </script>	
        ";
    }
}



function hapusRelasi($id_relasi)
{
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM relasi WHERE id_relasi = $id_relasi");
    $result = mysqli_affected_rows($koneksi);
    if ($result > 0) {
        echo "
        <script>
                alert('Relasi berhasil dihapus!');
                document.location.href = 'indexRelasi.php';
            </script>	
        ";
    } else {
        echo "
        <script>
                    alert('Relasi gagal dihapus, karena masih terikat dengan gejala!');
                    document.location.href = 'indexRelasi.php';
            </script>	
        ";
    }
}


function gejala($id_penyakit){
    global $koneksi;
    $query = "SELECT relasi.id_gejala as id_gejala FROM relasi INNER JOIN gejala ON relasi.id_gejala = gejala.id_gejala INNER JOIN penyakit ON relasi.id_penyakit = penyakit.id_penyakit WHERE relasi.id_penyakit = '$id_penyakit' ";
    $data = mysqli_query($koneksi, $query);
    // var_dump($data);
    $row = mysqli_fetch_assoc($data);
    
    return $row['id_gejala'];
    // echo "hasil". $row['id_gejala'];
}


?>
