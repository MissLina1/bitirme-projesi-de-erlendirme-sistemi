<?php 
    include "baglanti.php";
    $sql = "SELECT * FROM danismanlar";
    $result = mysqli_query($vt, $sql);
    $danismanlar = $result -> fetch_all(MYSQLI_ASSOC);
    $sql = "SELECT * FROM juriler";
    $result = mysqli_query($vt, $sql);
    $juriler = $result -> fetch_all(MYSQLI_ASSOC);
?>

<table class="table table-striped table-hover w-50">
    <thead>
        <tr>
            <th colspan="2" class="text-center">Danışmanlar</th>
        </tr>
        <tr>
            <th>Danışman ID</th>
            <th>Adı Soyadı</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            foreach($danismanlar as $danisman){ 
        ?>
        <tr>
            <td><?php echo $danisman["id"];?></td>
            <td><?php echo $danisman["ad_soyad"];?></td>
        </tr>
        <?php }?>
    </tbody>
            </table>
<table class="table table-striped table-hover w-50">
    <thead>
        <tr>
            <th colspan="2" class="text-center">Jüriler</th>
        </tr>
        <tr>
            <th>Jüri ID</th>
            <th>Adı Soyadı</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            foreach($juriler as $juri){ 
        ?>
        <tr>
            <td><?php echo $juri["id"];?></td>
            <td><?php echo $juri["ad"];?></td>
        </tr>
        <?php }?>
    </tbody>
</table>
