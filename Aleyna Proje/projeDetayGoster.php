<?php 
    include "baglanti.php";
    $proje_id = $_GET["proje_id"];
    $sql = "SELECT 
    projeler.id as prj_id,
    projeler.proje_ad as prj_ad,
    projeler.proje_suresi prj_suresi,
    projeler.proje_yili prj_yili,
    danismanlar.id as dnsmn_id,
    danismanlar.ad_soyad as dnsmn_ad,
    juriler.ad as juri_adi
    FROM `proje_juriler` 
    right join projeler on proje_juriler.proje_id = projeler.id 
    left join juriler on proje_juriler.juri_id = juriler.id
    left join danismanlar on projeler.danisman_id = danismanlar.id
    WHERE projeler.id = ?";

    $vt_stmt = $vt->prepare($sql);
    $vt_stmt->bind_param("i", $proje_id);
    $vt_stmt->execute();
    $vt_result = $vt_stmt->get_result();
    $kayitli_juriler = $vt_result -> fetch_all(MYSQLI_ASSOC); /* Projenin detaylarını ve jurileri çeker */
    $proje_suresi_liste = get_enum_values( $vt, "projeler", "proje_suresi" ); /* Projeler tablosundaki "proje_suresi" enum değerlerini çeker */
    $proje_yili_liste = get_enum_values( $vt, "projeler", "proje_yili" );   /* Projeler tablosundaki "proje_yili" enum değerlerini çeker */

    $sql2 = "SELECT * FROM juriler";

    $vt_stmt = $vt->prepare($sql2);
    $vt_stmt->execute();
    $vt_result = $vt_stmt->get_result();
    $tum_juriler = $vt_result -> fetch_all(MYSQLI_ASSOC); /* Juriler tablosundaki tüm jurileri çeker */

    $sql3 = "SELECT * FROM danismanlar";
    $vt_stmt = $vt->prepare($sql3);
    $vt_stmt->execute();
    $vt_result = $vt_stmt->get_result();
    $tum_danismanlar = $vt_result -> fetch_all(MYSQLI_ASSOC);  /* Danışmanlar tablosundaki tüm danışmanları çeker */
?>
<div class="not-girisi-container">
    <div class="form">
        <form action="projeDuzenle.php" id="projeDuzenleForm">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"
                tabindex="0">
                <input class="d-none" type="hidden" value="<?php echo $kayitli_juriler[0]["prj_id"]?>" name="projeID">
                <div class="yeniKayitInput">
                    <label for="ogrProjeID">Bitirme Proje ID:</label>
                    <input type="text" name="ogrProjeID" id="ogrProjeID"
                        value="<?php echo $kayitli_juriler[0]["prj_id"]?>" disabled>
                </div>
                <div class="yeniKayitInput">
                    <label for="ogrProjeAdi">Proje Adı:</label>
                    <input type="text" name="ogrProjeAdi" id="ogrProjeAdi"
                    value="<?php echo $kayitli_juriler[0]["prj_ad"]?>" disabled>
                </div>
                <div class="yeniKayitInput">
                    <label for="ogrDanisman">Proje Danışmanı:</label>
                    <select name="ogrDanisman" id="ogrDanisman">
                        <?php 
                            foreach($tum_danismanlar as $danisman){
                                if($kayitli_juriler[0]["dnsmn_ad"] == $danisman["ad_soyad"]){
                                    echo '<option value="'.$danisman["id"].'" selected>'.$danisman["ad_soyad"].'</option>';
                                }else{
                                    echo '<option value="'.$danisman["id"].'">'.$danisman["ad_soyad"].'</option>';
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="yeniKayitInput">
                    <label for="juri1-secimi">1.Jüri Üyesi:</label>
                    <select name="juri1-secimi" id="juri1-secimi">
                        <option value="null" id="j1null"></option>
                        <?php 
                    foreach($tum_juriler as $juri){
                        if($kayitli_juriler[0]["juri_adi"] == $juri["ad"]){
                            echo '<option value="'.$juri["id"].'" selected>'.$juri["ad"].'</option>';
                        }else{
                            echo '<option value="'.$juri["id"].'">'.$juri["ad"].'</option>';
                        }
                    }
                    ?>
                    </select>
                </div>
                <div class="yeniKayitInput">
                    <label for="juri2-secimi">2.Jüri Üyesi:</label>
                    <select name="juri2-secimi" id="juri2-secimi">
                        <option value="null" id="j2null"></option>
                        <?php 
                    foreach($tum_juriler as $juri){
                        if($kayitli_juriler[1]["juri_adi"] == $juri["ad"]){
                            echo '<option value="'.$juri["id"].'" selected>'.$juri["ad"].'</option>';
                        }else{
                            echo '<option value="'.$juri["id"].'">'.$juri["ad"].'</option>';
                        }
                    }
                    ?>
                    </select>
                </div>
                <div class="yeniKayitInput">
                    <label for="juri3-secimi">3.Jüri Üyesi:</label>
                    <select name="juri3-secimi" id="juri3-secimi">
                        <option value="null" id="j3null"></option>
                        <?php 
                    foreach($tum_juriler as $juri){
                        if($kayitli_juriler[2]["juri_adi"] == $juri["ad"]){
                            echo '<option value="'.$juri["id"].'" selected>'.$juri["ad"].'</option>';
                        }else{
                            echo '<option value="'.$juri["id"].'">'.$juri["ad"].'</option>';
                        }
                    }
                    ?>
                    </select>
                </div>
                <div class="yeniKayitInput">
                    <label for="juri4-secimi">4.Jüri Üyesi:</label>
                    <select name="juri4-secimi" id="juri4-secimi">
                        <option value="null" id="j4null"></option>
                        <?php 
                    foreach($tum_juriler as $juri){
                        if($kayitli_juriler[3]["juri_adi"] == $juri["ad"]){
                            echo '<option value="'.$juri["id"].'" selected>'.$juri["ad"].'</option>';
                        }else{
                            echo '<option value="'.$juri["id"].'">'.$juri["ad"].'</option>';
                        }
                    }
                    ?>
                    </select>
                </div>
                <div class="yeniKayitInput">
                    <label for="ogrPrjSuresi">Proje Süresi:</label>
                    <select name="ogrPrjSuresi" id="ogrPrjSuresi">
                    <?php 
                        foreach($proje_suresi_liste as $proje_suresi){
                            if($kayitli_juriler[0]["prj_suresi"] == $proje_suresi){
                                echo '<option value="'.$proje_suresi.'" selected>'.$proje_suresi.'</option>';
                            }else{
                                echo '<option value="'.$proje_suresi.'">'.$proje_suresi.'</option>';
                            }
                        }
                    ?>
                    </select>
                </div>
                <div class="yeniKayitInput">
                    <label for="ogrPrjYariyili">Proje Yarıyılı:</label>
                    <select name="ogrPrjYariyili" id="ogrPrjYariyili">
                    <?php 
                        foreach($proje_yili_liste as $proje_yili){
                            if($kayitli_juriler[0]["prj_yili"] == $proje_yili){
                                echo '<option value="'.$proje_yili.'" selected>'.$proje_yili.'</option>';
                            }else{
                                echo '<option value="'.$proje_yili.'">'.$proje_yili.'</option>';
                            }
                        }
                    ?>
                    </select>
                </div>
            </div>
            <div class="alert alert-danger p-0 mb-0 mt-2 d-none" role="alert" id="juriAlert">Aynı jüriyi tekrar seçemezsiniz!</div>
            <div class="d-flex justify-content-center gap-2 pt-2">
                <button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal">Vazgeç</button>
                <input type="submit" class="btn btn-primary w-100" value="Kayıt Ekle">
            </div>
        </form>
    </div>
</div>
<script>
    $("#projeDuzenleForm").submit(function(e) {
    e.preventDefault(); 
    var form = $(this);
    var actionUrl = form.attr('action');
    $.post({
            url: actionUrl,
            data: form.serialize(), // serializes the form's elements.
            success: function(data)
            {
                alert('Bilgiler güncellendi.');
            }
        });
    });
    $('#juri1-secimi').on('change', function() {
        var j1 = $("#juri1-secimi").find(":selected");
        var j2 = $("#juri2-secimi").find(":selected");
        var j3 = $("#juri3-secimi").find(":selected");
        var j4 = $("#juri4-secimi").find(":selected");
        if(j2.val() != null && j1.val() == j2.val()){
            j1.parent().prop('selectedIndex', 0);
            $('#juriAlert').removeClass("d-none");
        }
        else if(j3.val() != null && j1.val() == j3.val()){
            j1.parent().prop('selectedIndex', 0);
            $('#juriAlert').removeClass("d-none");        
        }
        else if(j4.val() != null && j1.val() == j4.val()){
            j1.parent().prop('selectedIndex', 0);
            $('#juriAlert').removeClass("d-none");       
        }
        else{
            $('#juriAlert').addClass("d-none");
        }
    });
    $('#juri2-secimi').on('change', function() {
        var j1 = $("#juri1-secimi").find(":selected");
        var j2 = $("#juri2-secimi").find(":selected");
        var j3 = $("#juri3-secimi").find(":selected");
        var j4 = $("#juri4-secimi").find(":selected");
        if(j1.val() != null && j2.val() == j1.val()){
            j2.parent().prop('selectedIndex', 0);
            $('#juriAlert').removeClass("d-none");
        }
        else if(j3.val() != null && j2.val() == j3.val()){
            j2.parent().prop('selectedIndex', 0);
            $('#juriAlert').removeClass("d-none");
        }
        else if(j4.val() != null && j2.val() == j4.val()){
            j2.parent().prop('selectedIndex', 0);
            $('#juriAlert').removeClass("d-none");
        }
        else{
            $('#juriAlert').addClass("d-none");
        }
    });
    $('#juri3-secimi').on('change', function() {
        var j1 = $("#juri1-secimi").find(":selected");
        var j2 = $("#juri2-secimi").find(":selected");
        var j3 = $("#juri3-secimi").find(":selected");
        var j4 = $("#juri4-secimi").find(":selected");
        if(j1.val() != null && j3.val() == j1.val()){
            j3.parent().prop('selectedIndex', 0);
            $('#juriAlert').removeClass("d-none");
        }
        else if(j2.val() != null && j3.val() == j2.val()){
            j3.parent().prop('selectedIndex', 0);
            $('#juriAlert').removeClass("d-none");
        }
        else if(j4.val() != null && j3.val() == j4.val()){
            j3.parent().prop('selectedIndex', 0);
            $('#juriAlert').removeClass("d-none");
        }
        else{
            $('#juriAlert').addClass("d-none");
        }
    });
    $('#juri4-secimi').on('change', function() {
        var j1 = $("#juri1-secimi").find(":selected");
        var j2 = $("#juri2-secimi").find(":selected");
        var j3 = $("#juri3-secimi").find(":selected");
        var j4 = $("#juri4-secimi").find(":selected");
        if(j1.val() != null && j4.val() == j1.val()){
            j4.parent().prop('selectedIndex', 0);
            $('#juriAlert').removeClass("d-none");
        }
        else if(j2.val() != null && j4.val() == j2.val()){
            j4.parent().prop('selectedIndex', 0);
            $('#juriAlert').removeClass("d-none");
        }
        else if(j3.val() != null && j4.val() == j3.val()){
            j4.parent().prop('selectedIndex', 0);
            $('#juriAlert').removeClass("d-none");
        }
        else{
            $('#juriAlert').addClass("d-none");
        }
    });

</script>