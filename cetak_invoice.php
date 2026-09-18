<?php
    include "modules/connection.php";
 
    // parse json file
    $json_file = file_get_contents("data_sekolah.json");
    $json_parsed = json_decode($json_file,true);


    // ambil data pengambilan berdasarkan id pengambilan yang dikirim dari url
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "SELECT * FROM t_pengambilan INNER JOIN t_barang ON t_pengambilan.id_barang = t_barang.id WHERE id_pengambilan = '$id'";
        $res = mysqli_query($conn, $sql);
        $data = mysqli_fetch_assoc($res);
    }

    // ambil data pengambilan berasarkan id dari barang yang tercentang
    if(isset($_POST['cetak_inv_checked'])){
        // jika tidak ada data yang dipilih
        if(empty($_POST['chk_id'])){
            echo "<script>
                    alert('Tidak ada data yang dipilih!');
                    window.close();
                </script>";
            die();
        }

        $id_arr = $_POST['chk_id'];
        
        // ambil data pengambilan dari id pertama
        $id_1st = $_POST['chk_id'][0];
        $sql = "SELECT * FROM t_pengambilan INNER JOIN t_barang ON t_pengambilan.id_barang = t_barang.id WHERE id_pengambilan = '$id_1st'";
        $res = mysqli_query($conn, $sql);
        $data_1st = mysqli_fetch_assoc($res);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" crossorigin="anonymous">   
    <!-- icon -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <title>Cetak Invoice Pengambilan Barang</title>
</head>
<body class="p-5">
    <div>
        <img style="width: 100%;" src="img/logo_kop/<?= $json_parsed['pathkop']; ?>" alt="">
    </div>
    <div class="py-2" style="font-family:Arial, Helvetica, sans-serif;">
        <h5 class="font-weight-bold py-1">NOMOR : </h5>
        <h5 class="font-weight-bold py-1">TANGGAL : 
        <?php
            if(isset($_GET['id'])){
                echo date('d F Y', strtotime($data['tgl_pengambilan'])); 
            }
            if(isset($_POST['cetak_inv_checked'])){
                echo date('d F Y', strtotime($data_1st['tgl_pengambilan']));
            }
            ?></h5>
    </div>
    <table border="1" class="mb-5" style="width: 100%; border-collapse: collapse; font-family: Arial, Helvetica, sans-serif;">
        <thead>
            <tr>
                <th style="width: 5%;" class="text-center p-2">NO</th>
                <th style="padding:5px;">NAMA BARANG</th>
                <th style="width: 20%;" class="text-center p-2">JUMLAH</th>
                <th style="width: 20%;" class="text-center p-2">SATUAN</th>
            </tr>
        </thead>
        <tbody> 
            <?php
                if(isset($_GET['id'])){
            ?>
            <tr style="height: 350px;">
                <td class="p-2 text-center align-top">1</td>
                <td class="p-2 align-top"><?= $data['nama_barang']; ?></td>
                <td class="p-2 text-center align-top"><?= $data['jumlah']; ?></td>
                <td class="p-2 text-center align-top">
                    <?php 
                        $id_satuan = $data['id_satuan'];
                        $res_satuan = mysqli_query($conn, "SELECT * FROM t_satuan WHERE id_satuan = '$id_satuan'");
                        $satuan = mysqli_fetch_assoc($res_satuan)['satuan'];
                        echo $satuan;
                    ?>
                </td>
            </tr>
            <?php } ?>

            <?php
                if(isset($_POST['cetak_inv_checked'])){
                    $no = 1;
                    foreach ($id_arr as $id) {
                        $sql_arr = "SELECT * FROM t_pengambilan INNER JOIN t_barang ON t_pengambilan.id_barang = t_barang.id WHERE id_pengambilan = '$id'";
                        $res_arr = mysqli_query($conn, $sql_arr);
                        $data_arr = mysqli_fetch_assoc($res_arr);
            ?>
            <tr style="height: 50px;">
                <td class="p-2 text-center align-top"><?= $no; ?> <?php $no++; ?></td>
                <td class="p-2 align-top"><?= $data_arr['nama_barang']; ?></td>
                <td class="p-2 text-center align-top"><?= $data_arr['jumlah']; ?></td>
                <td class="p-2 text-center align-top">
                    <?php 
                        $id_satuan = $data_arr['id_satuan'];
                        $res_satuan = mysqli_query($conn, "SELECT * FROM t_satuan WHERE id_satuan = '$id_satuan'");
                        $satuan = mysqli_fetch_assoc($res_satuan)['satuan'];
                        echo $satuan;
                    ?>
                </td>
            </tr>
            <?php 
                    }
                } ?>
        </tbody>
    </table>

    <div class="d-flex flex-column justify-content-between align-items-center mb-5" style="height: 150px; margin-top:100px">
        <b>PLT. KEPALA TU</b>
        <img style="height:130px; position:absolute;" src="img/ttd/<?= $json_parsed['ttdKepalaTU']; ?>" alt="">
        <div>
            <b class="d-block text-center"><?= $json_parsed['KepalaTU']; ?></b>
            <b class="d-block text-center">NIP. <?= $json_parsed['NIPKepalaTU']; ?></b>
        </div>
    </div>
    <div class="d-flex justify-content-center align-items-center" >
        <div class="d-flex flex-column justify-content-between align-items-center w-50" style="height: 150px;">
            <b>PENGURUS BARANG</b>
            <img style="height:130px; position:absolute;" src="img/ttd/<?= $json_parsed['ttdPetugas']; ?>" alt="">
            <div>
                <b class="d-block text-center"><?= $json_parsed['PetugasGudang']; ?></b>
                <b class="d-block text-center">NIP. <?= $json_parsed['NIPPetugasGudang']; ?></b>
            </div>
        </div>
        <div class="d-flex flex-column justify-content-between align-items-center w-50" style="height: 150px;">
            <b>YANG MENGAMBIL BARANG</b>
            <div>
                <b class="d-block text-center">
                    <?php
                        if(isset($_GET['id'])){
                           echo $data['nama_pengambil'];
                        }
                        
                        if(isset($_POST['cetak_inv_checked'])){
                           echo $data_1st['nama_pengambil'];
                        }
                    ?>
                </b>
                <b class="d-block text-center">NIP. </b>
            </div>
        </div>

    </div>


    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="js/jquery.js" crossorigin="anonymous"></script>
    <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <!-- Cetak halaman -->
    <script>
        window.print();
        window.onafterprint = window.close;
    </script>
</body>
</html>