<div class="container">
        <div class="w-100 p-2 mt-4">
            <div class="border rounded-lg h-100 bg-white overflow-hidden">
                <!-- header stock barang -->
                <div class="d-flex justify-content-between align-items-center border-bottom bg-dark">
                    <div class="d-flex align-items-center p-3">
                        <img src="img/stock.png" alt="Grafik Barang Masuk Keluar" class="mr-2" style="width: 30px;">
                        <h5 class="m-0 text-white">Laporan Stock Opname</h5>
                    </div>
                    <div class="d-flex">
                        <select name="bulan_stockopname" id="bulan_stockopname" class="form-control mr-2" style="width: 150px;">
                        <?php
                        if( isset($_GET['bln']) == "" OR isset($_GET['thn']) == "" OR !isset($_GET['bln']) ){
                            ?>
                                
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
                                }elseif(isset($_GET['bln']) != "" AND isset($_GET['thn']) != ""){
                            ?>
                                
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
                                }
                            ?>
                        </select>
                        <select name="tahun_stockopname" id="tahun_stockopname" class="form-control mr-2" style="width: 90px;">
                            
                            <?php 
                                // kumpulan tanggal yang ada di tabel masuk dan tabel pengambilan & masukkan tahun ke var array
                                $sql_thn1 = mysqli_query($conn, "SELECT tgl_masuk FROM t_masuk_barang");
                                $sql_thn2 = mysqli_query($conn, "SELECT tgl_pengambilan FROM t_pengambilan");
                                $tahun_arr = [];

                                if(mysqli_num_rows($sql_thn1) > 0){
                                    
                                    while($thn = mysqli_fetch_assoc($sql_thn1)){
                                        $thn_masuk = explode('-', $thn['tgl_masuk']);
                                        $thn_masuk = $thn_masuk[0];
                                        if( !in_array($thn_masuk,$tahun_arr) ){
                                            $tahun_arr[] = $thn_masuk;
                                        }
                                    }
                                }

                                if(mysqli_num_rows($sql_thn2) > 0){
                                    
                                    while($thn = mysqli_fetch_assoc($sql_thn2)){
                                        $thn_keluar = explode('-', $thn['tgl_pengambilan']);
                                        $thn_keluar = $thn_keluar[0];
                                        if( !in_array($thn_keluar,$tahun_arr) ){
                                            $tahun_arr[] = $thn_keluar;
                                        }
                                    }
                                }

                                // jika tahun di atas tidak ada tahun yang sekarang [diakibatkan karena belum ada data yang terinput pada tahun sekarang]
                                if( !in_array(date("Y"),$tahun_arr) ){
                                    $tahun_arr[] = date("Y");
                                }

                                // looping array yang berisi tahun dan tampilkan dalam bentuk option
                                foreach ($tahun_arr as $thn) {
                                    if(!isset($_GET['thn'])){
                                        $stt_thn = sttSelected($thn, date("Y"));
                                    }elseif(isset($_GET['thn']) && !empty($_GET['thn'])){
                                        $stt_thn = sttSelected($thn, $_GET['thn']);
                                    }else{
                                        $stt_thn = "";
                                    }
                                    echo "<option value='".$thn."' ".$stt_thn.">".$thn."</option>";
                                }
                                
                            ?>
                        </select>
                        <!-- <button type="button" class="btn btn-primary mr-2 icon-printer" title="Cetak"></button>
                        <button type="button" class="btn btn-success mr-2 icon-file-excel" title="Simpan ke Excel"></button>
                        <button type="button" class="btn btn-danger mr-2 icon-file-pdf" title="Simpan ke PDF"></button> -->
                    </div>
                </div>

                <!-- body tabel  -->
                <div id="table_body" class="overflow-auto w-100 p-3" style="max-height: 450px;">
                    <table class="table table-hover" id="tabel_stockopname" style="font-size: 11pt;">
                        <thead>
                            <tr>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Sumber Dana</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Satuan</th>
                                <th scope="col">Inventory Value</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            if(isset($_GET['bln']) AND isset($_GET['thn'])):
                                $bulan = trim(htmlspecialchars($_GET['bln']));
                                $tahun = trim(htmlspecialchars($_GET['thn'])); 

                                // jika bulan dan tahun pada url kosong
                                if(empty($bulan)){
                                    $bulan = date("m");
                                }
                                if(empty($tahun)){
                                    $tahun = date("Y");
                                }

                                // tampilkan data barang terlebih dahulu
                                $sql_barang = mysqli_query($conn, "SELECT * FROM t_barang INNER JOIN t_sumber_dana ON t_barang.id_sumber = t_sumber_dana.id_sumber INNER JOIN t_satuan ON t_barang.id_satuan = t_satuan.id_satuan ");
                                if(mysqli_num_rows($sql_barang) > 0):
                                    while($brg = mysqli_fetch_assoc($sql_barang)):
                                        $id_brg = $brg['id'];
                                        // cari barang dengan id [brg] pada t_stock_opname dengan bulan dan tahun terpilih
                                        $sql_opname = mysqli_query($conn, "SELECT jumlah, inventory_value FROM t_stock_opname WHERE MONTH(tgl_update) = '$bulan' AND YEAR(tgl_update) = '$tahun' AND id_barang = '$id_brg' ORDER BY id_opname DESC LIMIT 1");
                                        if(mysqli_num_rows($sql_opname) > 0):
                                            while($opname = mysqli_fetch_assoc($sql_opname)):
                        ?>
                                            <tr>
                                                <td style="border-right: 0.5px solid rgba(0,0,0,0.1);"><?= $brg['nama_barang']; ?></td>
                                                <td style="border-right: 0.5px solid rgba(0,0,0,0.1);"><?= $brg['sumber']; ?></td>
                                                <td style="border-right: 0.5px solid rgba(0,0,0,0.1);"><?= $opname['jumlah']; ?></td>
                                                <td style="border-right: 0.5px solid rgba(0,0,0,0.1);"><?= $brg['satuan']; ?></td>
                                                <td style="border-right: 0.5px solid rgba(0,0,0,0.1);"><?= rupiah($opname['inventory_value']); ?></td>
                                            </tr>
                        <?php
                                            endwhile;
                                        else:
                                            // jika di t_stock_opname dengan kondisi tersebut tidak ada
                                            // cari dengan kondisi range bulan dari saat barang diinput sampai bulan terpilih dikurangi 1

                                            // --------cari bulan input barang
                                            $tgl_input_brg = mysqli_query($conn, "SELECT tgl_masuk FROM t_masuk_barang WHERE id_barang = '$id_brg' AND keterangan = 'add'");
                                            $bulan_add = mysqli_fetch_assoc($tgl_input_brg);
                                            $bulan_add = explode('-', $bulan_add['tgl_masuk'])[1];

                                            // --------cari bulan terpilih dikurangi 1 untuk mundur ke bulan sebelumnya
                                            $bulan_1 = $bulan - 1;

                                            // --------jika bulan saat ini bulan januari akan mengeluarkan nilai 0 -> jadi langsung dibuat 12 (desember)
                                            if($bulan_1 == 0){
                                                $bulan_1 = 12;
                                            }

                                            // sql2
                                            $sql_opname2 = mysqli_query($conn, "SELECT jumlah, inventory_value FROM t_stock_opname WHERE MONTH(tgl_update) BETWEEN '$bulan_add' AND '$bulan_1' AND YEAR(tgl_update) = '$tahun' AND id_barang = '$id_brg' ORDER BY id_opname DESC LIMIT 1");
                                            
                                            if(mysqli_num_rows($sql_opname2) > 0):
                                                while($opname2 = mysqli_fetch_assoc($sql_opname2)):
                        ?>  
                                                    <tr>
                                                        <td style="border-right: 0.5px solid rgba(0,0,0,0.1);"><?= $brg['nama_barang']; ?></td>
                                                        <td style="border-right: 0.5px solid rgba(0,0,0,0.1);"><?= $brg['sumber']; ?></td>
                                                        <td style="border-right: 0.5px solid rgba(0,0,0,0.1);"><?= $opname2['jumlah']; ?></td>
                                                        <td style="border-right: 0.5px solid rgba(0,0,0,0.1);"><?= $brg['satuan']; ?></td>
                                                        <td style="border-right: 0.5px solid rgba(0,0,0,0.1);"><?= rupiah($opname2['inventory_value']); ?></td>
                                                    </tr>
                        <?php   
                                                endwhile;
                                            else:
                                                // jika dengan kondisi diatas tidak ditemukan
                                                // cari dengan kondisi range tahun dari saat barang diinput sampai tahun terpilih kurangi 1
                                                
                                                // --------cari bulan input barang
                                                $sql_input_brg = mysqli_query($conn, "SELECT tgl_masuk FROM t_masuk_barang WHERE id_barang = '$id_brg' AND keterangan = 'add'");
                                                $tahun_add = mysqli_fetch_assoc($sql_input_brg);
                                                $tahun_add = explode('-', $tahun_add['tgl_masuk'])[0];

                                                // --------cari tahun terpilih/sekarang
                                                $tahun_1 = $tahun;

                                                // sql3
                                                $sql_opname3 = mysqli_query($conn, "SELECT jumlah, inventory_value FROM t_stock_opname WHERE YEAR(tgl_update) BETWEEN '$tahun_add' AND '$tahun_1' AND id_barang = '$id_brg' ORDER BY id_opname DESC LIMIT 1");
                                                if(mysqli_num_rows($sql_opname3) > 0):
                                                    while($opname3 = mysqli_fetch_assoc($sql_opname3)):
                            ?>  
                                                        <tr>
                                                            <td style="border-right: 0.5px solid rgba(0,0,0,0.1);"><?= $brg['nama_barang']; ?></td>
                                                            <td style="border-right: 0.5px solid rgba(0,0,0,0.1);"><?= $brg['sumber']; ?></td>
                                                            <td style="border-right: 0.5px solid rgba(0,0,0,0.1);"><?= $opname3['jumlah']; ?></td>
                                                            <td style="border-right: 0.5px solid rgba(0,0,0,0.1);"><?= $brg['satuan']; ?></td>
                                                            <td style="border-right: 0.5px solid rgba(0,0,0,0.1);"><?= rupiah($opname3['inventory_value']); ?></td>
                                                        </tr>
                            <?php   
                                                    endwhile;
                                                endif;
                                            endif;
                                        endif;
                                    endwhile;
                                endif;
                            endif;
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>



