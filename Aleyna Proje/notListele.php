<?php
	include "baglanti.php";
	$sql = "INSERT INTO `notlar`(`ogrenci_id`, `proje_id`, `juri1_id`, `juri2_id`, `juri3_id`, `juri4_id`, `juri1_not`, `juri2_not`, `juri3_not`, `juri4_not`) VALUES (?,?,?,?,?,?,?,?,?,?)";
	$vt_stmt = $vt->prepare($sql);
    $vt_stmt->bind_param("i", );
    $vt_stmt->execute();
?>