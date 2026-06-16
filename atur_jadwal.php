<?php
session_start();

if(!isset($_SESSION['username'])){
    header("Location: login.html");
    exit;
}

include "php/koneksi.php";

$id = $_GET['id'];

$data = mysqli_fetch_assoc(

mysqli_query(
$koneksi,
"SELECT * FROM konseling WHERE id='$id'"
)

);

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Atur Jadwal Konseling</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{
height:100vh;
display:flex;
justify-content:center;
align-items:center;
background:#f1f5f9;
padding:20px;
}

/* CARD */

.card{
width:420px;
background:white;
padding:35px;
border-radius:28px;
box-shadow:0 10px 30px rgba(0,0,0,0.08);
animation:fade 0.8s ease;
}

@keyframes fade{

from{
opacity:0;
transform:translateY(20px);
}

to{
opacity:1;
transform:translateY(0);
}

}

.header{
text-align:center;
margin-bottom:28px;
}

.header i{
font-size:60px;
margin-bottom:15px;
color:#2563eb;
}

.header h1{
font-size:30px;
margin-bottom:8px;
color:#1e293b;
}

.header p{
font-size:14px;
color:#64748b;
}

/* INFO */

.info{
background:#f8fafc;
padding:18px;
border-radius:18px;
margin-bottom:25px;
line-height:28px;
font-size:14px;
color:#334155;
border:1px solid #e2e8f0;
}

.info strong{
color:#0f172a;
}

/* LABEL */

label{
display:block;
margin-bottom:10px;
font-size:14px;
font-weight:500;
color:#334155;
}

/* INPUT */

.input-box{
position:relative;
margin-bottom:22px;
}

.input-box i{
position:absolute;
left:15px;
top:50%;
transform:translateY(-50%);
color:#64748b;
}

.input{
width:100%;
padding:15px 15px 15px 45px;
border:1px solid #cbd5e1;
outline:none;
border-radius:16px;
background:white;
font-size:14px;
transition:0.3s;
}

.input:focus{
border-color:#2563eb;
box-shadow:0 0 0 4px rgba(37,99,235,0.1);
transform:scale(1.02);
}

/* BUTTON */

.btn{
width:100%;
padding:15px;
border:none;
border-radius:16px;
background:#2563eb;
color:white;
font-size:16px;
font-weight:700;
cursor:pointer;
transition:0.3s;
margin-top:10px;
}

.btn:hover{
transform:translateY(-3px);
background:#1d4ed8;
box-shadow:0 10px 20px rgba(37,99,235,0.2);
}

/* BACK */

.back{
display:block;
text-align:center;
margin-top:18px;
color:#2563eb;
text-decoration:none;
font-size:14px;
font-weight:500;
}

.back:hover{
text-decoration:underline;
}

/* RESPONSIVE */

@media(max-width:600px){

.card{
width:100%;
padding:28px;
}

.header h1{
font-size:26px;
}

}

</style>

</head>

<body>

<div class="card">

<div class="header">

<i class="fa-solid fa-calendar-check"></i>

<h1>Atur Jadwal</h1>

<p>
Tentukan jadwal konseling siswa
</p>

</div>

<!-- INFO SISWA -->

<div class="info">

<strong>Nama :</strong>
<?php echo $data['nama']; ?>

<br>

<strong>Kelas :</strong>
<?php echo $data['kelas']; ?>

<br>

<strong>Masalah :</strong>
<?php echo $data['jenis_masalah']; ?>

</div>

<!-- FORM -->

<form action="php/simpan_jadwal.php" method="POST">

<input
type="hidden"
name="id"
value="<?php echo $data['id']; ?>">

<label>Tanggal Konseling</label>

<div class="input-box">

<i class="fa-solid fa-calendar-days"></i>

<input
type="date"
name="jadwal"
class="input"
required>

</div>

<label>Jam Konseling</label>

<div class="input-box">

<i class="fa-solid fa-clock"></i>

<input
type="time"
name="jam"
class="input"
required>

</div>

<button type="submit" class="btn">
Simpan Jadwal
</button>

</form>

<a href="admin.php" class="back">
← Kembali ke Dashboard
</a>

</div>

</body>
</html>