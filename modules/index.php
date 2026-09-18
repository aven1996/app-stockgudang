<?php
include "connection.php";
include "functions.php";

// ambil barang 
if(isset($_POST['ambil_barang_cari'])){
    $id_barang       = trim(htmlspecialchars($_POST['id']));
    $nama_pengambil  = trim(htmlspecialchars($_POST['nama_pengambil']));
    $tgl_pengambilan = trim(htmlspecialchars($_POST['tgl_ambil']));
    $jumlah          = trim(htmlspecialchars($_POST['jumlah']));
    $keterangan      = trim(htmlspecialchars($_POST['keterangan']));

    // cek kecocokan id barang
    $query_cek   = mysqli_query($conn, "SELECT * FROM t_barang WHERE id = '$id_barang'");
    if(mysqli_num_rows($query_cek) > 0){
        // hitung stok terbaru
        $data_barang_db = mysqli_fetch_assoc($query_cek);
        $stok_terbaru = $data_barang_db['stok'] - $jumlah;
        // jika stok minus
        if($stok_terbaru < 0){
            echo "<script> alert('Pengambilan barang melebihi jumlah stok barang'); </script>";
        }else{
            // jika id cocok maka insert data ke tabel pengambilan
            $sql    = "INSERT INTO t_pengambilan VALUES ('', '$id_barang', '$tgl_pengambilan', '$nama_pengambil', '$jumlah', '$keterangan')";
            if($conn->query($sql) === TRUE){
                // hitung inventory_value
                $inventory = $stok_terbaru * $data_barang_db['harga'];
                // update stok barang & inventory
                $sql2 = "UPDATE t_barang SET stok = '$stok_terbaru', inventory_value = '$inventory' WHERE id = '$id_barang'";
                if($conn->query($sql2) === TRUE){
                     // masukkan ke tabel stock opname
                     $sql3 = "INSERT INTO t_stock_opname VALUES ('','$id_barang', '$tgl_pengambilan', '$stok_terbaru', '$inventory')";
                     if($conn->query($sql3) === TRUE){
                         header('Location: ../index.php?menu=laporan');
                         die;
                     }else{
                         echo "Error: " . $sql3 . "<br>" . $conn->error;
                     }
                }else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }else{
        echo "<script> alert('Gagal pilih barang!'); </script>";
    }
}
