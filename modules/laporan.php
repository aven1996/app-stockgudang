<?php

include "connection.php";
include "functions.php";

// restore barang
if(isset($_POST['restore_barang'])){
    $id              = $_POST['id_barang']; 
    $id_pengambilan  = $_POST['id_pengambilan'];
    $jml             = $_POST['jumlah'];
    $sql             = "INSERT INTO t_masuk_barang VALUES ('', '$id', NOW(),'$jml', 'restore')";
    if($conn->query($sql) === TRUE){
        $stok = mysqli_query($conn, "SELECT stok, harga FROM t_barang WHERE id = '$id'");
        $stok = mysqli_fetch_assoc($stok);
        $stok_db = $stok['stok'];
        $stok_now = $stok_db + $jml;
        $inventory = $stok_now * $stok['harga'];
        // update ke t_barang
        mysqli_query($conn,"UPDATE t_barang SET stok = '$stok_now', inventory_value = '$inventory' WHERE id = '$id'");
        // masukkan ke tabel stock opname
        $sql3       = "INSERT INTO t_stock_opname VALUES ('','$id', NOW(), '$stok_now', '$inventory')";
        if($conn->query($sql3) == TRUE){
            // hapus data yanng direstore pada t_pengambilan
            mysqli_query($conn, "DELETE FROM t_pengambilan WHERE id_pengambilan = '$id_pengambilan'");
            header('Location: ../index.php?menu=laporan');
            die;
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
}