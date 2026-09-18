<?php


include "connection.php";
include "functions.php";


$thn = $_GET['thn'];

$sql_masuk = mysqli_query($conn, "SELECT jumlah, tgl_masuk FROM t_masuk_barang WHERE keterangan != 'restore' AND YEAR(tgl_masuk) = '$thn'");
$masuk = [0,0,0,0,0,0,0,0,0,0,0,0];
if(mysqli_num_rows($sql_masuk) > 0){
    while($msk = mysqli_fetch_assoc($sql_masuk)){
        $bln = explode('-',$msk['tgl_masuk']);
        $masuk[$bln[1]-1] = $masuk[$bln[1]-1] + $msk['jumlah'];
    }
}


$sql_keluar = mysqli_query($conn, "SELECT jumlah, tgl_pengambilan FROM t_pengambilan WHERE YEAR(tgl_pengambilan) = '$thn'");
$keluar = [0,0,0,0,0,0,0,0,0,0,0,0];
if(mysqli_num_rows($sql_keluar) > 0){
    while($klr = mysqli_fetch_assoc($sql_keluar)){
        $bln = explode('-',$klr['tgl_pengambilan']);
        $keluar[$bln[1]-1] = $keluar[$bln[1]-1] + $klr['jumlah'];
    }
}


// gabungkan variabel array masuk dan keluar
$data = [];
$data[] = $masuk;
$data[] = $keluar;

// mengubah array menjadi json
echo json_encode($data);