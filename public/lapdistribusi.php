<?php
    include "koneksi.php";
    include "functions.php";

    $sql = "SELECT * FROM mustahik";
    $sqlfakir = mysqli_query($conn, "$sql WHERE kategori = 'Fakir'");
    $sqlmiskin = mysqli_query($conn, "$sql WHERE kategori = 'Miskin'");
    $sqlamil = mysqli_query($conn, "$sql WHERE kategori = 'Amil'");
    $sqlmuallaf = mysqli_query($conn, "$sql WHERE kategori = 'Muallaf'");
    $sqlriqab = mysqli_query($conn, "$sql WHERE kategori = 'Riqab'");
    $sqlgharim = mysqli_query($conn, "$sql WHERE kategori = 'Gharim'");
    $sqlfisabilillah = mysqli_query($conn, "$sql WHERE kategori = 'Fi Sabilillah'");
    $sqlibnusabil = mysqli_query($conn, "$sql WHERE kategori = 'Ibnu Sabil'");
    $fakir = mysqli_num_rows($sqlfakir);
    $miskin = mysqli_num_rows($sqlmiskin);
    $amil = mysqli_num_rows($sqlamil);
    $muallaf = mysqli_num_rows($sqlmuallaf);
    $riqab = mysqli_num_rows($sqlriqab);
    $gharim = mysqli_num_rows($sqlgharim);
    $fisabilillah = mysqli_num_rows($sqlfisabilillah);
    $ibnusabil = mysqli_num_rows($sqlibnusabil);
    $jmlmustahik = mysqli_query($conn, "SELECT * FROM mustahik");
    $mustahik = mysqli_num_rows($jmlmustahik);
    $sqluang = mysqli_query($conn, "SELECT SUM(besar_bayar) FROM bayarzakat WHERE uang = 1");
    $uang = mysqli_fetch_array($sqluang);
    $sqlberas = mysqli_query($conn, "SELECT SUM(besar_bayar) FROM bayarzakat WHERE beras = 1");
    $beras = mysqli_fetch_array($sqlberas);
    $sqldistribusi = mysqli_query($conn, "SELECT * FROM distribusi");
    date_default_timezone_set('Asia/Jakarta'); 
    $today = date("d-m-Y");
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
				  filename:     'laporan_distribusi.pdf',
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
        <div class="text-center" style="padding:20px;"></div>
        <button onclick="generatePDF()">Generate PDF using HTML2PDF</button>
    </div>
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
                <h1 style="font-weight: 700; font-size: 16px; text-align: center; text-decoration: underline;">LAPORAN PENDISTRIBUSIAN ZAKAT FITRAH</h1>
                <p style="font-size: 12px; text-align: center;">Zakat fitrah Masjid Agung Al-Kanabawi, 1 Syawal 1444H/2023 M dibagikan kepada sebanyak : <span style="font-weight: 700;"> <?=$mustahik?> Mustahik</span></p>
                <h4 style="font-weight: 700; font-size: 14px; text-decoration: underline;">Detail Mustahik</h4>
                    <p style="font-size: 12px;">Fakir : <?=$fakir?> Jiwa</p>
                    <p style="font-size: 12px;">Miskin : <?=$miskin?> Jiwa</p>
                    <p style="font-size: 12px;">Amil : <?=$amil?> Jiwa</p>
                    <p style="font-size: 12px;">Muallaf : <?=$muallaf?> Jiwa</p>
                    <p style="font-size: 12px;">Riqab : <?=$riqab?> Jiwa</p>
                    <p style="font-size: 12px;">Gharim : <?=$gharim?> Jiwa</p>
                    <p style="font-size: 12px;">Fi Sabilillah : <?=$fisabilillah?> Jiwa</p>
                    <p style="font-size: 12px;">Ibnu Sabil : <?=$ibnusabil?> Jiwa</p>
                    <p style="font-size: 12px; font-weight: 700;">Total : <?=$mustahik?> Jiwa</p>
                    <br>
                <h4 style="font-weight: 700; font-size: 14px; text-decoration: underline;">Detail Distribusi</h4>
                <?php
                    $konversi = $uang['SUM(besar_bayar)'] / 37500 * 2.5;
                    $total = $beras['SUM(besar_bayar)'] + $konversi;
                    $pembagian = $total / $mustahik;
                ?>
                <p style="font-size: 13px;">Zakat dibagikan secara merata dengan jenis beras, sehingga pendistribusian seperti berikut : <span style="font-weight: 700; display: inline-block;">1 Mustahik = <?=$pembagian?> kg</span></p>
                    <p style="font-size: 12px;">Fakir : <?=$fakir?> Kg</p>
                    <p style="font-size: 12px;">Miskin : <?=$miskin?> Kg</p>
                    <p style="font-size: 12px;">Amil : <?=$amil?> Kg</p>
                    <p style="font-size: 12px;">Muallaf : <?=$muallaf?> Kg</p>
                    <p style="font-size: 12px;">Riqab : <?=$riqab?> Kg</p>
                    <p style="font-size: 12px;">Gharim : <?=$gharim?> Kg</p>
                    <p style="font-size: 12px;">Fi Sabilillah : <?=$fisabilillah?> Kg</p>
                    <p style="font-size: 12px;">Ibnu Sabil : <?=$ibnusabil?> Kg</p>
                    <p style="font-size: 12px; font-weight: 700;">Total : <?=$pembagian * $mustahik?> Kg</p>
            </div>
            <div style="text-align: right; margin-right: 70px;">
                <p style="font-weight: 700; font-size: 16px;"><?=$today?></p>
                <img src="./img/ttd.png" alt=""  style="height: 100px; margin-right: 20px; border-bottom: 1px black solid; text-align: center;">
                <p style="font-weight: 700; font-size: 16px;">Tim MyZakat</p>
            </div>
            <h1></h1>
        </div>
    </div>

    <div style="width: 720px; height: 1050px; padding: 20px;">
            <div style="margin: 0 auto;">
            <h1 style="font-weight: 700; font-size: 16px; text-align:center; text-decoration: underline;">DATA MUSTAHIK PENERIMA ZAKAT</h1>
            <?php $i = 1 ?>
            <?php foreach($sqldistribusi as $distribusi) : ?>
                <div style="display: flex;">
                    <p style="font-size: 12px;"><span><?=$i?>.</span> <?=$distribusi['nama']?></p>
                </div>
            <?php $i++ ?>
            <?php endforeach; ?>
            </div>
    </div>
</div>

<script>
    generatePDF()
</script>
<meta http-equiv="refresh" content="0.2;url=./laporan.php" />
</body>
</html>