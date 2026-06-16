<?php
session_start();

include "koneksi.php";

$username = $_SESSION['username'];

$nama = $_POST['nama'];
$kelas = $_POST['kelas'];
$jenis_masalah = $_POST['jenis_masalah'];
$keluhan = $_POST['keluhan'];

$query = "INSERT INTO konseling
(username, nama, kelas, jenis_masalah, keluhan, status)

VALUES
('$username','$nama','$kelas','$jenis_masalah','$keluhan','Diproses')";

if(mysqli_query($koneksi,$query)){

    echo "
    <script>
    alert('Pengajuan konseling berhasil!');
    window.location='../riwayat.php';
    </script>
    ";

}
else{

    echo 'Error : ' . mysqli_error($koneksi);

}
?>