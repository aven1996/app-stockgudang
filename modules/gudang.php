<?php
include "connection.php";
include "functions.php";



// tambah barang
if(isset($_POST['tambah_barang'])){
    $id_satuan      = $_POST['satuan'];
    $id_sumber      = $_POST['sumber_dana'];
    $nama_barang    = trim(htmlspecialchars($_POST['nama_barang']));
    $stok           = trim(htmlspecialchars($_POST['stok']));
    $harga          = trim(htmlspecialchars($_POST['harga']));
    $tgl_masuk      = trim(htmlspecialchars($_POST['tgl_masuk']));
    $inventory      = $harga*$stok;

    $sql            = "INSERT INTO t_barang VALUES ('','$id_sumber','$id_satuan','$nama_barang','$stok','$harga','$tgl_masuk','$inventory')";
    
    if($conn->query($sql) === TRUE){ 
        // masukkan ka tabel masuk barang
        $ambil_id   = mysqli_query($conn, "SELECT MAX(id) FROM t_barang");
        $ambil_id   = mysqli_fetch_assoc($ambil_id);
        $id_terbaru = $ambil_id['MAX(id)'];

        // query insert ke tabel masuk barang
        $sql2       = "INSERT INTO t_masuk_barang VALUES ('','$id_terbaru', '$tgl_masuk', '$stok', 'add')";
        // masukkan ke tabel stock opname
        $sql3 = "INSERT INTO t_stock_opname VALUES ('','$id_terbaru', '$tgl_masuk', '$stok', '$inventory')";
        if($conn->query($sql2) === TRUE AND $conn->query($sql3) === TRUE){
            header('Location: ../index.php?menu=gudang');
            die;
        }else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// edit barang
if(isset($_POST['simpan_edit_barang'])){
    $id             = $_POST['id'];
    $id_satuan      = $_POST['satuan'];
    $id_sumber      = $_POST['sumber_dana'];
    $nama_barang    = trim(htmlspecialchars($_POST['nama_barang']));
    $tgl_masuk      = trim(htmlspecialchars($_POST['tgl_masuk']));
    $harga          = trim(htmlspecialchars($_POST['harga']));
    $stok           = $_POST['stok'];
    $inventory      = $harga * $stok;

    $sql            = "UPDATE t_barang 
                        SET id_satuan = '$id_satuan', id_sumber = '$id_sumber', nama_barang = '$nama_barang', tgl_masuk = '$tgl_masuk', harga = '$harga', inventory_value = '$inventory' 
                        WHERE id = '$id' ";

    if($conn->query($sql) === TRUE){
        // masukkan ke tabel stock opname
        $sql3 = "INSERT INTO t_stock_opname VALUES ('','$id', '$tgl_masuk', '$stok', '$inventory')";
        if($conn->query($sql3) === TRUE){
            header('Location: ../index.php?menu=gudang');
            die;
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


// restock
if(isset($_POST['restock'])){
    $id              = $_POST['id'];
    $tambahan_stok   = trim(htmlspecialchars($_POST['jml_tambahan']));
    $stok_terakhir   = $_POST['stok_terakhir'];
    $harga           = $_POST['harga'];
    $stok_terbaru    = $stok_terakhir + $tambahan_stok;
    $inventory       = $harga * $stok_terbaru;
    

    $sql        = "UPDATE t_barang 
                    SET stok = '$stok_terbaru', inventory_value = '$inventory'
                    WHERE id = '$id'";

    if($conn->query($sql) === TRUE){
        // masukkan ka tabel masuk barang
        // query insert ke tabel masuk barang
        $sql2       = "INSERT INTO t_masuk_barang VALUES ('','$id', NOW(), '$tambahan_stok', 'restock')";
        // masukkan ke tabel stock opname
        $sql3       = "INSERT INTO t_stock_opname VALUES ('','$id', NOW(), '$stok_terbaru', '$inventory')";
        if($conn->query($sql2) === TRUE AND $conn->query($sql3) === TRUE){
            header('Location: ../index.php?menu=gudang');
            die;
        }else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


// hapus barang
if(isset($_POST['hapus_barang'])){
    $id         = $_POST['id'];
    
    $sql        = "DELETE FROM t_barang WHERE id = '$id'";

    if($conn->query($sql) === TRUE){
        header('Location: ../index.php?menu=gudang');
        die;
    }else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}



// ambil barang
if(isset($_POST['ambil_barang'])){
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
                        header('Location: ../index.php?menu=gudang');
                        die;
                    }else{
                        echo "Error: " . $sql3 . "<br>" . $conn->error;
                    }
                }else{
                    echo "Error: " . $sql2 . "<br>" . $conn->error;
                }
            }else{
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }else{
        echo "<script> alert('Gagal pilih barang!'); </script>";
    }
}


?>