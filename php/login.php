<?php
session_start();

include "koneksi.php";

if(isset($_POST['username'])){

    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $query = mysqli_query(
    $koneksi,

    "SELECT * FROM user
    WHERE username='$username'
    AND password='$password'
    AND role='$role'"
    );

    $data = mysqli_fetch_assoc($query);

    if($data){

        $_SESSION['username'] = $data['username'];
        $_SESSION['role'] = $data['role'];

        if($data['role']=="admin"){

            header("Location: ../admin.php");
            exit;

        }else{

            header("Location: ../dashboard.php");
            exit;

        }

    }else{

        echo "
        <script>
        alert('Username atau Password salah');
        window.location='../login.html';
        </script>
        ";

    }

}else{

    header("Location: ../login.html");
    exit;

}
?>