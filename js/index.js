if(window.location.href.search("beranda") > 0 || window.location.href.search("menu") < 0){
    // memuat url sesuai tahun yang terpilih pada chart
    var thn = $("#tahun_chart").val();
    
    // jika tidak ada thn di url maka akan diredirect
    if(window.location.href.search("thn") < 0){
        var url = "?menu=beranda";
        window.location.assign(url + "&thn=" + thn);
    }

    // option tahun saat diganti
    $("#tahun_chart").change(function(){
        var thn = $("#tahun_chart").val();
        var url = "?menu=beranda";
        window.location.assign(url + "&thn=" + thn);
    });




    // <!-- ChartJS -->
    $.ajax({url: "modules/kiriman_dataChart.php?thn="+$("#tahun_chart").val(), success: function(result){
        var data =  JSON.parse(result);
        var data_masuk = data[0];
        var data_keluar = data[1];
    
        const ctx = document.getElementById('myChart');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                datasets: [{
                    label: 'Masuk',
                    data: data_masuk,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                },{
                    label: 'Keluar',
                    data: data_keluar,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }});
}



// ajax cari barang
$(document).ready(function(){
    $("#cari_barang").keyup(function() {
        var key = $("#cari_barang").val();
        $.ajax({url: "modules/ajax_result_cari.php?key="+key, success: function(result){
            $("#popup_res_cari").html(result);
          }});
    });
});



 




