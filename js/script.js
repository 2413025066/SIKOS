// File: js/script.js

// Alert sukses kirim form konseling
function suksesKirim() {
    alert("Pengajuan konseling berhasil dikirim!");
}

// Konfirmasi logout
function konfirmasiLogout() {
    let pilih = confirm("Apakah Anda yakin ingin logout?");
    
    if(pilih){
        window.location.href = "login.html";
    }
}

// Jam realtime dashboard
function tampilJam() {
    let waktu = new Date();

    let jam = waktu.getHours();
    let menit = waktu.getMinutes();
    let detik = waktu.getSeconds();

    if(menit < 10) menit = "0" + menit;
    if(detik < 10) detik = "0" + detik;

    document.getElementById("jam").innerHTML =
        jam + ":" + menit + ":" + detik;
}

setInterval(tampilJam,1000);