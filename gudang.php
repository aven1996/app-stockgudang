<div class="container">
        <div class="w-100 p-2 mt-4">
            <div class="border rounded-lg h-100 bg-white overflow-hidden">
                <!-- header stock barang -->
                <div class="d-flex justify-content-between align-items-center border-bottom bg-dark">
                    <div class="d-flex align-items-center p-3">
                        <img src="img/inventory.png" alt="Grafik Barang Masuk Keluar" class="mr-2" style="width: 30px;">
                        <h5 class="m-0 text-white">Daftar Barang</h5>
                    </div>
                    <div class="d-flex">
                        <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#ModalTambah" ><span class="icon-plus mr-1"></span> Tambah</button>
                        <button type="button" class="btn btn-warning mr-2" data-toggle="modal" data-target="#ModalAmbil"><span class="icon-new-tab mr-1"></span>Ambil</button>
                        <?php if(!isset($_GET['filter'])): ?>
                            <a href="?menu=gudang&filter=reorder" style="text-decoration:none;"><button type="button" class="btn btn-outline-danger mr-2"><span class="icon-filter mr-1"></span> Re-Order</button></a>
                        <?php else: ?>
                            <a href="?menu=gudang" style="text-decoration:none;"><button type="button" class="btn btn-danger mr-2"><span class="icon-filter mr-1"></span> Re-Order</button></a>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- body tabel  -->
                <div id="table_body" class="overflow-auto w-100 p-3" style="max-height: 470px;">
                    <table class="table table-hover" id="tabel_gudang" style="font-size: 11pt;">
                        <thead>
                            <tr>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Sumber Dana</th>
                                <th scope="col">Stok</th>
                                <th scope="col">Satuan</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Inventory Value</th>
                                <th scope="col">Tgl. Masuk</th>
                                <th scope="col">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php
                              if(!isset($_GET['filter'])){
                                $sql_barang = "SELECT * FROM t_barang INNER JOIN t_sumber_dana ON t_barang.id_sumber = t_sumber_dana.id_sumber INNER JOIN t_satuan ON t_barang.id_satuan = t_satuan.id_satuan ORDER BY t_barang.tgl_masuk DESC";
                              }else{
                                $sql_barang = "SELECT * FROM t_barang INNER JOIN t_sumber_dana ON t_barang.id_sumber = t_sumber_dana.id_sumber INNER JOIN t_satuan ON t_barang.id_satuan = t_satuan.id_satuan WHERE stok = 0 ORDER BY t_barang.tgl_masuk DESC";
                              }
                              $res_barang = mysqli_query($conn, $sql_barang);
                              if(mysqli_num_rows($res_barang) > 0){
                                while($brg = mysqli_fetch_assoc($res_barang)){
                          ?>

                            <tr <?php if($brg['stok'] == 0){echo "style='background-color: MistyRose;' ";}?>>
                                <td><?= $brg['nama_barang']; ?></td>
                                <td><?= $brg['sumber']; ?></td>
                                <td><?= $brg['stok']; ?></td>
                                <td><?= $brg['satuan']; ?></td>
                                <td><?= rupiah($brg['harga']); ?></td>
                                <td><?= rupiah($brg['inventory_value']); ?></td>
                                <td><?= $brg['tgl_masuk']; ?></td>
                                <td>
                                  <div style="width: 140px;">
                                    <button type="button" class="btn btn-success" title="Restock" data-toggle="modal" data-target="#ModalRestock<?= $brg['id']; ?>"><span class="icon-download2"></span></button>
                                    <button type="button" class="btn btn-info" title="Ubah" data-toggle="modal" data-target="#ModalEdit<?= $brg['id']; ?>"><span class="icon-pencil"></span></button>
                                    <button type="button" class="btn btn-danger" title="Hapus" data-toggle="modal" data-target="#ModalHapus<?= $brg['id']; ?>"><span class="icon-bin"></span></button>
                                  </div>
                                </td>
                            </tr>


                            <!-- Modal Edit Barang-->
                            <div class="modal fade" id="ModalEdit<?= $brg['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Barang</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <form action="modules/gudang.php" method="post">
                                        <input type="hidden" name="id" value="<?= $brg['id']; ?>">
                                        <div class="form-group">
                                            <label for="nama_barang">Nama Barang</label>
                                            <input type="text" name="nama_barang" class="form-control" id="nama_barang" placeholder="Masukkan nama barang" value="<?= $brg['nama_barang']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="tgl_masuk">Tanggal Masuk Barang</label>
                                            <input type="date" name="tgl_masuk" class="form-control" id="tgl_masuk" value="<?= $brg['tgl_masuk']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="sumber_dana_edit">Sumber Dana</label>
                                            <select name="sumber_dana" id="sumber_dana_edit" class="form-control">
                                              <?php 
                                                $sql = "SELECT * FROM t_sumber_dana";
                                                $query = mysqli_query($conn, $sql);
                                                if(mysqli_num_rows($query) > 0){
                                                  while($dana = mysqli_fetch_assoc($query)){
                                              ?>
                                                  <option value="<?= $dana['id_sumber']; ?>" <?= sttSelected($dana['id_sumber'], $brg['id_sumber']); ?>><?= $dana['sumber']; ?></option>
                                                <?php } ?>
                                              <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group d-flex">
                                            <div class="mr-3">
                                                <label for="stok">Stok</label>
                                                <input type="number" name="stok" class="form-control" id="stok" placeholder="Sisa stok barang" title="Edit stok di Restock" value="<?= $brg['stok']; ?>" readonly>
                                            </div>
                                            <div>
                                                <label for="satuan_edit">Satuan</label>
                                                <select name="satuan" id="satuan_edit" class="form-control">
                                                  <?php 
                                                    $sql_satuan_edit = "SELECT * FROM t_satuan";
                                                    $query_satuan_edit = mysqli_query($conn, $sql_satuan_edit);
                                                    if(mysqli_num_rows($query_satuan_edit) > 0){
                                                      while($satuan_edit = mysqli_fetch_assoc($query_satuan_edit)){
                                                  ?>
                                                    <option data-value="<?= $satuan_edit['satuan']; ?>" value="<?= $satuan_edit['id_satuan']; ?>" <?= sttSelected($satuan_edit['id_satuan'], $brg['id_satuan']); ?>><?= $satuan_edit['satuan']; ?></option>
                                                    <?php } ?>
                                                  <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="harga_barang">Harga Per <span id="label_satuan_edit">Satuan</span></label>
                                            <input type="number" name="harga" class="form-control" id="harga_barang" placeholder="Masukkan harga satuan barang" value="<?= $brg['harga']; ?>" >
                                        </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary" name="simpan_edit_barang">Simpan</button>
                                  </div>
                                  </form>
                                </div>
                              </div>
                            </div>

                            <!-- Modal ReStock-->
                            <div class="modal fade" id="ModalRestock<?= $brg['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Restock</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <form action="modules/gudang.php" method="post">
                                        <input type="hidden" name="id" value="<?= $brg['id']; ?>">
                                        <input type="hidden" name="stok_terakhir" value="<?= $brg['stok']; ?>">
                                        <input type="hidden" name="harga" value="<?= $brg['harga']; ?>">
                                        <span class="d-block mb-3 bg-warning p-2">Stok terakhir barang ini sejumlah <b><?= $brg['stok']; ?> <?= $brg['satuan']; ?></b></span>
                                        <div class="form-group">
                                            <label for="stok">Tambah stok barang</label>
                                            <input type="number" name="jml_tambahan" class="form-control" id="stok" placeholder="Masukkan jumlah tambahan barang">
                                        </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary" name="restock">Restock</button>
                                  </div>
                                  </form>
                                </div>
                              </div>
                            </div>

                            <!-- Modal Konfirmasi Hapus -->
                            <div class="modal fade" id="ModalHapus<?= $brg['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <form action="modules/gudang.php" method="post">
                                        <input type="hidden" name="id" value="<?= $brg['id']; ?>">
                                        <label for="">Apakah kamu ingin menghapus <b><?= $brg['nama_barang']; ?></b>?</label>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                    <button type="submit" class="btn btn-danger" name="hapus_barang">Hapus</button>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>

                              <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>


<!-- Modal Ambil Barang-->
<div class="modal fade" id="ModalAmbil" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Ambil Barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="modules/gudang.php" method="post">

            <input type="hidden" value="berisi id barang">

            <div class="form-group" id="cov_pilih_barang">
                <label for="pilih_barang">Pilih Barang</label>
                <input type="text" name="id" class="form-control" id="pilih_barang" placeholder="Masukkan nama barang" autocomplete="off" required>
                <!-- card barang terpilih -->
                <div id="ajax_gambar_dipilih"></div>
                <!-- result ajax saat nama barang diketikan -->
                <div id="result_ajax_ambil"></div>
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
                    <span id="satuan_ambil" class="py-1 px-3 text-dark rounded" style="background-color: lightgrey;" title="Satuan dapat diubah melalui form edit barang">Satuan</span>
                  </div>
            </div>

            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <input type="text" name="keterangan" class="form-control" id="keterangan" placeholder="Tambahkan keterangan seperti keperluan, lokasi, dst." required>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" name="ambil_barang" class="btn btn-warning">Ambil</button>
      </div>
      </form>
    </div>
  </div>
</div>


<!-- Modal Tambah Barang-->
<div class="modal fade" id="ModalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="modules/gudang.php" method="post">
            <div class="form-group">
                <label for="nama_barang">Nama Barang</label>
                <input type="text" name="nama_barang" class="form-control" id="nama_barang" placeholder="Masukkan nama barang" required>
            </div>
            <div class="form-group">
                <label for="tgl_masuk">Tanggal Masuk Barang</label>
                <input type="date" name="tgl_masuk" class="form-control" id="tgl_masuk" value="<?= date('Y-m-d'); ?>">
            </div>
            <div class="form-group">
                <label for="sumber_dana">Sumber Dana</label>
                <select name="sumber_dana" id="sumber_dana" class="form-control">
                    <?php 
                        $sql = "SELECT * FROM t_sumber_dana";
                        $query = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($query) > 0){
                          while($dana = mysqli_fetch_assoc($query)){
                      ?>
                        <option value="<?= $dana['id_sumber']; ?>"><?= $dana['sumber']; ?></option>
                        <?php } ?>
                      <?php } ?>
                </select>
            </div>
            <div class="form-group d-flex">
                <div class="mr-3">
                    <label for="stok">Stok</label>
                    <input type="number" name="stok" class="form-control" id="stok" placeholder="Sisa stok barang" required>
                </div>
                <div>
                    <label for="satuan">Satuan</label>
                    <select name="satuan" id="satuan" class="form-control">
                      <?php 
                        $sql_tbh = "SELECT * FROM t_satuan";
                        $query_tbh = mysqli_query($conn, $sql_tbh);
                        if(mysqli_num_rows($query_tbh) > 0){
                          while($satuan_tbh = mysqli_fetch_assoc($query_tbh)){
                      ?>
                        <option data-value="<?= $satuan_tbh['satuan']; ?>" value="<?= $satuan_tbh['id_satuan']; ?>"><?= $satuan_tbh['satuan']; ?></option>
                        <?php } ?>
                      <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="harga_barang">Harga Per <span id="label_satuan">Satuan</span></label>
                <input type="text" name="harga" class="form-control" id="harga_barang" placeholder="Masukkan harga satuan barang" required>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" name="tambah_barang" class="btn btn-primary">Tambah</button>
      </div>
      </form>
    </div>
  </div>
</div>










