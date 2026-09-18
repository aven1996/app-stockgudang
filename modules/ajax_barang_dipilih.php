<?php
    include 'connection.php';
    include 'functions.php';

    $id = $_GET['id'];
    $sql = mysqli_query($conn, "SELECT * FROM t_barang INNER JOIN t_sumber_dana ON t_barang.id_sumber = t_sumber_dana.id_sumber INNER JOIN t_satuan ON t_barang.id_satuan = t_satuan.id_satuan WHERE id = '$id'");
    $data = mysqli_fetch_assoc($sql);
?>
<div class="p-2 mt-1 bg-light border rounded-lg position-relative">
    <input type="hidden" id="ambil_satuan" value="<?= $data['satuan']; ?>">
    <input type="hidden" name="id" value="<?= $data['id']; ?>">
    <div class="d-flex justify-content-between">
        <h4><?= $data['nama_barang']; ?></h4>
        <button onclick="batal_pilih();" type="button" class="close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="d-flex" style="height: 30px;">
        <span class="py-1 px-2 text-white rounded-lg small mr-1" title="Sumber dana" style="background-color: <?= $data['warna']; ?>;"><?= $data['sumber']; ?></span>
        <span class="py-1 px-2 bg-secondary text-white rounded-lg small mr-1" title="Stok barang"><?= $data['stok']; ?> <?= $data['satuan']; ?></span>
        <span class="py-1 px-2 bg-secondary text-white rounded-lg small mr-1" title="Harga satuan barang">@<?= rupiah($data['harga']); ?></span>
    </div>
</div>

<script>
function batal_pilih(){
    $.ajax({url: "modules/ajax_batal_pilih_barang.php", success: function(result){
        $("#cov_pilih_barang").html(result);
    }});
}

// satuan tampil jika barang terpilih
var ambil_satuan = $("#ambil_satuan").val();
$("#satuan_ambil").html(ambil_satuan);

</script>
