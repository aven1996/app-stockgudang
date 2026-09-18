


<div class="container">
        
        <div class="w-100 p-2 mt-4 d-flex align-items-stretch">
            <!-- Sumber Dana -->
            <div class="border rounded-lg bg-white overflow-hidden w-50 mr-2">
                <!-- header sumber dana -->
                <div class="d-flex justify-content-between align-items-center border-bottom bg-dark">
                    <div class="d-flex align-items-center p-3">
                        <h5 class="m-0 text-white">Sumber Dana</h5>
                    </div>
                    <div class="d-flex">
                        <a href="#" class="p-3 text-white" style="text-decoration: none;" data-toggle="modal" data-target="#ModalTambahSumberDana"><span class="icon-plus mr-1"></span></a>
                    </div>
                </div>
                <!-- body sumber dana -->
                <div class="d-flex flex-wrap p-3">
                  <?php
                    $resSumber = mysqli_query($conn, "SELECT * FROM t_sumber_dana");
                    if(mysqli_num_rows($resSumber) > 0){
                      while($row = mysqli_fetch_assoc($resSumber)){
                  ?>  
                        <!-- Data Sumber Dana -->
                        <div class="d-flex justify-content-center align-items-center p-2 mr-2 mb-2 text-white rounded-lg" style="background-color: <?= $row['warna']; ?>;">
                            <span class="mr-3"><?= $row['sumber']; ?></span>
                            <a href="#" title="Edit" class="p-1 text-white mr-1" data-toggle="modal" data-target="#ModalEditSumberDana<?= $row['id_sumber']; ?>" style="text-decoration: none;"><b class="icon-pencil"></b></a>
                            <a href="#" title="Hapus" class="p-1 text-white" data-toggle="modal" data-target="#ModalHapusSumberDana<?= $row['id_sumber']; ?>" style="text-decoration: none;"><b class="icon-bin"></b></a>
                        </div>
                        <!-- Modal Edit Sumber Dana-->
                        <div class="modal fade" id="ModalEditSumberDana<?= $row['id_sumber']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Edit Sumber Dana</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form action="modules/pengaturan.php" method="post">
                                    <input type="hidden" name="id" value="<?= $row['id_sumber']; ?>">
                                    <div class="form-group">
                                        <label for="sumber_dana">Sumber Dana</label>
                                        <input type="text" class="form-control" id="sumber_dana" name="sumber_dana" placeholder="Masukkan sumber dana" value="<?= $row['sumber']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="warna_bg">Warna Background</label>
                                        <input type="color" class="form-control w-25" id="warna_bg" name="warna_bg" value="<?= $row['warna']; ?>" autofocus="autofocus">
                                    </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary" name="simpan_sumber_dana">Simpan</button>
                              </div>
                              </form>
                            </div>
                          </div>
                        </div>

                        <!-- Modal Konfirmasi Hapus Sumber Dana -->
                        <div class="modal fade" id="ModalHapusSumberDana<?= $row['id_sumber']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form action="modules/pengaturan.php" method="post">
                                    <input type="hidden" name="id" value="<?= $row['id_sumber']; ?>">
                                    <label for="">Apakah kamu ingin menghapus data sumber dana ini?</label>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                <button type="submit" class="btn btn-danger" name="hapus_sumber">Hapus</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                  <?php 
                      }
                    }else{
                  ?>
                    <div>Data tidak ada</div>
                  <?php
                    }
                  ?>
                </div>
            </div>
            <!-- Daftar Satuan -->
            <div class="border rounded-lg bg-white overflow-hidden w-50">
                <!-- header satuan -->
                <div class="d-flex justify-content-between align-items-center border-bottom bg-dark">
                    <div class="d-flex align-items-center p-3">
                        <h5 class="m-0 text-white">Satuan</h5>
                    </div>
                    <div class="d-flex">
                        <a href="#" class="p-3 text-white" style="text-decoration: none;" data-toggle="modal" data-target="#ModalTambahSatuan"><span class="icon-plus mr-1"></span></a>
                    </div>
                </div>
                <!-- body Satuan-->
                <div class="d-flex flex-wrap p-3">
                  <?php 
                    $resSatuan = mysqli_query($conn, "SELECT * FROM t_satuan");
                    if(mysqli_num_rows($resSatuan) > 0){
                      while($row = mysqli_fetch_assoc($resSatuan)){
                  ?>
                        <!-- Data Satuan -->
                        <div class="d-flex justify-content-center align-items-center p-2 mr-2 mb-2 bg-secondary text-white rounded-lg">
                            <span class="mr-3"><?= $row['satuan']; ?></span>
                            <a href="#" title="Edit" class="p-1 text-white mr-1" style="text-decoration: none;" data-toggle="modal" data-target="#ModalEditSatuan<?= $row['id_satuan']; ?>"><b class="icon-pencil"></b></a>
                            <a href="#" title="Hapus" class="p-1 text-white" style="text-decoration: none;" data-toggle="modal" data-target="#ModalHapusSatuan<?= $row['id_satuan']; ?>"><b class="icon-bin"></b></a>
                        </div>

                        <!-- Modal Edit Satuan-->
                        <div class="modal fade" id="ModalEditSatuan<?= $row['id_satuan']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Edit Satuan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form action="modules/pengaturan.php" method="post">
                                    <input type="hidden" name="id" value="<?= $row['id_satuan']; ?>">
                                    <div class="form-group">
                                        <label for="satuan">Nama Satuan</label>
                                        <input type="text" class="form-control" id="satuan" placeholder="Masukkan nama satuan" name="satuan" value="<?= $row['satuan']; ?>" autofocus="autofocus">
                                    </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary" name="simpan_satuan">Simpan</button>
                              </div>
                              </form>
                            </div>
                          </div>
                        </div>
                        
                        <!-- Modal Konfirmasi Hapus Satuan -->
                        <div class="modal fade" id="ModalHapusSatuan<?= $row['id_satuan']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form action="modules/pengaturan.php" method="post">
                                    <input type="hidden" name="id" value="<?= $row['id_satuan']; ?>">
                                    <label for="">Apakah kamu ingin menghapus data satuan ini?</label>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                <button type="submit" class="btn btn-danger" name="hapus_satuan">Hapus</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>

                  <?php 
                      }
                    }else{ 
                  ?>
                    <div>Data tidak ada</div>
                  <?php }?>
                </div>
            </div>
        </div>

        <!-- Data Sekolah -->
        <div class="p-2">
            <div class="border rounded-lg h-100 bg-white overflow-hidden">
                <!-- header data sekolah -->
                <div class="d-flex justify-content-between align-items-center border-bottom bg-dark">
                    <div class="d-flex align-items-center p-3">
                        <h5 class="m-0 text-white">Data Sekolah</h5>
                    </div>
                </div>
                <!-- body data sekolah-->
                <form action="modules/pengaturan.php" enctype="multipart/form-data" method="post" class="p-3">
                    <!-- Nama Sekolah -->
                    <div class="form-group">
                        <label for="nama_sekolah">Nama Sekolah</label>
                        <input type="text" name="nama_sekolah" id="nama_sekolah" class="form-control" placeholder="Masukkan nama sekolah" value="<?= $json_parse['NamaSekolah']; ?>" required>
                    </div> 
                    <!-- Kepala Sekolah -->
                    <div class="form-group">
                        <label for="kepala_sekolah">Kepala Sekolah</label>
                        <div class="form-row">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Nama lengkap" id="kepala_sekolah" name="nama_kepala_sekolah" value="<?= $json_parse['KepalaSekolah']; ?>" required>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="NIP" name="nip_kepala_sekolah" value="<?= $json_parse['NIPKepalaSekolah']; ?>" required>
                            </div>
                            <div class="col">
                                <input type="file" class="form-control" name="ttd_kepala_sekolah" title="Upload File Paraf Kepala Sekolah" disabled>
                            </div>
                        </div>
                    </div>
                    <!-- Kepala Tata Usaha (TU) -->
                    <div class="form-group">
                        <label for="kepala_tu">Kepala Tata Usaha (TU)</label>
                        <div class="form-row">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Nama lengkap" id="kepala_tu" name="nama_kepala_tu" value="<?= $json_parse['KepalaTU']; ?>" required>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="NIP" name="nip_kepala_tu" value="<?= $json_parse['NIPKepalaTU']; ?>" required>
                            </div>
                            <div class="col">
                                <input type="file" class="form-control" name="ttd_kepala_tu" title="Upload File Paraf Kepala TU">
                            </div>
                        </div>
                    </div>
                    <!-- Petugas Gudang -->
                    <div class="form-group">
                        <label for="petugas">Petugas Gudang</label>
                        <div class="form-row">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Nama lengkap" id="petugas" name="nama_petugas" value="<?= $json_parse['PetugasGudang']; ?>" required>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="NIP" name="nip_petugas" value="<?= $json_parse['NIPPetugasGudang']; ?>" required>
                            </div>
                            <div class="col">
                                <input type="file" class="form-control" name="ttd_petugas" title="Upload File Paraf Petugas">
                            </div>
                        </div>
                    </div>
                    <!-- tombol simpan -->
                    <button type="submit" name="simpan_data_sekolah" class="btn btn-primary p-2">Simpan</button>
                </form>
            </div>
        </div>

        <!-- Logo dan Kop Sekolah -->
        <div class="p-2">
            <div class="border rounded-lg h-100 bg-white overflow-hidden">
                <!-- header -->
                <div class="d-flex justify-content-between align-items-center border-bottom bg-dark">
                    <div class="d-flex align-items-center p-3">
                        <h5 class="m-0 text-white">Logo Sekolah</h5>
                    </div>
                </div>
                <!-- body-->
                <div class="w-100 d-flex align-items-strecth">
                    <!-- logo -->
                    <form action="modules/pengaturan.php" method="post" enctype="multipart/form-data" class="p-3 w-25 border">
                        <label for="">Logo & Kop Sekolah</label>
                        <label for="logo" >
                            <img src="img/logo_kop/<?= $json_parse['pathlogo']; ?>" alt="Logo Sekolah" class="w-100">
                        </label>
                        <input type="file" class="form-control mb-2" id="logo" name="file_kop_logo" required>
                        <button type="submit" name="simpan_logo" class="btn btn-primary">Simpan Logo</button>
                    </form>
                    <!-- kop -->
                    <form action="modules/pengaturan.php" method="post"  enctype="multipart/form-data" class="p-3 w-75 border" >
                        <label for="">Kop Sekolah</label>
                        <label for="kop" >
                            <img src="img/logo_kop/<?= $json_parse['pathkop']; ?>" alt="Kop Sekolah" class="w-100">
                        </label>
                        <input type="file" class="form-control mb-2" id="kop" name="file_kop_logo" required>
                        <button type="submit" name="simpan_kop" class="btn btn-primary" >Simpan Kop</button>
                    </form>
                </div>
            </div>
        </div>


        <!-- Akun Admin -->
        <div class="p-2">
            <div class="border rounded-lg h-100 bg-white overflow-hidden">
                <!-- header Akun Admin -->
                <div class="d-flex justify-content-between align-items-center border-bottom bg-dark">
                    <div class="d-flex align-items-center p-3">
                        <h5 class="m-0 text-white">Akun Admin</h5>
                    </div>
                    <div class="d-flex">
                        <a href="#" class="p-3 text-white" style="text-decoration: none;" data-toggle="modal" data-target="#ModalTambahAkun"><span class="icon-plus mr-1"></span></a>
                    </div>
                </div>
                <!-- body Akun Admin-->
                <div class="w-100 p-3">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">Username</th>
                        <th scope="col">Password</th>
                        <th scope="col">Tindakan</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $sql_akun = mysqli_query($conn, "SELECT * FROM t_akun");
                        if(mysqli_num_rows($sql_akun) > 0):
                          while($a = mysqli_fetch_assoc($sql_akun)):
                      ?>
                      <tr>
                        <td><?= $a['username']; ?></td>
                        <td>******</td>
                        <td>
                          <!-- <button type="button" class="btn btn-success">Edit</button> -->
                          <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#ModalHapusAkun<?= $a['id_akun']; ?>">Hapus</button>
                          <?php 
                            if($a['username'] == $_SESSION['akun']){
                          ?>
                            <a href="modules/logout.php"><button type="button" class="btn btn-danger" data-toggle="modal">Logout</button></a>
                          <?php 
                            }
                          ?>
                        </td>
                      </tr>


                      <!-- Modal Konfirmasi Hapus Akun -->
                      <div class="modal fade" id="ModalHapusAkun<?= $a['id_akun']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form action="modules/pengaturan.php" method="post">
                                    <input type="hidden" name="id_akun" value="<?= $a['id_akun']; ?>">
                                    <label for="">Apakah kamu ingin menghapus data Akun ini?</label>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                <button type="submit" class="btn btn-danger" name="hapus_akun">Hapus</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>


                      <?php endwhile; else: ?>
                        <tr>
                          <td class="text-center text-secondary" colspan="3">Tidak ada data</td>
                        </tr>
                      <?php endif; ?>
                    </tbody>
                  </table>

                     
                </div>
            </div>
        </div>
</div>











<!-- Modal Tambah Sumber Dana-->
<div class="modal fade" id="ModalTambahSumberDana" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Sumber Dana</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="modules/pengaturan.php" method="post">
            <div class="form-group">
                <label for="sumber_dana">Sumber Dana</label>
                <input type="text" name="sumber_dana" class="form-control" id="sumber_dana" placeholder="Masukkan sumber dana" autofocus="autofocus" required >
            </div>
            <div class="form-group">
                <label for="warna_bg">Warna Background</label>
                <input type="color" name="warna" class="form-control w-25" id="warna_bg" value="#ff0000" required>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" name="tambah_dana" class="btn btn-primary">Tambah</button>
      </div>
      </form>
    </div>
  </div>
</div>


<!-- Modal Tambah Satuan-->
<div class="modal fade" id="ModalTambahSatuan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Satuan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="modules/pengaturan.php" method="post">
            <div class="form-group">
                <label for="satuan">Nama Satuan</label>
                <input type="text" class="form-control" id="satuan" placeholder="Masukkan nama satuan" name="nama_satuan" autofocus="autofocus" required>
            </div>
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" name="tambah_satuan">Tambah</button>
      </div>
      </form>
    </div>
  </div>
</div>



<!-- Modal Tambah Akun Admin-->
<div class="modal fade" id="ModalTambahAkun" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Akun</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="modules/pengaturan.php" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="username" class="form-control" id="username" placeholder="Masukkan username" name="username" autofocus="autofocus" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Masukkan password" name="password" autofocus="autofocus" required>
            </div>
            <div class="form-group">
                <label for="ulangi_password">Ulangi Password</label>
                <input type="password" class="form-control" id="ulangi_password" placeholder="Masukkan ulang password" name="ulangi_password" autofocus="autofocus" required>
                <span class="text-danger small" id="notif_pass">Password tidak cocok</span>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" name="tambah_akun" id="btn_addAkun" disabled>Tambah</button>
      </div>
      </form>
    </div>
  </div>
</div>



