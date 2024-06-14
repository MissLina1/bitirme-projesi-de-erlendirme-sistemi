<?php 
    include "baglanti.php";
    $sql = "SELECT 
    ogrenciler.id as o_id,
    ogrenciler.ogrenci_no,
    ogrenciler.ad,
    ogrenciler.soyad,
    danismanlar.ad_soyad,
    projeler.proje_ad,
    notlar.juri1_not,
    notlar.juri2_not,
    notlar.juri3_not,
    notlar.juri4_not
    FROM ogrenciler left join danismanlar on ogrenciler.danisman_id=danismanlar.id left join projeler on ogrenciler.proje_id=projeler.id left join notlar on notlar.ogrenci_id=ogrenciler.id";
    $result = mysqli_query($vt, $sql);
    $ogrenciler = $result -> fetch_all(MYSQLI_ASSOC);
?>

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th colspan="9" class="text-center">Genel Liste</th>
        </tr>
        <tr>
            <th>Öğrenci No</th>
            <th>Ad</th>
            <th>Soyad</th>
            <th>Danışmanı</th>
            <th>Projesi</th>
            <th>1.Notu</th>
            <th>2.Notu</th>
            <th>3.Notu</th>
            <th>4.Notu</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            foreach($ogrenciler as $ogrenci){ 
        ?>
        <tr>
            <td><?php echo $ogrenci["ogrenci_no"];?></td>
            <td><?php echo $ogrenci["ad"];?></td>
            <td><?php echo $ogrenci["soyad"];?></td>
            <td><?php echo $ogrenci["ad_soyad"];?></td>
            <td><?php echo $ogrenci["proje_ad"];?></td>
            <td><?php echo $ogrenci["juri1_not"];?></td>
            <td><?php echo $ogrenci["juri2_not"];?></td>
            <td><?php echo $ogrenci["juri3_not"];?></td>
            <td><?php echo $ogrenci["juri4_not"];?></td>
        </tr>
        <?php }?>
    </tbody>
</table>
