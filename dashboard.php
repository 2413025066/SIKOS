<?php
session_start();

/* CEK LOGIN */

if(!isset($_SESSION['username'])){

    header("Location: login.html");
    exit;

}

include "php/koneksi.php";

$username = $_SESSION['username'];

/* AMBIL DATA USER */

$user = mysqli_fetch_assoc(

mysqli_query(
$koneksi,

"SELECT * FROM user
WHERE username='$username'"

)

);

/* STATISTIK */

$total = mysqli_num_rows(

mysqli_query(
$koneksi,

"SELECT * FROM konseling
WHERE username='$username'"

)

);

$diproses = mysqli_num_rows(

mysqli_query(
$koneksi,

"SELECT * FROM konseling
WHERE username='$username'
AND status='Diproses'"

)

);

$selesai = mysqli_num_rows(

mysqli_query(
$koneksi,

"SELECT * FROM konseling
WHERE username='$username'
AND status='Selesai'"

)

);

/* RIWAYAT TERAKHIR */

$query = mysqli_query(

$koneksi,

"SELECT * FROM konseling
WHERE username='$username'
ORDER BY id DESC
LIMIT 5"

);

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Dashboard Siswa</title>

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
}

.box h2{
margin-bottom:20px;
color:#1e293b;
}

/* BUTTON */

.btn{
display:inline-block;
padding:14px 22px;
background:#2563eb;
color:white;
text-decoration:none;
border-radius:14px;
font-weight:600;
transition:0.3s;
}

.btn:hover{
background:#1d4ed8;
transform:translateY(-2px);
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

<h1>
Halo,
<?php echo $user['nama']; ?> 👋
</h1>

<p>
Selamat datang di Sistem Informasi Konseling Sekolah
</p>

</div>

<i class="fa-solid fa-user-graduate"></i>

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

<!-- AJUKAN -->

<div class="box">

<h2>Ajukan Konseling</h2>

<p style="margin-bottom:20px;color:#64748b;">

Jika memiliki kendala pribadi,
belajar, sosial, atau keluarga,
silakan ajukan konseling kepada Guru BK.

</p>

<a href="konseling.html" class="btn">
📝 Konseling Sekarang
</a>

</div>

<!-- RIWAYAT -->

<div class="box">

<h2>Riwayat Terakhir</h2>

<table>

<tr>

<th>No</th>
<th>Masalah</th>
<th>Status</th>

</tr>

<?php
$no=1;

while($data=mysqli_fetch_array($query))
{
?>

<tr>

<td><?php echo $no++; ?></td>

<td>
<?php echo $data['jenis_masalah']; ?>
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