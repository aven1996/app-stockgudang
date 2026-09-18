

if(window.location.href.search("stockopname") > 0){
    // memuat bulan dan tahun untuk menampilkan laporan
    var bln = $("#bulan_stockopname").val();
    var thn = $("#tahun_stockopname").val();
    // jika tidak ada bln dan thn di url maka akan diredirect
    if(window.location.href.search("bln") < 0 || window.location.href.search("thn") < 0){
        var url = "?menu=stockopname";
        window.location.assign(url + "&bln=" + bln + "&thn=" + thn);
    }
    // option bulan dan tahun saat diganti
    $("#bulan_stockopname").change(function(){
        var bln = $("#bulan_stockopname").val();
        var thn = $("#tahun_stockopname").val();
        var url = "?menu=stockopname";
        window.location.assign(url + "&bln=" + bln + "&thn=" + thn);
    });

    $("#tahun_stockopname").change(function(){
        var bln = $("#bulan_stockopname").val();
        var thn = $("#tahun_stockopname").val();
        var url = "?menu=stockopname";
        window.location.assign(url + "&bln=" + bln + "&thn=" + thn);
    });
    
}

