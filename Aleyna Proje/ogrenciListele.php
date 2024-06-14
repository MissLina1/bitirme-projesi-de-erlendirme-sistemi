<?php
	include "baglanti.php";
	$sql = "SELECT 
	ogrenciler.id as o_id,
	ogrenciler.*,
	projeler.id as p_id,
	projeler.proje_ad,
	danismanlar.id as d_id,
	danismanlar.ad_soyad as d_ad
	FROM `ogrenciler` left join projeler on ogrenciler.proje_id=projeler.id left join danismanlar  on ogrenciler.danisman_id=danismanlar.id;";
	$result = mysqli_query($vt, $sql);
	$ogrenciler = $result -> fetch_all(MYSQLI_ASSOC);
?>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Öğrenci No</th>
            <th>Öğrenci Adı Soyadı</th>
            <th>Öğrencinin Danışmanı</th>
            <th>Seçilen Proje</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            foreach($ogrenciler as $ogrenci){ 
        ?>
        <tr onclick='ogrenciDuzenle(<?php echo $ogrenci["o_id"];?>)'>
            <td><?php echo $ogrenci["ogrenci_no"];?></td>
            <td><?php echo $ogrenci["ad"].' '.$ogrenci["soyad"];?></td>
            <td><?php echo $ogrenci["d_ad"];?></td>
            <td><?php if(isset($ogrenci["proje_ad"])) echo $ogrenci["proje_ad"]; else echo "<i class='text-secondary'>Seçili proje yok</i>";?></td>
        </tr>
        <?php }?>
    </tbody>
</table>
<script>
    function ogrenciDuzenle(ogrenciID){
        $(".projeler-container").load("ogrenciDetayGoster.php?ogrenci_id="+ogrenciID,function () {
            this;
        });
    }
</script>