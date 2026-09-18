<?php
    include 'connection.php';

    if(!empty($_GET['key'])):
        $key      = trim(htmlspecialchars($_GET['key']));
        $sql      = mysqli_query($conn, "SELECT * FROM t_barang INNER JOIN t_satuan ON t_barang.id_satuan = t_satuan.id_satuan INNER JOIN t_sumber_dana ON t_barang.id_sumber = t_sumber_dana.id_sumber WHERE nama_barang LIKE '%$key%'");
        if(mysqli_num_rows($sql) > 0):
            
    

?>


<div class="position-absolute" style="top: 50px; right: 0; z-index:999;">
    <div class="shadow-lg p-3 rounded-lg overflow-auto" style="width: 350px; max-height: 300px; background-color: rgba(255,255,255,0.8); backdrop-filter: blur(5px); ">
        <ul class="m-0 p-0" style="list-style: none;">
        <?php while($res = mysqli_fetch_assoc($sql)): ?>
            <li class="p-1" style="border-bottom: 1px solid rgba(0,0,0,0.1);">
                <a href="#" style="text-decoration: none; color: black;"><h5><?= $res['nama_barang']; ?></h5></a>
                <div class="d-flex justify-content-between" style="height: 30px;">
                    <div>
                        <span style="background-color: <?= $res['warna']; ?>;" class="p-1 px-2 text-white rounded-lg small mr-1" title="Sumber dana"><?= $res['sumber']; ?></span>
                        <span class="p-1 px-2 bg-secondary text-white rounded-lg small mr-1" title="Stok barang"><?= $res['stok']; ?> <?= $res['satuan']; ?></span>
                    </div>
                    <button type="button" class="d-inline btn btn-warning small p-1 px-2 rounded-lg shadow" onclick="tb_cari(<?= $res['id']; ?>)"><span class="tb_ambil_cari icon-new-tab mr-1"></span>Ambil</button>
                </div>
            </li>

            

        <?php endwhile; ?>
        </ul>
    </div>
</div>

<?php
    endif;
endif;
?>


<script>
    function tb_cari(id) {
        if(window.location.href.search("menu") > 0){
            // netralisir dlu url sudah mengandung idcari atau belum
            if(window.location.href.search("&idcari") > 0){
                var url_clr = window.location.href
                var url_clr = url_clr.split("&");
                var url = url_clr[0] + "&idcari="+id;
                window.location.href =  url;    
            }else{
                var url = window.location.href + "&idcari="+id;
                window.location.assign(url);
            }
        }else{
            if(window.location.href.search("idcari") > 0){
                var url_clr = window.location.href
                var url_clr = url_clr.split("?");
                var url = url_clr[0] + "?idcari="+id;
                window.location.href =  url;    
            }else{
                var url = window.location.href + "?idcari="+id;
                window.location.assign(url);
            }
        }
    }
</script>



