<?php 
    include "baglanti.php";
    $ogrenci_id = $_GET["ogrenci_id"];
    $sql = "SELECT ogrenciler.id as o_id,
	ogrenciler.*,
	projeler.id as p_id,
	projeler.proje_ad as p_ad,
	projeler.danisman_id as p_danisman_id,
	danismanlar.id as d_id,
	danismanlar.ad_soyad as d_ad,
	juriler.id as j_id,
	juriler.ad as j_ad,
	proje_juriler.*
	FROM ogrenciler 
	left join projeler on ogrenciler.proje_id=projeler.id 
	left join danismanlar on ogrenciler.danisman_id=danismanlar.id 
	left join proje_juriler on proje_juriler.proje_id=ogrenciler.proje_id 
	left join juriler on proje_juriler.juri_id=juriler.id 
	where ogrenciler.id=?";

    $vt_stmt = $vt->prepare($sql);
    $vt_stmt->bind_param("i", $ogrenci_id);
    $vt_stmt->execute();
    $vt_result = $vt_stmt->get_result();
    $ogrenci_bilgiler = $vt_result -> fetch_all(MYSQLI_ASSOC);

	$sql2 = "SELECT projeler.id as p_id,
	projeler.proje_ad as p_ad,
	danismanlar.id as d_id,
	danismanlar.ad_soyad as d_ad
	FROM `projeler` left join danismanlar on projeler.danisman_id=danismanlar.id";

    $vt_stmt = $vt->prepare($sql2);
    $vt_stmt->execute();
    $vt_result = $vt_stmt->get_result();
    $tum_projeler = $vt_result -> fetch_all(MYSQLI_ASSOC); /* Projeler tablosundaki tüm jurileri çeker */
?>
<div class="not-girisi-container ogrenci-detay-container">
	<div class="form">
		<form action="notGir.php" id="notGirForm">
			<input class="d-none" type="hidden" value="<?php echo $ogrenci_bilgiler[0]["o_id"]?>" name="ogrenciID">
			<div class="yeniKayitInput">
				<label for="ogrID">Öğrenci ID:</label>
				<input type="text" name="ogrID" id="ogrID" value="<?php echo $ogrenci_bilgiler[0]["o_id"]?>" disabled>
			</div>
			<div class="yeniKayitInput">
				<label for="ogrNo">Öğrenci No:</label>
				<input type="text" name="ogrNo" id="ogrNo" value="<?php echo $ogrenci_bilgiler[0]["ogrenci_no"]?>" disabled>
			</div>
			<div class="yeniKayitInput">
				<label for="ogrAd">Öğrenci Adı Soyadı:</label>
				<input type="text" name="ogrAd" id="ogrAd" value="<?php echo $ogrenci_bilgiler[0]["ad"].' '.$ogrenci_bilgiler[0]["soyad"]?>" disabled>
			</div>
			<div class="yeniKayitInput">
				<label for="proje">Proje:</label>
				<select name="proje" id="proje" onChange="test()">
					<option value="null">- Proje seçiniz -</option>
					<?php 
						foreach($tum_projeler as $proje){
							if($ogrenci_bilgiler[0]["p_id"] == $proje["p_id"]){
								echo '<option value="'.$proje["p_id"].'" selected>'.$proje["p_id"].' - '.$proje["p_ad"].' | '.$proje["d_ad"].'</option>';
							}else{
								echo '<option value="'.$proje["p_id"].'">'.$proje["p_id"].' - '.$proje["p_ad"].' | '.$proje["d_ad"].'</option>';
							}
						}
					?>
				</select>
			</div>
			<div class="yeniKayitInput">
				<label for="juri-1-not"><b><?php if(isset($ogrenci_bilgiler[0]["j_ad"])) echo $ogrenci_bilgiler[0]["j_ad"].":"; else echo "<i>Jüri Seçilmedi</i>";?></b></label>
				<input class="d-none" type="hidden" name="juri-1-ID" <?php if(!isset($ogrenci_bilgiler[0]["j_id"])) echo "disabled"; else echo 'value="'.$ogrenci_bilgiler[0]["j_id"].'"';?>>
				<div>
					<input type="text" class="small-input" name="juri-1-not-1" maxlength="3" placeholder="1.Not" <?php if(!isset($ogrenci_bilgiler[0]["j_id"])) echo "disabled";?>>
					<input type="text" class="small-input" name="juri-1-not-2" maxlength="3" placeholder="2.Not" <?php if(!isset($ogrenci_bilgiler[0]["j_id"])) echo "disabled";?>>
					<input type="text" class="small-input" name="juri-1-not-3" maxlength="3" placeholder="3.Not" <?php if(!isset($ogrenci_bilgiler[0]["j_id"])) echo "disabled";?>>
				</div>
			</div>
			<div class="yeniKayitInput">
				<label for="juri-2-not"><b><?php if(isset($ogrenci_bilgiler[1]["j_ad"])) echo $ogrenci_bilgiler[1]["j_ad"].":"; else echo "<i>Jüri Seçilmedi</i>";?></b></label>
				<input class="d-none" type="hidden" name="juri-2-ID" <?php if(!isset($ogrenci_bilgiler[1]["j_id"])) echo "disabled"; else echo 'value="'.$ogrenci_bilgiler[1]["j_id"].'"';?>>
				<div>
					<input type="text" class="small-input" name="juri-2-not-1" maxlength="3" placeholder="1.Not" <?php if(!isset($ogrenci_bilgiler[1]["j_id"])) echo "disabled";?>>
					<input type="text" class="small-input" name="juri-2-not-2" maxlength="3" placeholder="2.Not" <?php if(!isset($ogrenci_bilgiler[1]["j_id"])) echo "disabled";?>>
					<input type="text" class="small-input" name="juri-2-not-3" maxlength="3" placeholder="3.Not" <?php if(!isset($ogrenci_bilgiler[1]["j_id"])) echo "disabled";?>>
				</div>
			</div>
			<div class="yeniKayitInput">
				<label for="juri-3-not"><b><?php if(isset($ogrenci_bilgiler[2]["j_ad"])) echo $ogrenci_bilgiler[2]["j_ad"].":"; else echo "<i>Jüri Seçilmedi</i>";?></b></label>
				<input class="d-none" type="hidden" name="juri-3-ID" <?php if(!isset($ogrenci_bilgiler[2]["j_id"])) echo "disabled"; else echo 'value="'.$ogrenci_bilgiler[2]["j_id"].'"';?>>
				<div>
					<input type="text" class="small-input" name="juri-3-not-1" maxlength="3" placeholder="1.Not" <?php if(!isset($ogrenci_bilgiler[2]["j_id"])) echo "disabled";?>>
					<input type="text" class="small-input" name="juri-3-not-2" maxlength="3" placeholder="2.Not" <?php if(!isset($ogrenci_bilgiler[2]["j_id"])) echo "disabled";?>>
					<input type="text" class="small-input" name="juri-3-not-3" maxlength="3" placeholder="3.Not" <?php if(!isset($ogrenci_bilgiler[2]["j_id"])) echo "disabled";?>>
				</div>
			</div>
			<div class="yeniKayitInput">
				<label for="juri-4-not"><b><?php if(isset($ogrenci_bilgiler[3]["j_ad"])) echo $ogrenci_bilgiler[3]["j_ad"].":"; else echo "<i>Jüri Seçilmedi</i>";?></b></label>
				<input class="d-none" type="hidden" name="juri-4-ID" <?php if(!isset($ogrenci_bilgiler[3]["j_id"])) echo "disabled"; else echo 'value="'.$ogrenci_bilgiler[3]["j_id"].'"';?>>
				<div>
					<input type="text" class="small-input" name="juri-4-not-1" maxlength="3" placeholder="1.Not" <?php if(!isset($ogrenci_bilgiler[3]["j_id"])) echo "disabled";?>>
					<input type="text" class="small-input" name="juri-4-not-2" maxlength="3" placeholder="2.Not" <?php if(!isset($ogrenci_bilgiler[3]["j_id"])) echo "disabled";?>>
					<input type="text" class="small-input" name="juri-4-not-3" maxlength="3" placeholder="3.Not" <?php if(!isset($ogrenci_bilgiler[3]["j_id"])) echo "disabled";?>>
				</div>
			</div>
			<div class="d-flex justify-content-center gap-2 pt-2">
				<button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal">Vazgeç</button>
                <input type="submit" class="btn btn-primary w-100" value="Kayıt Ekle">
            </div>
        </form>
    </div>
</div>
<script>
	$("form#notGirForm").submit(function(e) {
    e.preventDefault(); 
    var form = $(this);
    var actionUrl = form.attr('action');
    $.post({
            url: actionUrl,
            data: form.serialize(), // serializes the form's elements.
            success: function(data)
            {
                alert('Not bilgileri kaydedildi.');
            }
        });
    });
</script>
<pre>
	<?php echo print_r($ogrenci_bilgiler);?>
</pre>