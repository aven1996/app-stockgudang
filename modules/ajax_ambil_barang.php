
<?php
    include 'connection.php';
    if(!empty($_GET['key'])):
        $key = trim(htmlspecialchars($_GET['key']));
        $sql = mysqli_query($conn, "SELECT * FROM t_barang WHERE nama_barang LIKE '%$key%'");
        if(mysqli_num_rows($sql) > 0):
?>
            <div id="cov_card_barang" class="p-2 mt-1 bg-light border rounded-lg position-relative d-flex flex-column overflow-auto" style="max-height: 150px;">

                <?php while($data = mysqli_fetch_assoc($sql)): ?>
                    <button type="button" class="btn btn-light p-1 px-2 text-left" onclick="pilihBarang(<?= $data['id']; ?>);"><?= $data['nama_barang']; ?></button>
                <?php endwhile; ?>

            </div>

    <?php endif; ?>
<?php endif; ?>

<script>
    function pilihBarang(id){
        $.ajax({url: "modules/ajax_barang_dipilih.php?id="+id, success: function(result){
            $("#cov_pilih_barang").html(result);
          }});
    }
</script>