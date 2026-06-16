<?php
session_start();

/* =========================
   CEK LOGIN
========================= */

if(!isset($_SESSION['username'])){

    header("Location: login.html");
    exit;

}

/* =========================
   CEK ROLE
========================= */

if($_SESSION['role'] != "admin"){

    header("Location: dashboard.php");
    exit;

}

include "php/koneksi.php";

/* =========================
   AMBIL DATA KONSELING
========================= */

$query = mysqli_query(

$koneksi,

"SELECT * FROM konseling
ORDER BY id DESC"

);

/* =========================
   STATISTIK
========================= */

$total = mysqli_num_rows(

mysqli_query(
$koneksi,
"SELECT * FROM konseling"
)

);

$diproses = mysqli_num_rows(

mysqli_query(
$koneksi,
"SELECT * FROM konseling
WHERE LOWER(status)='diproses'"
)

);

$selesai = mysqli_num_rows(

mysqli_query(
$koneksi,
"SELECT * FROM konseling
WHERE LOWER(status)='selesai'"
)

);

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Dashboard Admin BK</title>

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
background:#f1f5f9;
}

/* WRAPPER */

.wrapper{
display:flex;
min-height:100vh;
}

/* SIDEBAR */

.sidebar{
width:260px;
background:#0f172a;
padding:30px 20px;
position:fixed;
height:100%;
}

.sidebar h2{
text-align:center;
color:white;
margin-bottom:35px;
font-size:28px;
}

.sidebar a{
display:block;
padding:14px;
margin-bottom:12px;
border-radius:14px;
text-decoration:none;
color:#cbd5e1;
transition:0.3s;
font-size:15px;
}

.sidebar a:hover{
background:#2563eb;
color:white;
transform:translateX(5px);
}

.sidebar i{
margin-right:10px;
}

/* MAIN */

.main{
margin-left:260px;
padding:30px;
width:100%;
}

/* TOPBAR */

.topbar{
background:linear-gradient(135deg,#0f172a,#1e3a8a);
padding:30px;
border-radius:25px;
display:flex;
justify-content:space-between;
align-items:center;
color:white;
margin-bottom:30px;
box-shadow:0 10px 25px rgba(0,0,0,0.15);
}

.topbar h1{
font-size:32px;
margin-bottom:8px;
}

.topbar p{
font-size:15px;
opacity:0.9;
}

.topbar i{
font-size:70px;
opacity:0.2;
}

/* STATS */

.stats{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
gap:20px;
margin-bottom:30px;
}

.card{
padding:25px;
border-radius:22px;
color:white;
position:relative;
overflow:hidden;
box-shadow:0 10px 25px rgba(0,0,0,0.08);
transition:0.3s;
}

.card:hover{
transform:translateY(-5px);
}

.card h3{
font-size:15px;
margin-bottom:10px;
}

.card h1{
font-size:38px;
}

.card i{
position:absolute;
right:20px;
bottom:20px;
font-size:55px;
opacity:0.2;
}

.blue{
background:linear-gradient(135deg,#2563eb,#60a5fa);
}

.orange{
background:linear-gradient(135deg,#f97316,#fb923c);
}

.green{
background:linear-gradient(135deg,#16a34a,#4ade80);
}

/* BOX */

.box{
background:white;
padding:25px;
border-radius:22px;
box-shadow:0 10px 25px rgba(0,0,0,0.05);
margin-bottom:25px;
overflow-x:auto;
}

.box h2{
margin-bottom:20px;
color:#1e293b;
}

/* TABLE */

table{
width:100%;
border-collapse:collapse;
overflow:hidden;
border-radius:14px;
}

table th{
background:#2563eb;
color:white;
padding:15px;
font-size:14px;
}

table td{
padding:15px;
text-align:center;
border-bottom:1px solid #e2e8f0;
font-size:14px;
}

/* STATUS */

.status{
padding:8px 14px;
border-radius:20px;
font-size:13px;
font-weight:600;
color:white;
display:inline-block;
}

.diproses{
background:#f59e0b;
}

.selesai{
background:#22c55e;
}

/* BUTTON */

.btn{
display:inline-block;
padding:10px 18px;
background:#2563eb;
color:white;
text-decoration:none;
border-radius:12px;
font-size:14px;
font-weight:600;
transition:0.3s;
border:none;
cursor:pointer;
}

.btn:hover{
background:#1d4ed8;
transform:translateY(-2px);
}

/* JADWAL */

.jadwal{
font-size:13px;
color:#475569;
line-height:22px;
}

/* RESPONSIVE */

@media(max-width:900px){

.wrapper{
flex-direction:column;
}

.sidebar{
position:relative;
width:100%;
height:auto;
}

.main{
margin-left:0;
}

.topbar{
flex-direction:column;
text-align:center;
gap:20px;
}

table{
display:block;
overflow-x:auto;
}

}

</style>

</head>

<body>

<div class="wrapper">

<!-- SIDEBAR -->

<div class="sidebar">

<h2>Admin BK</h2>

<a href="admin.php">
<i class="fa-solid fa-house"></i>
Dashboard
</a>

<a href="laporan.php">
<i class="fa-solid fa-file-lines"></i>
Laporan
</a>

<a href="php/logout.php">
<i class="fa-solid fa-right-from-bracket"></i>
Logout
</a>

</div>

<!-- MAIN -->

<div class="main">

<!-- TOPBAR -->

<div class="topbar">

<div>

<h1>Dashboard Guru BK 👨‍🏫</h1>

<p>
Kelola pengajuan konseling siswa dengan mudah
</p>

</div>

<i class="fa-solid fa-user-shield"></i>

</div>

<!-- STATISTIK -->

<div class="stats">

<div class="card blue">

<h3>Total Pengajuan</h3>

<h1>
<?php echo $total; ?>
</h1>

<i class="fa-solid fa-file-circle-plus"></i>

</div>

<div class="card orange">

<h3>Diproses</h3>

<h1>
<?php echo $diproses; ?>
</h1>

<i class="fa-solid fa-spinner"></i>

</div>

<div class="card green">

<h3>Selesai</h3>

<h1>
<?php echo $selesai; ?>
</h1>

<i class="fa-solid fa-circle-check"></i>

</div>

</div>

<!-- DATA -->

<div class="box">

<h2>Data Konseling Siswa</h2>

<table>

<tr>

<th>No</th>
<th>Nama</th>
<th>Kelas</th>
<th>Masalah</th>
<th>Keluhan</th>
<th>Status</th>
<th>Jadwal</th>
<th>Aksi</th>

</tr>

<?php
$no=1;

while($data=mysqli_fetch_array($query))
{
?>

<tr>

<td><?php echo $no++; ?></td>

<td>
<?php echo $data['nama']; ?>
</td>

<td>
<?php echo $data['kelas']; ?>
</td>

<td>
<?php echo $data['jenis_masalah']; ?>
</td>

<td>
<?php echo $data['keluhan']; ?>
</td>

<td>

<?php
if(strtolower($data['status'])=="diproses"){
?>

<span class="status diproses">
Diproses
</span>

<?php
}else{
?>

<span class="status selesai">
Selesai
</span>

<?php
}
?>

</td>

<td class="jadwal">

<?php
if($data['jadwal'] != NULL && $data['jam'] != NULL){
?>

📅 <?php echo $data['jadwal']; ?>

<br>

🕒 <?php echo $data['jam']; ?>

<?php
}else{
?>

Belum ada jadwal

<?php
}
?>

</td>

<td>

<?php
if(strtolower($data['status'])=="diproses"){
?>

<a href="atur_jadwal.php?id=<?php echo $data['id']; ?>" class="btn">
Atur Jadwal
</a>

<?php
}else{
?>

✔ Sudah selesai

<?php
}
?>

</td>

</tr>

<?php
}
?>

</table>

</div>

</div>

</div>

</body>
</html>