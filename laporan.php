<div class="container">
        <div class="w-100 p-2 mt-4">
            <div class="border rounded-lg h-100 bg-white overflow-hidden">
                <!-- header stock barang -->
                <div class="d-flex justify-content-between align-items-center border-bottom bg-dark">
                    <div class="d-flex align-items-center p-3">
                        <img src="img/report.png" alt="Grafik Barang Masuk Keluar" class="mr-2" style="width: 30px;">
                        <h5 class="m-0 text-white">Laporan Pengambilan Barang</h5>
                    </div>
                    <div class="d-flex">
                        <select name="bulan_pengambilan" id="bulan_pengambilan" class="form-control mr-2" style="width: 150px;">
                            <?php
                                if(!isset($_GET['bln'])){
                            ?>
                                <option value="">All</option>
                                <option value="01" <?= sttSelected("01",date("m")); ?>>Januari</option>
                                <option value="02" <?= sttSelected("02",date("m")); ?>>Februari</option>
                                <option value="03" <?= sttSelected("03",date("m")); ?>>Maret</option>
                                <option value="04" <?= sttSelected("04",date("m")); ?>>April</option>
                                <option value="05" <?= sttSelected("05",date("m")); ?>>Mei</option>
                                <option value="06" <?= sttSelected("06",date("m")); ?>>Juni</option>
                                <option value="07" <?= sttSelected("07",date("m")); ?>>Juli</option>
                                <option value="08" <?= sttSelected("08",date("m")); ?>>Agustus</option>
                                <option value="09" <?= sttSelected("09",date("m")); ?>>September</option>
                                <option value="10" <?= sttSelected("10",date("m")); ?>>Oktober</option>
                                <option value="11" <?= sttSelected("11",date("m")); ?>>November</option>
                                <option value="12" <?= sttSelected("12",date("m")); ?>>Desember</option>
                            <?php   
                                }elseif(isset($_GET['bln'])){
                            ?>
                                <option value="">All</option>
                                <option value="01" <?= sttSelected("01",$_GET['bln']); ?>>Januari</option>
                                <option value="02" <?= sttSelected("02",$_GET['bln']); ?>>Februari</option>
                                <option value="03" <?= sttSelected("03",$_GET['bln']); ?>>Maret</option>
                                <option value="04" <?= sttSelected("04",$_GET['bln']); ?>>April</option>
                                <option value="05" <?= sttSelected("05",$_GET['bln']); ?>>Mei</option>
                                <option value="06" <?= sttSelected("06",$_GET['bln']); ?>>Juni</option>
                                <option value="07" <?= sttSelected("07",$_GET['bln']); ?>>Juli</option>
                                <option value="08" <?= sttSelected("08",$_GET['bln']); ?>>Agustus</option>
                                <option value="09" <?= sttSelected("09",$_GET['bln']); ?>>September</option>
                                <option value="10" <?= sttSelected("10",$_GET['bln']); ?>>Oktober</option>
                                <option value="11" <?= sttSelected("11",$_GET['bln']); ?>>November</option>
                                <option value="12" <?= sttSelected("12",$_GET['bln']); ?>>Desember</option>

                            <?php
                                }else{
                            ?>
                                <option value="">All</option>
                                <option value="01">Januari</option>
                                <option value="02">Februari</option>
                                <option value="03">Maret</option>
                                <option value="04">April</option>
                                <option value="05">Mei</option>
                                <option value="06">Juni</option>
                                <option value="07">Juli</option>
                                <option value="08">Agustus</option>
                                <option value="09">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            <?php
                                }
                            ?>
                        </select>
                        <select name="tahun_pengambilan" id="tahun_pengambilan" class="form-control mr-2" style="width: 90px;">
                            <option value="">All</option>
                        <?php 
                            $qry=mysqli_query($conn, "SELECT tgl_pengambilan FROM t_pengambilan GROUP BY year(tgl_pengambilan)");
                            if(mysqli_num_rows($qry) > 0){
                                $thn_all = [];
                                while($a = mysqli_fetch_assoc($qry)){
                                    $a = explode('-', $a['tgl_pengambilan']);
                                    $thn_all[] = $a[0];
                                    
                                }
                                // jika tahun di atas tidak ada tahun yang sekarang [diakibatkan karena belum ada data yang terinput pada tahun sekarang]
                                if( !in_array(date("Y"), $thn_all) ){
                                    $thn_all[] = date("Y");
                                    
                                }

                                // tampilkan [looping] variabel $thn_all
                                foreach ($thn_all as $thn) {
                                    if(!isset($_GET['thn'])){
                                        $stt_thn = sttSelected($thn,date("Y"));
                                    }elseif(isset($_GET['thn']) && !empty($_GET['thn'])){
                                        $stt_thn = sttSelected($thn,$_GET['thn']);
                                    }else{
                                        $stt_thn = "";
                                    }
                                    echo "<option value='".$thn."' ".$stt_thn.">".$thn."</option>";
                                }
                            }
                        ?>
                        </select>
                        
                        <!-- <button type="button" class="btn btn-primary mr-2 icon-printer" title="Cetak"></button>
                        <button type="button" class="btn btn-success mr-2 icon-file-excel" title="Simpan ke Excel"></button>
                        <button type="button" class="btn btn-danger mr-2 icon-file-pdf" title="Simpan ke PDF"></button> -->
                    </div>
                </div>
                
                <!-- body tabel  -->
                <div id="table_body" class="overflow-auto w-100 p-3" style="max-height: 470px;">
                    <form action="cetak_invoice.php" method="post" target="_blank">
                    <button type="submit" name="cetak_inv_checked" id="btn_cetak" class="btn btn-success mb-2">Cetak Nota Yang Tercentang</button>
                    <table class="table table-hover" id="tabel_pengambilan" style="font-size: 11pt;">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <label for="chkall" class="btn btn-outline-primary" data-toggle="button" aria-pressed="false">All</label>
                                    <input type="checkbox" name="chkall" id="chkall" onchange="checkAll(this)" hidden>
                                </th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Sumber Dana</th>
                                <th scope="col">Tanggal Ambil</th>
                                <th scope="col">Nama Pengambil</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Satuan</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(isset($_GET['bln']) AND isset($_GET['thn'])){
                                    $bulan = trim(htmlspecialchars($_GET['bln']));
                                    $tahun = trim(htmlspecialchars($_GET['thn']));
                                    if(!empty($_GET['bln']) AND !empty($_GET['thn'])){
                                        $sql_pengambilan = mysqli_query($conn, "SELECT * FROM t_pengambilan INNER JOIN t_barang ON t_pengambilan.id_barang = t_barang.id WHERE MONTH(tgl_pengambilan) = '$bulan' AND YEAR(tgl_pengambilan) = '$tahun'");
                                    }elseif(empty($_GET['bln']) AND !empty($_GET['thn'])){
                                        $sql_pengambilan = mysqli_query($conn, "SELECT * FROM t_pengambilan INNER JOIN t_barang ON t_pengambilan.id_barang = t_barang.id WHERE YEAR(tgl_pengambilan) = '$tahun'");
                                    }elseif(!empty($_GET['bln']) AND empty($_GET['thn'])){
                                        $sql_pengambilan = mysqli_query($conn, "SELECT * FROM t_pengambilan INNER JOIN t_barang ON t_pengambilan.id_barang = t_barang.id WHERE MONTH(tgl_pengambilan) = '$bulan'");
                                    }else{
                                        $sql_pengambilan = mysqli_query($conn, "SELECT * FROM t_pengambilan INNER JOIN t_barang ON t_pengambilan.id_barang = t_barang.id ");
                                    }
                                        
                                }else{
                                    $sql_pengambilan = mysqli_query($conn, "SELECT * FROM t_pengambilan INNER JOIN t_barang ON t_pengambilan.id_barang = t_barang.id ");
                                }
                                    
                                if(mysqli_num_rows($sql_pengambilan) > 0){
                                    while($pengambilan = mysqli_fetch_assoc($sql_pengambilan)){
                            ?>
                            <tr>
                                <td style="border-right: 0.5px solid rgba(0,0,0,0.1);">
                                    <input type="checkbox" class="cek" name="chk_id[]" value="<?= $pengambilan['id_pengambilan']; ?>">
                                </td>
                                </form>
                                <td style="border-right: 0.5px solid rgba(0,0,0,0.1);"><?= $pengambilan['nama_barang']; ?></td>
                                <td style="border-right: 0.5px solid rgba(0,0,0,0.1);">
                                    <?php
                                        $id_barang = $pengambilan['id_barang']; 
                                        $sql_sumber = mysqli_query($conn, "SELECT * FROM t_barang INNER JOIN t_sumber_dana ON t_barang.id_sumber = t_sumber_dana.id_sumber WHERE id = '$id_barang' ");
                                        $sumber = mysqli_fetch_assoc($sql_sumber)['sumber'];
                                        echo $sumber;
                                    ?>
                                </td>
                                <td style="border-right: 0.5px solid rgba(0,0,0,0.1);"><?= $pengambilan['tgl_pengambilan']; ?></td>
                                <td style="border-right: 0.5px solid rgba(0,0,0,0.1);"><?= $pengambilan['nama_pengambil']; ?></td>
                                <td style="border-right: 0.5px solid rgba(0,0,0,0.1);"><?= $pengambilan['jumlah']; ?></td>
                                <td style="border-right: 0.5px solid rgba(0,0,0,0.1);">
                                    <!-- ambil satuan dari t_barang berdasarkan id barang -->
                                    <?php 
                                        $id_barang = $pengambilan['id_barang'];
                                        $sql_satuan = mysqli_query($conn, "SELECT * FROM t_barang INNER JOIN t_satuan ON t_barang.id_satuan = t_satuan.id_satuan WHERE id = '$id_barang' ");
                                        $stn = mysqli_fetch_assoc($sql_satuan)['satuan'];
                                        echo $stn;
                                    ?>
                                </td>
                                <td style="border-right: 0.5px solid rgba(0,0,0,0.1);"><?= $pengambilan['keterangan']; ?></td>
                                <td class="d-flex justify-content-between">
                                    <button style="width: 49%;" type="button" class="btn btn-warning" title="Restore" data-toggle="modal" data-target="#ModalRestore<?= $pengambilan['id_pengambilan']; ?>"><span class="icon-spinner11"></span></button>
                                    
                                    <a class="d-inline-block" style="width: 49%; text-align:center; text-decoration:none;" href="cetak_invoice.php?id=<?= $pengambilan['id_pengambilan']; ?>" target="_blank" rel="Cetak Invoice"><button type="button" class="btn btn-success" title="Cetak Invoice" ><span class="icon-printer"></span></button></a>
                                </td>
                            </tr>


                            <!-- Modal Konfirmasi Restore -->
                            <div class="modal fade" id="ModalRestore<?= $pengambilan['id_pengambilan']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Restore</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <form action="modules/laporan.php" method="post">
                                    <input type="hidden" name="id_pengambilan" value="<?= $pengambilan['id_pengambilan']; ?>">
                                        <input type="hidden" name="id_barang" value="<?= $pengambilan['id_barang']; ?>">
                                        <input type="hidden" name="jumlah" value="<?= $pengambilan['jumlah']; ?>">
                                        <label for="">Apakah kamu ingin Restore pengambilan <b><?= $pengambilan['nama_barang']; ?></b> yang berjumlah <b><?= $pengambilan['jumlah']; ?></b> <b><?= $stn; ?></b>?</label>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                    <button type="submit" class="btn btn-warning" name="restore_barang">Restore</button>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <?php
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
</div>

<!-- tekan tombol maka check semua data -->
<script type="text/javascript">
  function checkAll(ele) {
       var checkboxes = document.getElementsByTagName('input');
       if (ele.checked) {
           for (var i = 0; i < checkboxes.length; i++) {
               if (checkboxes[i].type == 'checkbox' ) {
                   checkboxes[i].checked = true;
               }
           }
       } else {
           for (var i = 0; i < checkboxes.length; i++) {
               if (checkboxes[i].type == 'checkbox') {
                   checkboxes[i].checked = false;
               }
           }
       }
   }
 </script>

<!-- <script>
    
    var f_input = document.querySelector('.cek');
    f_input.addEventListener("change", function(){
        var btn_cetak = document.getElementById('btn_cetak');
        if(f_input.checked){
            btn_cetak.style.display = "block";
        }else{
            btn_cetak.style.display = "none";
        }
    });
    
</script> -->

