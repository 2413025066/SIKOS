<?php
include "koneksi.php";

$id = $_POST['id'];
$jadwal = $_POST['jadwal'];
$jam = $_POST['jam'];

$query = mysqli_query(

$koneksi,

"UPDATE konseling
SET
jadwal='$jadwal',
jam='$jam',
status='Selesai'
WHERE id='$id'"

);

if($query){

    echo "
    <script>
    alert('Jadwal berhasil ditentukan');
    window.location='../admin.php';
    </script>
    ";

}else{

    echo "
    <script>
    alert('Gagal menentukan jadwal');
    window.location='../admin.php';
    </script>
    ";

}
?>