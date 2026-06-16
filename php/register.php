<?php

include "koneksi.php";

/* Cek apakah form dikirim */

if(isset($_POST['nama'])){

    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    /* Role otomatis siswa */

    $role = "siswa";

    /* Cek username sudah ada atau belum */

    $cek = mysqli_query(
        $koneksi,
        "SELECT * FROM user WHERE username='$username'"
    );

    if(mysqli_num_rows($cek) > 0){

        echo "
        <script>
        alert('Username sudah digunakan!');
        window.location='../register.html';
        </script>
        ";

    }else{

        /* Simpan akun */

        $sql = "INSERT INTO user
        (nama, username, password, role)

        VALUES
        ('$nama','$username','$password','$role')";

        if(mysqli_query($koneksi, $sql)){

            echo "
            <script>
            alert('Akun berhasil dibuat!');
            window.location='../login.html';
            </script>
            ";

        }else{

            echo "
            <script>
            alert('Register gagal!');
            window.location='../register.html';
            </script>
            ";

        }

    }

}else{

    echo "
    <script>
    alert('Data kosong!');
    window.location='../register.html';
    </script>
    ";

}

?>