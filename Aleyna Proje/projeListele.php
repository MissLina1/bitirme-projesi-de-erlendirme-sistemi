<?php 
    include "baglanti.php";
    $sql = "SELECT
    projeler.id as prj_id,
    projeler.*,
    danismanlar.*,
    danismanlar.id as dnsmn_id
    from projeler left join danismanlar on projeler.danisman_id=danismanlar.id;";
    $result = mysqli_query($vt, $sql);
    $projeler = $result -> fetch_all(MYSQLI_ASSOC);
?>

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Proje ID</th>
            <th>Proje Adı</th>
            <th>Proje Danışmanı</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            foreach($projeler as $proje){ 
        ?>
        <tr onclick='projeDuzenle(<?php echo $proje["prj_id"];?>)'>
            <td><?php echo $proje["prj_id"];?></td>
            <td><?php echo $proje["proje_ad"];?></td>
            <td><?php echo $proje["ad_soyad"];?></td>
        </tr>
        <?php }?>
    </tbody>
</table>
<script>
    function projeDuzenle(projeID){
        $(".projeler-container").load("projeDetayGoster.php?proje_id="+projeID,function () {
            this;
        });
    }
</script>