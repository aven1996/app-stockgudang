<?php

include "connection.php";
include "functions.php";


if(isset($_POST['login'])){
    $user = trim(htmlspecialchars($_POST['username']));
    $pass = trim(htmlspecialchars($_POST['password']));

    // cek apakah ada username yang cocok
    $sql_user = mysqli_query($conn, "SELECT * FROM t_akun WHERE username = '$user'");
    if(mysqli_num_rows($sql_user) > 0){
        // jika username ada , verifikasi password
        $pass_db  = mysqli_fetch_assoc($sql_user)['password'];
        if(password_verify($pass, $pass_db)){
            session_start();
            $_SESSION['akun'] = $user;
            header("Location: ../index.php?menu=beranda");
            die;
        }else{
            header("Location: ../login.php?err=Password salah!");
        }
    }else{
        header("Location: ../login.php?err=Username tidak terdaftar!");
        
    }
}

