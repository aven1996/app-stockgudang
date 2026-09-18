

if(window.location.href.search("laporan") > 0){
    // memuat bulan dan tahun untuk menampilkan laporan
    var bln = $("#bulan_pengambilan").val();
    var thn = $("#tahun_pengambilan").val();
    // jika tidak ada bln dan thn di url maka akan diredirect
    if(window.location.href.search("bln") < 0 || window.location.href.search("thn") < 0){
        var url = "?menu=laporan";
        window.location.assign(url + "&bln=" + bln + "&thn=" + thn);
    }
    // option bulan dan tahun saat diganti
    $("#bulan_pengambilan").change(function(){
        var bln = $("#bulan_pengambilan").val();
        var thn = $("#tahun_pengambilan").val();
        var url = "?menu=laporan";
        window.location.assign(url + "&bln=" + bln + "&thn=" + thn);
    });

    $("#tahun_pengambilan").change(function(){
        var bln = $("#bulan_pengambilan").val();
        var thn = $("#tahun_pengambilan").val();
        var url = "?menu=laporan";
        window.location.assign(url + "&bln=" + bln + "&thn=" + thn);
    });
    
}

