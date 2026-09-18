<div class="container">
    <!-- statistik barang masuk dan keluar -->
    <div class="d-flex align-items-stretch w-100 mt-4" style="height: 435px;">
        <div class="w-75 p-2">
            <div class="border rounded-lg h-100 bg-white overflow-hidden">
                <!-- header statistik -->
                <div class="d-flex justify-content-between align-items-center border-bottom bg-dark">
                    <div class="d-flex align-items-center p-3">
                        <img src="img/grafik_barang.png" alt="Grafik Barang Masuk Keluar" class="mr-2" style="width: 30px;">
                        <h5 class="m-0 text-white">Statistik Keluar Masuk Barang</h5>
                    </div>
                    <!-- TAHUN GARFIK -->
                    <form action="" class="mr-3">
                        <select name="" id="tahun_chart" class="form-control">
                            <?php 
                                // kumpulan tanggal yang ada di tabel masuk dan tabel pengambilan & masukkan tahun ke var array
                                $sql_thn1 = mysqli_query($conn, "SELECT tgl_masuk FROM t_masuk_barang");
                                $sql_thn2 = mysqli_query($conn, "SELECT tgl_pengambilan FROM t_pengambilan");
                                $tahun_arr = [];
                                
                                // ambil tahun dari tabel barang masuk
                                if(mysqli_num_rows($sql_thn1) > 0){
                                    
                                    while($thn = mysqli_fetch_assoc($sql_thn1)){
                                        $thn_masuk = explode('-', $thn['tgl_masuk']);
                                        $thn_masuk = $thn_masuk[0];
                                        if( !in_array($thn_masuk,$tahun_arr) ){
                                            $tahun_arr[] = $thn_masuk;
                                        }
                                    }
                                }

                                // ambil tahun dari tabel barang keluar
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
                    </form>
                </div>

                <!-- body statistik -->
                <div class="p-3 overflow-auto" style="width: 100%; height:85%;">
                    <canvas id="myChart" class="w-100 h-100"></canvas>
                </div>
            </div>
        </div>

        <!-- Jumlah Inventory -->
        <div class="w-25 p-2">
            <div class="d-flex flex-column justify-content-between h-100">
                <!-- total inventory -->
                <div class="rounded-lg bg-dark" style="height: 130px;">
                    <div class="d-flex align-items-center p-3 border-bottom border-secondary" >
                        <img src="img/inventory.png" alt="Inventory" class="mr-2" style="width: 20px;">
                        <h6 class="m-0 text-white">Total Inventory</h6>
                    </div>
                    <div class="py-2 px-3">
                        <h3 class="m-0 font-weight-bold text-info">
                            <?php
                                $jml_barang = mysqli_query($conn, "SELECT SUM(stok) as total FROM t_barang");
                                if(mysqli_num_rows($jml_barang) > 0){
                                    $jml_barang = mysqli_fetch_assoc($jml_barang)['total'];
                                    echo $jml_barang;
                                }else{
                                    echo "0";
                                }
                             ?>
                        </h3>    
                        <span class="text-white">
                        <?php
                                $val_barang = mysqli_query($conn, "SELECT SUM(inventory_value) as total FROM t_barang");
                                if(mysqli_num_rows($val_barang) > 0){
                                    $val_barang = mysqli_fetch_assoc($val_barang)['total'];
                                    echo rupiah($val_barang);
                                }else{
                                    echo "Rp0";
                                }
                             ?>
                        </span>
                    </div>
                </div>
                <!-- barang keluar -->
                <div class="rounded-lg bg-dark" style="height: 130px;">
                    <div class="d-flex align-items-center p-3 border-bottom border-secondary">
                        <img src="img/produk_keluar.png" alt="Barang Keluar" class="mr-2" style="width: 20px;">
                        <h6 class="m-0 text-white">Barang Keluar</h6>
                    </div>
                    <div class="py-2 px-3">
                        <h3 class="m-0 font-weight-bold text-danger">
                            <?php
                                $jml_keluar = mysqli_query($conn, "SELECT SUM(jumlah) as total FROM t_pengambilan");
                                if(mysqli_num_rows($jml_keluar) > 0){
                                    $jml_keluar = mysqli_fetch_assoc($jml_keluar)['total'];
                                    echo $jml_keluar;
                                }else{
                                    echo "0";
                                }
                                
                             ?>
                        </h3>    
                        <span class="text-white">
                            <?php
                                $sql_pengambilan = mysqli_query($conn, "SELECT * FROM t_pengambilan INNER JOIN t_barang ON t_pengambilan.id_barang = t_barang.id");
                                if(mysqli_num_rows($sql_pengambilan) > 0){
                                    $val_pengambilan = 0;
                                    while($a = mysqli_fetch_assoc($sql_pengambilan)){
                                         $total_perbarang = $a['jumlah'] * $a['harga'];
                                         $val_pengambilan = $val_pengambilan + $total_perbarang;
                                    }
                                    echo rupiah($val_pengambilan);
                                }else{
                                    echo "Rp0";
                                }
                            ?>
                        </span>
                    </div>
                </div>
                <!-- barang masuk -->
                <div class="rounded-lg bg-dark" style="height: 130px;">
                    <div class="d-flex align-items-center p-3 border-bottom border-secondary">
                        <img src="img/produk_masuk.png" alt="Barang Masuk" class="mr-2" style="width: 20px;">
                        <h6 class="m-0 text-white">Barang Masuk</h6>
                    </div>
                    <div class="py-2 px-3">
                        <h3 class="m-0 font-weight-bold text-success">
                            <?php
                                $jml_masuk = mysqli_query($conn, "SELECT SUM(jumlah) as total FROM t_masuk_barang WHERE keterangan != 'restore'");
                                if(mysqli_num_rows($jml_masuk) > 0){
                                    $jml_masuk = mysqli_fetch_assoc($jml_masuk)['total'];
                                    echo $jml_masuk;
                                }else{
                                    echo "0";
                                }
                                
                             ?>
                        </h3>    
                            <span class="text-white">
                                <?php
                                    $sql_masuk = mysqli_query($conn, "SELECT * FROM t_masuk_barang INNER JOIN t_barang ON t_masuk_barang.id_barang = t_barang.id WHERE keterangan != 'restore'");
                                    if(mysqli_num_rows($sql_masuk) > 0){
                                        $val_masuk = 0;
                                        while($i = mysqli_fetch_assoc($sql_masuk)){
                                            $total_perbarang_masuk = $i['jumlah'] * $i['harga'];
                                            $val_masuk = $val_masuk + $total_perbarang_masuk;
                                        }
                                        echo rupiah($val_masuk);
                                    }else{
                                        echo "Rp0";
                                    }
                                ?>
                            </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- barang baru masuk & barang re-order -->
    <div class="d-flex w-100 p-2 justify-content-between" style="height: 330px;">
        <div class="border rounded-lg bg-white overflow-hidden" style="width: 49.2%;">
           <!-- header barang baru -->
           <div class="d-flex justify-content-between align-items-center border-bottom" style="height: 63px;">
                <div class="d-flex align-items-center p-3">
                    <img src="img/new.png" alt="Barang Baru Masuk" class="mr-2" style="width: 30px;">
                    <h5 class="m-0">Barang Baru Ditambahkan</h5>
                </div>
            </div>
            <!-- body barang baru -->
            <div class="overflow-auto" style="height: 250px;">
                <?php
                    $sql_new = mysqli_query($conn, "SELECT * FROM t_barang INNER JOIN t_sumber_dana ON t_barang.id_sumber = t_sumber_dana.id_sumber INNER JOIN t_satuan ON t_barang.id_satuan = t_satuan.id_satuan ORDER BY id DESC LIMIT 6");
                    if(mysqli_num_rows($sql_new) > 0):
                        while($new = mysqli_fetch_assoc($sql_new)):
                ?>

                        <a href="#" class="item-baru-beranda d-flex align-items-center justify-content-between px-3 py-2 text-dark" style="text-decoration: none; border-bottom:1px solid rgba(0,0,0,0.1); background-color:aliceblue; <?php if($new['stok'] == 0){ echo 'background-color: MistyRose'; } ?>" >
                            <span style="width: 70%;"><?= $new['nama_barang']; ?></span>
                            <span class="text-center" style="width: 15%;"><?= $new['stok']; ?> <?= $new['satuan']; ?></span>
                            <span class="text-center text-white rounded-lg" style="width: 15%; background-color:<?= $new['warna']; ?>;"><?= $new['sumber']; ?></span>
                        </a>
                    <?php endwhile; else: ?>
                        <!-- jika tidak ada data -->
                        <div class="text-secondary p-3 text-center">Tidak ada data</div>
                    <?php endif; ?>
            </div>
        </div>

        <div class="border rounded-lg bg-white overflow-hidden" style="width: 49.2%;">
           <!-- header barang re-order -->
           <div class="d-flex justify-content-between align-items-center border-bottom" style="height: 63px;">
                <div class="d-flex align-items-center p-3">
                    <img src="img/empty.png" alt="Barang Re-Order" class="mr-2" style="width: 30px;">
                    <h5 class="m-0">Barang <span class="bg-danger text-white px-1 rounded-lg">Re-Order</span></h5>
                </div>
            </div>
            <!-- body barang re-order --> 
            <div class="overflow-auto" style="height: 250px;">
            <?php
                $sql_reorder = mysqli_query($conn, "SELECT * FROM t_barang INNER JOIN t_sumber_dana ON t_barang.id_sumber = t_sumber_dana.id_sumber INNER JOIN t_satuan ON t_barang.id_satuan = t_satuan.id_satuan WHERE stok = 0 ORDER BY id DESC LIMIT 6");
                if(mysqli_num_rows($sql_reorder) > 0):
                    while($reorder = mysqli_fetch_assoc($sql_reorder)):
            ?>
                    <a href="#" class="item-reorder-beranda d-flex align-items-center justify-content-between px-3 py-2 text-dark" style="text-decoration: none; border-bottom:1px solid rgba(0,0,0,0.1);">
                        <span style="width: 60%;"><?= $reorder['nama_barang']; ?></span>
                        <span class="text-center" style="width: 25%;">@<?= rupiah($reorder['harga']); ?></span>
                        <span class="text-center text-white rounded-lg" style="width: 15%; background-color:<?= $reorder['warna']; ?>"><?= $reorder['sumber']; ?></span>
                    </a>
                
                <?php endwhile; else: ?>
                    <!-- jika tidak ada data -->
                    <div class="text-secondary p-3 text-center">Tidak ada data</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>