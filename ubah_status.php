<?php

include "php/koneksi.php";

$id = $_GET['id'];

mysqli_query(
$koneksi,
"UPDATE konseling 
SET status='Selesai'
WHERE id='$id'"
);

header("Location: admin.php");

?>