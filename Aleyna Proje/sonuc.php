<?php
  include 'baglanti.php';
  if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['kullanici_email'])){
    $stmt = $vt->prepare("SELECT * FROM kullanicilar WHERE email=? AND password=?");
    $stmt -> bind_param("ss",$email,$password);

    $email = $_POST['kullanici_email'];
    $password = md5($_POST['kullanici_pwd']);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
	if($user){
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
	</script>
	<script src="https://code.jquery.com/jquery-3.7.1.min.js"
		integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="css/style.css">
	<title>Bitirme Projesi Değerlendirme Sistemi</title>
</head>

<body>
	<div class="baslik">
		<img src="img/logo.png" alt="Logo">
		<h1>Bitirme Projesi Değerlendirme Sistemi</h1>
		<a href="girispaneli.php">Çıkış Yap</a>
	</div>
	<div class="panel">
		<ul class="nav nav-pills" id="pills-tab" role="tablist">
			<li class="nav-item" role="presentation">
				<button class="nav-link" id="pills-bitirme-projeleri-tab" data-bs-toggle="pill"
					data-bs-target="#pills-bitirme-projeleri" type="button" role="tab"
					aria-controls="pills-bitirme-projeleri" aria-selected="false">Bitirme Projeleri</button>
			</li>
			<li class="nav-item" role="presentation">
				<button class="nav-link" id="pills-akademisyenler-tab" data-bs-toggle="pill"
					data-bs-target="#pills-akademisyenler" type="button" role="tab" aria-controls="pills-akademisyenler"
					aria-selected="false">Akademisyenler</button>
			</li>
			<li class="nav-item" role="presentation">
				<button class="nav-link" id="pills-ogrenciler-tab" data-bs-toggle="pill"
					data-bs-target="#pills-ogrenciler" type="button" role="tab" aria-controls="pills-ogrenciler"
					aria-selected="false">Öğrenciler</button>
			</li>
			<li class="nav-item" role="presentation">
				<button class="nav-link" id="pills-genel-liste-tab" data-bs-toggle="pill"
					data-bs-target="#pills-genel-liste" type="button" role="tab" aria-controls="pills-genel-liste"
					aria-selected="false">Genel Liste</button>
			</li>
		</ul>
	</div>
	<!-- Modal -->
	<div class="tab-content" id="pills-tabContent">
	<div class="tab-pane fade" id="pills-bitirme-projeleri" role="tabpanel"
		aria-labelledby="pills-bitirme-projeleri-tab" tabindex="0">
		<div class="projeler-container"></div>
	</div>
	<div class="tab-pane fade" id="pills-akademisyenler" role="tabpanel" aria-labelledby="pills-akademisyenler-tab"
		tabindex="0">
		<div class="projeler-container"></div>
	</div>
	<div class="tab-pane fade" id="pills-ogrenciler" role="tabpanel" aria-labelledby="pills-ogrenciler-tab"
		tabindex="0">
		<div class="projeler-container"></div>
	</div>
	<div class="tab-pane fade" id="pills-genel-liste" role="tabpanel" aria-labelledby="pills-genel-liste-tab"
		tabindex="0">
		<div class="projeler-container"></div>
	</div>
	</div>

</body>

</html>
<script>
$("#pills-bitirme-projeleri-tab").click(function(e) {
	e.preventDefault();
	$(".projeler-container").load("projeListele.php", function() {
		this; // dom element
	});
});
$("#pills-akademisyenler-tab").click(function(e) {
	e.preventDefault();
	$(".projeler-container").load("akademisyenListele.php", function() {
		this; // dom element
	});
});
$("#pills-ogrenciler-tab").click(function(e) {
	e.preventDefault();
	$(".projeler-container").load("ogrenciListele.php", function() {
		this; // dom element
	});
});
$("#pills-genel-liste-tab").click(function(e) {
	e.preventDefault();
	$(".projeler-container").load("genelListele.php", function() {
		this; // dom element
	});
});
</script>

<?php
  }
  else{
	if($_SERVER["REQUEST_METHOD"] == "POST" && !isset($user)){
		header("Location: girispaneli.php?hatali_giris=1");
	}
	else{
		header("Location: girispaneli.php");
	}
  }
  
}
else{
	header("Location: girispaneli.php");
}
?>