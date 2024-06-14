<?php
	include "baglanti.php";
	$sql = "DELETE FROM `notlar` WHERE ogrenci_id=?";
	$vt_stmt = $vt->prepare($sql);
    $vt_stmt->bind_param("i", $_POST["ogrenciID"]);
    $vt_stmt->execute();

	if(isset($_POST["juri-1-ID"])){
		$juri_1_not = ($_POST["juri-1-not-1"]+$_POST["juri-1-not-2"]+$_POST["juri-1-not-3"])/3;
	}else{
		$juri_1_not = 0;
	}
	if(isset($_POST["juri-2-ID"])){
		$juri_2_not = ($_POST["juri-2-not-1"]+$_POST["juri-2-not-2"]+$_POST["juri-2-not-3"])/3;
	}else{
		$juri_2_not = 0;
	}
	if(isset($_POST["juri-3-ID"])){
		$juri_3_not = ($_POST["juri-3-not-1"]+$_POST["juri-3-not-2"]+$_POST["juri-3-not-3"])/3;
	}else{
		$juri_3_not = 0;
	}
	if(isset($_POST["juri-4-ID"])){
		$juri_4_not = ($_POST["juri-4-not-1"]+$_POST["juri-4-not-2"]+$_POST["juri-4-not-3"])/3;
	}else{
		$juri_4_not = 0;
	}

	$sql = "INSERT INTO `notlar`(`ogrenci_id`, `proje_id`, `juri1_id`, `juri2_id`, `juri3_id`, `juri4_id`, `juri1_not`, `juri2_not`, `juri3_not`, `juri4_not`) VALUES (?,?,?,?,?,?,?,?,?,?)";
	$vt_stmt = $vt->prepare($sql);
    $vt_stmt->bind_param("iiiiiidddd", $_POST["ogrenciID"],$_POST["proje"],$_POST["juri-1-ID"],$_POST["juri-2-ID"],$_POST["juri-3-ID"],$_POST["juri-4-ID"], $juri_1_not,$juri_2_not,$juri_3_not,$juri_4_not);
    $vt_stmt->execute();
?>