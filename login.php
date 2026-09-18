<?php
    include "modules/connection.php";
    include "modules/functions.php";



    // Load data sekolah json
    $json_file = file_get_contents("data_sekolah.json");
    $json_parse = json_decode($json_file,true);

    // jika error
    if(isset($_GET['err'])){
        echo "<script> alert('".$_GET['err']."'); </script>";
    }

    // jika sudah login lempar ke beranda
    session_start();
    if(isset($_SESSION['akun'])){
        header("Location: index.php?menu=beranda");
    }
?>



<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- icon -->
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css" crossorigin="anonymous">      
        <!-- Additional CSS -->
        <link rel="stylesheet" href="css/style.css">

        <!-- Font-Icon -->
        <link rel="stylesheet" href="img/font-icon/style.css">
        <link rel="stylesheet" href="img/font-icon2/style.css">
        <link rel="stylesheet" href="img/font-icon3/style.css">

        <!-- Plugin Datatables -->
        <link rel="stylesheet" href="css/datatables.min.css">
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.jqueryui.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.jqueryui.min.css">

        <title>Aplikasi Manajemen Stok Gudang <?= $json_parse['NamaSekolah']; ?></title>

    </head>
    <body class="bg-light">

        <div class="container">
            <div class="card-login bg-white shadow-lg rounded-lg p-5 mx-auto mt-5 text-center" style="width: 350px;">
                <!-- logo -->
                <img src="img/logo_kop/<?= $json_parse['pathlogo']; ?>" alt="logo sekolah" width="100">
                <!-- judul aplikasi -->
                <h3 class="text-secondary my-3 font-weight-bold">APLIKASI STOCK GUDANG</h3>
                <!-- nama sekolah -->
                <h6 class="text-secondary mb-3"><?= $json_parse['NamaSekolah']; ?></h6>
                <!-- form login -->
                <form action="modules/login.php" method="post" class="mt-4">
                    <div class="form-group">
                        <input type="text" name="username" class="form-control" id="username" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                    </div>
                    <button type="submit" name="login" class="btn btn-success d-block w-100">Login</button>
                </form>
            </div>
        </div>




       
        <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
        <script src="js/jquery.js" crossorigin="anonymous"></script>
        <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
            
        <!-- Plugin JQuery DataTables -->
        <script src="js/datatables.min.js"></script>
        <!-- script tambahan Datatables  -->
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.jqueryui.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.jqueryui.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
        
        <!-- ChartJS -->
        <script src="js/ChartJS/dist/chart.js"></script>

        <!-- mengganti nilai max height pada tabel body -->
        <script>
            if(window.innerHeight > 635){
                $("#table_body").css("max-height","750px");
            }else{
                $("#table_body").css("max-height","470px");
            }
        </script>
    </body>
</html>