<?php
session_start();

/* CEK LOGIN */

if(!isset($_SESSION['username'])){

    header("Location: login.html");
    exit;

}

include "php/koneksi.php";

$username = $_SESSION['username'];

/* AMBIL DATA */

$query = mysqli_query(

$koneksi,

"SELECT * FROM konseling
WHERE username='$username'
ORDER BY id DESC"

);

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Riwayat Konseling</title>

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
background:#1e293b;
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
background:linear-gradient(135deg,#2563eb,#3b82f6);
padding:30px;
border-radius:25px;
display:flex;
justify-content:space-between;
align-items:center;
color:white;
margin-bottom:30px;
box-shadow:0 10px 25px rgba(37,99,235,0.2);
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

/* BOX */

.box{
background:white;
padding:25px;
border-radius:25px;
box-shadow:0 10px 25px rgba(0,0,0,0.05);
}

/* TABLE */

table{
width:100%;
border-collapse:collapse;
overflow:hidden;
border-radius:16px;
}

table th{
background:#2563eb;
color:white;
padding:16px;
font-size:14px;
}

table td{
padding:16px;
text-align:center;
border-bottom:1px solid #e2e8f0;
font-size:14px;
}

table tr:hover{
background:#f8fafc;
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

/* JADWAL */

.jadwal{
font-size:13px;
color:#475569;
line-height:22px;
}

/* EMPTY */

.empty{
text-align:center;
padding:40px;
color:#64748b;
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

<h2>Konseling</h2>

<a href="dashboard.php">
<i class="fa-solid fa-house"></i>
Dashboard
</a>

<a href="konseling.html">
<i class="fa-solid fa-pen"></i>
Ajukan Konseling
</a>

<a href="riwayat.php">
<i class="fa-solid fa-clock-rotate-left"></i>
Riwayat
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

<h1>Riwayat Konseling 📋</h1>

<p>
Daftar pengajuan konseling yang pernah dilakukan
</p>

</div>

<i class="fa-solid fa-clock-rotate-left"></i>

</div>

<!-- TABLE -->

<div class="box">

<?php
if(mysqli_num_rows($query)>0){
?>

<table>

<tr>

<th>No</th>
<th>Nama</th>
<th>Kelas</th>
<th>Masalah</th>
<th>Keluhan</th>
<th>Status</th>
<th>Jadwal</th>

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
if($data['status']=="Diproses"){
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
if($data['jadwal'] != NULL){
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

</tr>

<?php
}
?>

</table>

<?php
}else{
?>

<div class="empty">

<h2>
Belum ada riwayat konseling
</h2>

<p style="margin-top:10px;">
Silakan ajukan konseling terlebih dahulu
</p>

</div>

<?php
}
?>

</div>

</div>

</div>

</body>
</html>