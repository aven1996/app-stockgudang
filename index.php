<?php
    include "modules/connection.php";
    include "modules/functions.php";


    // Load data sekolah json
    $json_file = file_get_contents("data_sekolah.json");
    $json_parse = json_decode($json_file,true);

    // jika sudah login lempar ke beranda
    session_start();
    if(!isset($_SESSION['akun'])){
        header("Location: login.php");
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
        <link rel="stylesheet" href="css/jquery-ui.css">
        <link rel="stylesheet" href="css/dataTables.jqueryui.min.css">
        <link rel="stylesheet" href="css/buttons.jqueryui.min.css">

        <title>Aplikasi Manajemen Stok Gudang <?= $json_parse['NamaSekolah']; ?></title>

    </head>
    <body class="bg-light">
        <!-- NAVBAR -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
            
                <a class="navbar-brand" href="index.php">
                    <img src="img/logo_kop/<?= $json_parse['pathlogo']; ?>" width="30" height="30" class="d-inline-block align-top" alt="">
                    <b>Stock Gudang</b>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <div class="d-flex justify-content-between align-items-end w-100">
                        <ul class="navbar-nav">
                            <li class="nav-item <?php if(isset($_GET['menu'])){echo cekSttMenu('beranda', $_GET['menu']);}else{echo cekSttMenu('beranda', 'beranda');}?>">
                                <a class="nav-link" href="?menu=beranda">Beranda <span class='sr-only'>(current)</span></span></a>
                            </li>
                            <li class="nav-item <?php if(isset($_GET['menu'])){echo cekSttMenu('gudang', $_GET['menu']);}?>">
                                <a class="nav-link" href="?menu=gudang">Gudang</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle <?php if(isset($_GET['menu'])){echo cekSttMenu('laporan', $_GET['menu']);}?>" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Laporan
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="?menu=laporan">Pengambilan Barang</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="?menu=stockopname">Stock Opname</a>
                                </div>
                            </li>
                            <li class="nav-item <?php if(isset($_GET['menu'])){echo cekSttMenu('pengaturan', $_GET['menu']);}?>">
                                <a class="nav-link" href="?menu=pengaturan">Pengaturan</a>
                            </li>
                        </ul>
                        <form class="form-inline position-relative" method="GET">
                            <input class="form-control mr-sm-2" style="width: 250px; padding-left: 35px;" type="search" placeholder="Cari Barang" aria-label="Search" id="cari_barang" autocomplete="off">
                            <span class="icon-search position-absolute" style="left: 10px; color: rgba(0,0,0,0.3);"></span>
                            
                            <!-- popup result cari -->
                            <div id="popup_res_cari"></div>
                            
                        </form>
                    </div>
                </div>
                
            </div>
        </nav>


        <!-- MODAL AMBIL BARANG -->
        <?php
            if(isset($_GET['idcari'])):
                $idx      = trim(htmlspecialchars($_GET['idcari']));
                $sqlx     = mysqli_query($conn, "SELECT * FROM t_barang INNER JOIN t_satuan ON t_barang.id_satuan = t_satuan.id_satuan INNER JOIN t_sumber_dana ON t_barang.id_sumber = t_sumber_dana.id_sumber WHERE id = '$idx'");
                if(mysqli_num_rows($sqlx) > 0):
                    while($resx = mysqli_fetch_assoc($sqlx)):
        ?>
                    <!-- Modal Ambil Barang-->
                    <div class="modal fade" id="ModalAmbilCari" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Ambil Barang</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="modules/index.php" method="post">

                                    <div class="form-group" >
                                        <!-- card barang terpilih -->
                                        <div class="p-2 mt-1 bg-light border rounded-lg position-relative">
                                            <input type="hidden" id="ambil_satuan" value="<?= $resx['satuan']; ?>">
                                            <input type="hidden" name="id" value="<?= $resx['id']; ?>">
                                            <div class="d-flex justify-content-between">
                                                <h4><?= $resx['nama_barang']; ?></h4>
                                            </div>
                                            <div class="d-flex" style="height: 30px;">
                                                <span class="py-1 px-2 text-white rounded-lg small mr-1" title="Sumber dana" style="background-color: <?= $resx['warna']; ?>;"><?= $resx['sumber']; ?></span>
                                                <span class="py-1 px-2 bg-secondary text-white rounded-lg small mr-1" title="Stok barang"><?= $resx['stok']; ?> <?= $resx['satuan']; ?></span>
                                                <span class="py-1 px-2 bg-secondary text-white rounded-lg small mr-1" title="Harga satuan barang">@<?= rupiah($resx['harga']); ?></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="tgl_ambil">Tanggal Ambil Barang</label>
                                        <input type="date" name="tgl_ambil" class="form-control" id="tgl_ambil" value="<?= date('Y-m-d'); ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="nama_pengambil">Nama Pengambil</label>
                                        <input type="text" name="nama_pengambil" class="form-control" id="nama_pengambil" placeholder="Masukkan nama pengambil" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="jumlah">Jumlah</label>
                                        <div class="d-flex align-items-center">
                                            <input type="number" name="jumlah" class="form-control mr-3 w-75" id="jumlah" placeholder="Jumlah barang yang diambil" required>
                                            <span id="satuan_ambil" class="py-1 px-3 text-dark rounded" style="background-color: lightgrey;" title="Satuan dapat diubah melalui form edit barang"><?= $resx['satuan']; ?></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="keterangan">Keterangan</label>
                                        <input type="text" name="keterangan" class="form-control" id="keterangan" placeholder="Tambahkan keterangan seperti keperluan, lokasi, dst." required>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" name="ambil_barang_cari" class="btn btn-warning">Ambil</button>
                            </div>
                            </form>
                            </div>
                        </div>
                    </div>

        <?php

                endwhile;
            endif;
        endif;

        ?>

        <!-- INCLUDE PAGES -->
        <?php
            if(!isset($_GET['menu']) OR $_GET['menu'] == 'beranda' OR $_GET['menu'] == ''){
                include "beranda.php";
            }elseif($_GET['menu'] == 'gudang'){
                include "gudang.php";
            }elseif($_GET['menu'] == 'laporan'){
                include "laporan.php";
            }elseif($_GET['menu'] == 'stockopname'){
                include "laporan_stockopname.php";
            }elseif($_GET['menu'] == 'pengaturan'){
                include "pengaturan.php";
            }else{
                include "errorpage.php";
            }
        ?>
        

        <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
        <script src="js/jquery.js" crossorigin="anonymous"></script>
        <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
            
        <!-- Plugin JQuery DataTables -->
        <script src="js/datatables.min.js"></script>
        <!-- script tambahan Datatables  -->
        <script src="js/dataTables.jqueryui.min.js"></script>
        <script src="js/dataTables.buttons.min.js"></script>
        <script src="js/buttons.jqueryui.min.js"></script>
        <script src="js/jszip.min.js"></script>
        <script src="js/pdfmake.min.js"></script>
        <script src="js/vfs_fonts.js"></script>
        <script src="js/buttons.html5.min.js"></script>
        <script src="js/buttons.print.min.js"></script>
        
        <!-- ChartJS -->
        <script src="js/ChartJS/dist/chart.js"></script>

        <!-- Addtional Javascript -->
        <script src="js/index.js"></script> 
        <script src="js/gudang.js"></script>
        <script src="js/laporan.js"></script>
        <script src="js/stockopname.js"></script>
        <script src="js/pengaturan.js"></script>
        
        <!-- dataTables calling function -->
        <script>
            function strBulan(value){
                if(value == 1){
                    return "Januari";
                }else if(value == 2){
                    return "Februari";
                }else if(value == 3){
                    return "Maret";
                }else if(value == 4){
                    return "April";
                }else if(value == 5){
                    return "Mei";
                }else if(value == 6){
                    return "Juni";
                }else if(value == 7){
                    return "Juli";
                }else if(value == 8){
                    return "Agustus";
                }else if(value == 9){
                    return "September";
                }else if(value == 10){
                    return "Oktober";
                }else if(value == 11){
                    return "November";
                }else if(value == 12){
                    return "Desember";
                }else{
                    return "";
                }
            }

            $(document).ready( function () {
                // deklarasi bulan dan tahun | diambil dari select bulan dan tahun
                var bulan_laporan = strBulan($("#bulan_pengambilan").val());
                var tahun_laporan = $("#tahun_pengambilan").val();
                var bulan_stockop = strBulan($("#bulan_stockopname").val());
                var tahun_stockop = $("#tahun_stockopname").val();

                // ambil data sekolah json dimasukan ke var array
                fetch('data_sekolah.json', { method: 'GET' })
                .then(function(response) { return response.json(); })
                .then(function(data_sekolah) {
                
                    // datatables stok gudang
                    var table = $('#tabel_gudang').DataTable({
                    order : [[6, 'desc']],
                    lengthChange: false,
                    dom: 'Bfrtip',
                    buttons: [
                                {
                                    extend: 'excelHtml5',
                                    title: 'Daftar Stok Gudang ' + data_sekolah['NamaSekolah']
                                },
                                {
                                    extend: 'pdfHtml5',
                                    title: 'Daftar Stok Gudang ' + data_sekolah['NamaSekolah']
                                },
                                {
                                    extend: 'print',
                                    title: 'Daftar Stok Gudang ' + data_sekolah['NamaSekolah']
                                }
                            ]
                    });
                    table.buttons().container()
                        .insertBefore( '#example_filter' );
                    
                    // datatables pengambilan
                    var table_pengambilan = $('#tabel_pengambilan').DataTable({
                    order : [[2, 'desc']],
                    lengthChange: false,
                    dom: 'Bfrtip',
                    buttons: [
                                {
                                    extend: 'excelHtml5',
                                    title: 'Laporan Pengambilan Barang '+ bulan_laporan + ' ' + tahun_laporan + ' ' + data_sekolah['NamaSekolah']
                                },
                                {
                                    extend: 'pdfHtml5',
                                    title: 'Laporan Pengambilan Barang '+ bulan_laporan + " " + tahun_laporan + ' ' + data_sekolah['NamaSekolah']
                                },
                                {
                                    extend: 'print',
                                    title: 'Laporan Pengambilan Barang '+ bulan_laporan + " " + tahun_laporan + ' ' + data_sekolah['NamaSekolah']
                                }
                            ]
                    });
                    table_pengambilan.buttons().container()
                        .insertBefore( '#example_filter' );


                    // datatables stockopname
                    var table_opname = $('#tabel_stockopname').DataTable({
                    order : [[4, 'desc']],
                    lengthChange: false,
                    dom: 'Bfrtip',
                    buttons: [
                                {
                                    extend: 'excelHtml5',
                                    title: 'Laporan Stock Opname '+ bulan_stockop + ' ' + tahun_stockop + ' ' + data_sekolah['NamaSekolah']
                                },
                                {
                                    extend: 'pdfHtml5',
                                    title: 'Laporan Stock Opname '+ bulan_stockop + ' ' + tahun_stockop + ' ' + data_sekolah['NamaSekolah']
                                },
                                {
                                    extend: 'print',
                                    title: 'Laporan Stock Opname '+ bulan_stockop + ' ' + tahun_stockop + ' ' + data_sekolah['NamaSekolah']
                                }
                            ]
                    });
                    table_opname.buttons().container()
                        .insertBefore( '#example_filter' );
                });
            });
        </script>


        <!-- Menampilkan Modal Ambil dari Kolom cari -->
        <script>
            $("#ModalAmbilCari").modal("show");
        </script>

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