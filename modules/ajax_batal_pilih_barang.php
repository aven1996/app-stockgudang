<label for="pilih_barang">Pilih Barang</label>
<input type="text" class="form-control" id="pilih_barang" placeholder="Masukkan nama barang" autocomplete="off">
<!-- card barang terpilih -->
<div id="ajax_gambar_dipilih"></div>
<!-- result ajax saat nama barang diketikan -->
<div id="result_ajax_ambil"></div>

<script>
    $("#pilih_barang").keyup(function() {
        var key = $("#pilih_barang").val();
        $.ajax({url: "modules/ajax_ambil_barang.php?key="+key, success: function(result){
            $("#result_ajax_ambil").html(result);
          }});
    });
</script>