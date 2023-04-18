<?php
    include "koneksi.php";

    date_default_timezone_set('Asia/Jakarta'); 
    $today = date("d-m-Y");

  $jmlmuzakki = mysqli_query($conn, "SELECT * FROM muzakki");
  $jmlmustahik = mysqli_query($conn, "SELECT * FROM mustahik");
  $muzakki = mysqli_num_rows($jmlmuzakki);
  $mustahik = mysqli_num_rows($jmlmustahik);
  $sqluang = mysqli_query($conn, "SELECT SUM(besar_bayar) FROM bayarzakat WHERE uang = 1");
  $uang = mysqli_fetch_array($sqluang);
  $sqlberas = mysqli_query($conn, "SELECT SUM(besar_bayar) FROM bayarzakat WHERE beras = 1");
  $beras = mysqli_fetch_array($sqlberas);
  $sqlorang = mysqli_query($conn, "SELECT SUM(jml_tanggungan) FROM distribusi");
  $orang = mysqli_fetch_array($sqlorang);
  $sqljumlah = mysqli_query($conn, "SELECT SUM(besar) FROM distribusi");
  $jumlah = mysqli_fetch_array($sqljumlah);
?>
<!DOCTYPE html>
<html>
	<head>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
		<script>
			function generatePDF() {
			const element = document.getElementById('container_content');
			var opt = {
				  margin:       0.2,
				  filename:     'laporan_pengumpulan.pdf',
				  image:        { type: 'jpeg', quality: 0.98 },
				  html2canvas:  { scale: 2 },
				  jsPDF:        { unit: 'in', format: 'a4', orientation: 'portrait' }
				};
				// Choose the element that our invoice is rendered in.
				html2pdf().set(opt).from(element).save();
			}
		</script>
		</head>
<body style="font-family: 'Work Sans', sans-serif;">
<div class="container_content" id="container_content" >
    <div style="width: 720px; height: 1050px; padding: 10px;">
        <div style="margin: 0 auto;">
            <div style="display: flex; padding: 2px; margin: 0 auto; text-align: center;">
                <div style="margin: 0 auto;">
                    <h3 style="font-weight: 700; font-size: 16px;">TIM MYZAKAT</h3>
                    <p style="font-size: 12px;">Jl.Fuschia No.11, Elvendia Capital, Kekaisaran Elvendia</p>
                    <p style="font-size: 12px;">Masjid Agung Al-Kanabawi</p>
                    <p style="font-size: 12px;">1 Syawal 1444H/2023 M</p>
                </div>
            </div>
            <hr style="border-bottom: 1px black solid;">
            <div style="padding: 10px;">
                <h1 style="font-weight: 700; font-size: 16px; text-align: center; text-decoration: underline;">LAPORAN HASIL PENGUMPULAN ZAKAT FITRAH</h1>
                <?php
                    $total_orang = $mustahik + $muzakki;
                ?>
                <p style="font-size: 13px; text-align: center;">Jumlah zakat fitrah kepanitia Masjid Agung Al-Kanabawi, 1 Syawal 1444H/2023 M sebanyak : <span style="font-weight: 700;"> <?=$total_orang?> Jiwa</span></p>
                <h4 style="font-weight: 700; font-size: 14px; text-decoration: underline;">Muzakki dan Mustahik</h4>
                <p style="font-size: 12px;">Muzakki : <?=$muzakki?> Jiwa</p>
                <p style="font-size: 12px;">Mustahik : <?=$mustahik?> Jiwa</p>
                <h4 style="font-weight: 700; font-size: 14px; text-decoration: underline;">Zakat Terkumpul</h4>
                <p style="font-size: 12px;">Beras : <?=$beras['SUM(besar_bayar)']?> kg</p>
                <p style="font-size: 12px; ">Uang : Rp.<?=$uang['SUM(besar_bayar)']?>,-</p>
                <h4 style="font-weight: 700; font-size: 14px; text-decoration: underline;">Perhitungan</h4>
                <p style="font-size: 13px;">Zakat dibagikan secara merata dengan jenis beras, sehingga hasil perhitungan konversinya sebagai berikut :</p>
                <p style="font-size: 12px;">1 Muzakki = 2,5 kg beras = Rp.37.500</p>
                <?php
                  $konversi = $uang['SUM(besar_bayar)'] / 37500 * 2.5;
                  $total = $beras['SUM(besar_bayar)'] + $konversi;
                ?>
                <p style="font-size: 12px; ">Rp.<?=$uang['SUM(besar_bayar)']?> / Rp.37.500 = <?=$konversi?> kg</p>
                <p style="font-size: 12px;">Total keseluruhan beras = <?=$beras['SUM(besar_bayar)']?> + <?=$konversi?> = <?=$total?> kg</p>
                <br>
                <p style="font-size: 12px;">Total keseluruhan mustahik = <?=$mustahik?> jiwa</p>
                <?php
                    $pembagian = $total / $mustahik;
                ?>
                <p style="font-size: 12px;">1 Mustahik masing-masing mendapatkan = <?=$pembagian?> kg</p>
            </div>
            <div style="text-align: right; margin-right: 70px;">
                <p style="font-weight: 700; font-size: 16px;"><?=$today?></p>
                <img src="./img/ttd.png" alt=""  style="height: 100px; margin-right: 20px; border-bottom: 1px black solid; text-align: center;">
                <p style="font-weight: 700; font-size: 16px;">Tim MyZakat</p>
            </div>
            <h1></h1>
        </div>
    </div>
</div>

<script>
    generatePDF();
</script>
<meta http-equiv="refresh" content="0.2;url=./laporan.php" />
</body>
</html>