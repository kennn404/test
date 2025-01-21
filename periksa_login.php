<?php 
// menghubungkan dengan koneksi
include 'koneksi.php';

// menangkap data yang dikirim dari form
$username = $_POST['username'];
$password = $_POST['password'];
$akses = $_POST['akses'];

// Deteksi pola injeksi
function detect_injection($input) {
    $patterns = [
        '/\b(OR|AND)\b/i',           // Kata kunci SQL
        '/(\'|\"|#|--|;)/',          // Karakter injeksi umum
        '/\b(SELECT|INSERT|UPDATE|DELETE|DROP|UNION|SHOW|CREATE|ALTER|TRUNCATE|GRANT)\b/i' // Perintah SQL
    ];
    foreach ($patterns as $pattern) {
        if (preg_match($pattern, $input)) {
            return true;
        }
    }
    return false;
}

// Periksa apakah ada pola injeksi
if (detect_injection($username) || detect_injection($password) || detect_injection($akses)) {
    echo "<script>alert('sekarang ga bisa di injeksi loeh...'); window.location.href = 'login.php';</script>";
    exit;
}

// Proses login seperti biasa
$password = md5($password);

if ($akses == "admin") {
    $login = mysqli_query($koneksi, "SELECT * FROM admin WHERE admin_username='$username' AND admin_password='$password'");
    $cek = mysqli_num_rows($login);

    if ($cek > 0) {
        session_start();
        $data = mysqli_fetch_assoc($login);
        $_SESSION['id'] = $data['admin_id'];
        $_SESSION['nama'] = $data['admin_nama'];
        $_SESSION['username'] = $data['admin_username'];
        $_SESSION['status'] = "admin_login";

        header("location:admin/");
    } else {
        header("location:login.php?alert=gagal");
    }
} else {
    $login = mysqli_query($koneksi, "SELECT * FROM petugas WHERE petugas_username='$username' AND petugas_password='$password'");
    $cek = mysqli_num_rows($login);

    if ($cek > 0) {
        session_start();
        $data = mysqli_fetch_assoc($login);
        $_SESSION['id'] = $data['petugas_id'];
        $_SESSION['nama'] = $data['petugas_nama'];
        $_SESSION['username'] = $data['petugas_username'];
        $_SESSION['status'] = "petugas_login";

        header("location:petugas/");
    } else {
        header("location:login.php?alert=gagal");
    }
}
?>



