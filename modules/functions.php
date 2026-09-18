<?php


// cek stt menu
function cekSttMenu($menu, $url){
    if($menu == $url){
        return "active";
    }else{
        return "";
    }
}


// upload logo dan kop
function upload_poto($gambar_lama){

    $nama_poto = $_FILES['file_kop_logo']['name'];
    $size_poto = $_FILES['file_kop_logo']['size'];
    $error_poto = $_FILES['file_kop_logo']['error'];
    $lok_smt = $_FILES['file_kop_logo']['tmp_name'];

    // ekstensi file yang diperbolehkan
    $ekstensi_yang_boleh = ['jpg','jpeg','png','JPG','JPEG','PNG'];

    // cari extensi file yang diupload
    // nama poto kita pecah menjadi array
    $nama_poto_array = explode(".",$nama_poto);
    // ambil isi array pada index terakhir
    $ekstensi_file_yang_diupload = end($nama_poto_array);

    // cek error atau tidak
    if($error_poto === 4){
      echo "<script> alert('File yang kamu upload error'); </script>";
    // cek format file sesuai atau tidak
    }elseif(!in_array($ekstensi_file_yang_diupload, $ekstensi_yang_boleh)){
      echo "<script> alert('File yang kamu upload bukan gambar!'); </script>";
    // cek size poto apakah lebih besar dari 2 mb
    }elseif($size_poto > 2000000){
      echo "<script> alert('File yang kamu harus kurang 2 MB'); </script>";
    }else{
      // cek kesamaan nama
      if($gambar_lama == $nama_poto){
        // jika ada kesamaan kita cari tau index terakhir (index yang berisikan ekstensi)
        $index_ekstensi = array_search($ekstensi_file_yang_diupload, $nama_poto_array);
        // lakukan hapus nilai array berdasarkan indexnya
        unset($nama_poto_array[$index_ekstensi]);
        // berikan angka random dalam nama yang baru
        $nama_poto = implode(".", $nama_poto_array)."_".rand(1, 1000).".".$ekstensi_file_yang_diupload;
      }

      // pindahkan file
      move_uploaded_file($lok_smt, "../img/logo_kop/".$nama_poto);
      return $nama_poto;
    }
  }


// upload ttd di invoice pengambilan barang
function upload_ttd($gambar_lama, $nama_form){

  $nama_poto  = $_FILES[$nama_form]['name'];
  $size_poto  = $_FILES[$nama_form]['size'];
  $error_poto = $_FILES[$nama_form]['error'];
  $lok_smt    = $_FILES[$nama_form]['tmp_name'];

  // ekstensi file yang diperbolehkan
  $ekstensi_yang_boleh = ['jpg','jpeg','png','JPG','JPEG','PNG'];

  // cari extensi file yang diupload
  // nama poto kita pecah menjadi array
  $nama_poto_array = explode(".",$nama_poto);
  // ambil isi array pada index terakhir
  $ekstensi_file_yang_diupload = end($nama_poto_array);

  // cek error atau tidak
  if($error_poto === 4){
    echo "<script> alert('File yang kamu upload error'); </script>";
  // cek format file sesuai atau tidak
  }elseif(!in_array($ekstensi_file_yang_diupload, $ekstensi_yang_boleh)){
    echo "<script> alert('File yang kamu upload bukan gambar!'); </script>";
  // cek size poto apakah lebih besar dari 2 mb
  }elseif($size_poto > 2000000){
    echo "<script> alert('File yang kamu harus kurang 2 MB'); </script>";
  }else{
    // cek kesamaan nama
    if($gambar_lama == $nama_poto){
      // jika ada kesamaan kita cari tau index terakhir (index yang berisikan ekstensi)
      $index_ekstensi = array_search($ekstensi_file_yang_diupload, $nama_poto_array);
      // lakukan hapus nilai array berdasarkan indexnya (kita hapus ekstensinya)
      unset($nama_poto_array[$index_ekstensi]);
      // berikan angka random dalam nama yang baru
      $nama_poto = implode(".", $nama_poto_array)."_".rand(1, 1000).".".$ekstensi_file_yang_diupload;
    }

    // pindahkan file
    move_uploaded_file($lok_smt, "../img/ttd/".$nama_poto);
    return $nama_poto;
  }
}

  // Ambil data dari database all data
  function getAll($db){
    global $conn;
    $sql = "SELECT * FROM $db";
    if($conn->query($sql) === TRUE){
      $res = $conn->query($sql);
      $data = [];
      while($rows = $res->fetch_assoc()){
        $data[] = $rows;
      }
      return $data;
    }else{
      return "Error: " . $sql . "<br>" . $conn->error;
    }
  }


// konversi rupiah
function rupiah($angka){
  return "Rp".number_format($angka,0,'.','.');
}


// Menentukan pilihan yang terseleksi
function sttSelected($opt, $data){
    if($opt == $data){
      return "selected";
    }
}


