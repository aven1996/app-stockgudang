// MODAL TAMBAH
// Mengganti label Harga satuan dengan satuan yang telah dipilih pada input satuan
    // saat load halaman pertama kali
    var vSatuan = $("#satuan option:selected").data("value");
    $("#label_satuan").html(vSatuan);
    // kondisi saat diganti pilih
    $("#satuan").change(function (){
        var vSatuan = $("#satuan option:selected").data("value");
        $("#label_satuan").html(vSatuan); 
        
    });


// ajax pilih barang muncul result setelah diisikan
$("#cov_pilih_barang").ready(function(){
    $("#pilih_barang").keyup(function() {
        var key = $("#pilih_barang").val();
        $.ajax({url: "modules/ajax_ambil_barang.php?key="+key, success: function(result){
            $("#result_ajax_ambil").html(result);
          }});
    });
});


