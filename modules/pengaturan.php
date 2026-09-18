<?php

include "connection.php";
include "functions.php";

// Tambah Sumber Dana
if(isset($_POST['tambah_dana'])){
  $sumber = trim(htmlspecialchars($_POST['sumber_dana']));
  $warna = trim(htmlspecialchars($_POST['warna']));

  $sql = "INSERT INTO t_sumber_dana (id_sumber, sumber, warna) VALUES ('', '$sumber', '$warna')";

  if ($conn->query($sql) === TRUE) {
    header('Location: ../index.php?menu=pengaturan');
    die;
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}


// Tambah Satuan
if(isset($_POST['tambah_satuan'])){
    $satuan = trim(htmlspecialchars($_POST['nama_satuan']));
  
    $sql = "INSERT INTO t_satuan (id_satuan, satuan) VALUES ('', '$satuan')";
  
    if ($conn->query($sql) === TRUE) {
      header('Location: ../index.php?menu=pengaturan');
      die;
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }

// Edit Sumber Dana
if(isset($_POST['simpan_sumber_dana'])){
  $id     = $_POST['id'];
  $sumber = trim(htmlspecialchars($_POST['sumber_dana']));
  $warna  = trim(htmlspecialchars($_POST['warna_bg']));

  $sql = "UPDATE t_sumber_dana 
          SET sumber  = '$sumber', warna  = '$warna'
          WHERE id_sumber = '$id' ";
  
    if ($conn->query($sql) === TRUE) {
      header('Location: ../index.php?menu=pengaturan');
      die;
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Edit Satuan
if(isset($_POST['simpan_satuan'])){
  $id     = $_POST['id'];
  $satuan = trim(htmlspecialchars($_POST['satuan']));

  $sql = "UPDATE t_satuan 
          SET satuan  = '$satuan'
          WHERE id_satuan = '$id' ";
  
    if ($conn->query($sql) === TRUE) {
      header('Location: ../index.php?menu=pengaturan');
      die;
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Hapus Sumber Dana
if(isset($_POST['hapus_sumber'])){
  $id   = $_POST['id'];

  $sql  = "DELETE FROM t_sumber_dana WHERE id_sumber = '$id'";
  
    if ($conn->query($sql) === TRUE) {
      header('Location: ../index.php?menu=pengaturan');
      die;
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Hapus Satuan
if(isset($_POST['hapus_satuan'])){
  $id   = $_POST['id'];

  $sql  = "DELETE FROM t_satuan WHERE id_satuan = '$id'";
  
    if ($conn->query($sql) === TRUE) {
      header('Location: ../index.php?menu=pengaturan');
      die;
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Simpan Data Profil
if(isset($_POST['simpan_data_sekolah'])){
  
  $namaSekolah      = trim(htmlspecialchars($_POST['nama_sekolah']));
  $kepalaSekolah    = trim(htmlspecialchars($_POST['nama_kepala_sekolah']));
  $NIPkepalaSekolah = trim(htmlspecialchars($_POST['nip_kepala_sekolah']));
  $kepalaTU         = trim(htmlspecialchars($_POST['nama_kepala_tu']));
  $NIPkepalaTU      = trim(htmlspecialchars($_POST['nip_kepala_tu']));
  $petugasGudang    = trim(htmlspecialchars($_POST['nama_petugas']));
  $NIPpetugasGudang = trim(htmlspecialchars($_POST['nip_petugas']));
  // kepala sekolah masih disabled
  $ttdKepalaSekolah = "";
  $ttdKepalaTU      = $_FILES['ttd_kepala_tu']['name'];
  $ttdPetugas       = $_FILES['ttd_petugas']['name'];

  // parse json file
  $json_file = file_get_contents("../data_sekolah.json");
  $json_parsed = json_decode($json_file,true);

  // cek yang upload file ttd ada yang kosong atau tidak
  if(!empty($ttdKepalaSekolah)){
    // kepala sekolah masih disabled 
  }

  if(!empty($ttdKepalaTU)){
    $file_ttd_kepalaTU_sebelumnya = $json_parsed['ttdKepalaTU'];
    $ttdKepalaTU = upload_ttd($file_ttd_kepalaTU_sebelumnya,"ttd_kepala_tu");
  }else{
    $ttdKepalaTU = $json_parsed['ttdKepalaTU'];
  }

  if(!empty($ttdPetugas)){
    $file_ttd_Petugas_sebelumnya = $json_parsed['ttdPetugas'];
    $ttdPetugas = upload_ttd($file_ttd_Petugas_sebelumnya,"ttd_petugas");
  }else{
    $ttdPetugas = $json_parsed['ttdPetugas'];
  }


  // ganti data
  $json_parsed['NamaSekolah']       = $namaSekolah;
  $json_parsed['KepalaSekolah']     = $kepalaSekolah;
  $json_parsed['NIPKepalaSekolah']  = $NIPkepalaSekolah;
  $json_parsed['KepalaTU']          = $kepalaTU;
  $json_parsed['NIPKepalaTU']       = $NIPkepalaTU;
  $json_parsed['PetugasGudang']     = $petugasGudang;
  $json_parsed['NIPPetugasGudang']  = $NIPpetugasGudang;
  $json_parsed['ttdKepalaSekolah']  = $ttdKepalaSekolah;
  $json_parsed['ttdKepalaTU']       = $ttdKepalaTU;
  $json_parsed['ttdPetugas']        = $ttdPetugas;

  // Mengencode data menjadi json
  $json_baru  = json_encode($json_parsed, JSON_PRETTY_PRINT);

  // Menyimpan data ke file json
  if(file_put_contents("../data_sekolah.json", $json_baru) == TRUE){
    header('Location: ../index.php?menu=pengaturan');
  }
}



// simpan logo
if(isset($_POST['simpan_logo'])){
  // parse json file
  $json_file = file_get_contents("../data_sekolah.json");
  $json_parsed = json_decode($json_file,true);
  $gambar_lama = $json_parsed['pathlogo'];

  $logo = upload_poto($gambar_lama);

  // kita cek photonya kosong atau tidak
  if(!empty($logo)){
    // update data
    $json_parsed['pathlogo']  = $logo;

    // Mengencode data menjadi json 
    $json_baru  = json_encode($json_parsed, JSON_PRETTY_PRINT);

    // Menyimpan data ke file json
    if(file_put_contents("../data_sekolah.json", $json_baru) == TRUE){
      header('Location: ../index.php?menu=pengaturan');
    }

  }else{
    echo "<script> alert('Upload Gagal!'); </script>";
  }
}

// simpan kop
if(isset($_POST['simpan_kop'])){
  // parse json file
  $json_file = file_get_contents("../data_sekolah.json");
  $json_parsed = json_decode($json_file,true);
  $gambar_lama = $json_parsed['pathkop']; 

  $kop = upload_poto($gambar_lama);

  // kita cek photonya kosong atau tidak
  if(!empty($kop)){
    // update data
    $json_parsed['pathkop']  = $kop;

    // Mengencode data menjadi json 
    $json_baru  = json_encode($json_parsed, JSON_PRETTY_PRINT);

    // Menyimpan data ke file json
    if(file_put_contents("../data_sekolah.json", $json_baru) == TRUE){
      header('Location: ../index.php?menu=pengaturan');
    }

  }else{
    echo "<script> alert('Upload Gagal!'); </script>";
  }
}



// tambah akun admin
if(isset($_POST['tambah_akun'])){
  $user   = trim(htmlspecialchars($_POST['username']));
  $pass   = trim(htmlspecialchars($_POST['password']));
  // cek kesamaan user dalam db
  $res_user = mysqli_query($conn, "SELECT username FROM t_akun WHERE username = '$user'");
  if(mysqli_num_rows($res_user) > 0){
    echo "<script> alert('Username tidak tersedia. Silahkan ganti dengan nama yang lain!'); </script>";
  }else{
    $passx = password_hash($pass, PASSWORD_DEFAULT);
    $sql = "INSERT INTO t_akun VALUES ('','$user','$passx','admin')";
    if($conn->query($sql) === TRUE){
      header('Location: ../index.php?menu=pengaturan');
      die;
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
}


// hapus akun admin
if(isset($_POST['hapus_akun'])){
  $id = $_POST['id_akun'];

  $sql = "DELETE FROM t_akun WHERE id_akun = '$id'";
  if($conn->query($sql) === TRUE){
    header('Location: ../index.php?menu=pengaturan');
    die;
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

}
?>