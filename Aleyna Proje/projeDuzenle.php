<?php 
	include "baglanti.php";
	if(isset($_POST["ogrDanisman"]) && isset($_POST["ogrPrjSuresi"]) && isset($_POST["ogrPrjYariyili"])){
		$sql = "UPDATE projeler SET 
		proje_suresi=?,
		proje_yili=?,
		danisman_id=? WHERE id=?";
		$stmt = $vt->prepare($sql);
		$stmt->bind_param("ssii", 
		$_POST["ogrPrjSuresi"], 
		$_POST["ogrPrjYariyili"], 
		$_POST["ogrDanisman"], 
		$_POST["projeID"]);
		$result = $stmt->execute();
        $response = new stdClass;
        $response->isSuccessful = 0;
        if($result){
			$response->isSuccessful = 1;
        }
		$sql = "DELETE FROM `proje_juriler` WHERE proje_id=?";
		$stmt = $vt->prepare($sql);
		$stmt->bind_param("i", $_POST["projeID"]);
		$stmt->execute();
		
		$sql1 = "INSERT INTO `proje_juriler`(`proje_id`, `juri_id`) VALUES (".$_POST['projeID'].",".$_POST['juri1-secimi'].")";
		$sql2 = "INSERT INTO `proje_juriler`(`proje_id`, `juri_id`) VALUES (".$_POST['projeID'].",".$_POST['juri2-secimi'].")";
		$sql3 = "INSERT INTO `proje_juriler`(`proje_id`, `juri_id`) VALUES (".$_POST['projeID'].",".$_POST['juri3-secimi'].")";
		$sql4 = "INSERT INTO `proje_juriler`(`proje_id`, `juri_id`) VALUES (".$_POST['projeID'].",".$_POST['juri4-secimi'].")";
		$stmt1 = $vt->prepare($sql1);
		$stmt2 = $vt->prepare($sql2);
		$stmt3 = $vt->prepare($sql3);
		$stmt4 = $vt->prepare($sql4);
		$stmt1->execute();
		$stmt2->execute();
		$stmt3->execute();
		$stmt4->execute();
}	
?>