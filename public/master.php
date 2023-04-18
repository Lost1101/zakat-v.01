<?php
  session_start();
  ob_start();
  include "koneksi.php";

  $sqlamil = mysqli_query($conn, "SELECT * FROM amil WHERE uname = '$_SESSION[uname]'");
  $amil    =mysqli_fetch_array($sqlamil);

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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://kit.fontawesome.com/faf88445ba.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>MyZakat | Solusi Zakat Digital</title>
</head>
<body class="font-worksans">
    <div class="flex">
      <div class="w-1/6 bg-green-950 h-screen">
        <div>
          <img src="./img/logo.png" alt="" class="w-24 mx-auto my-6">
          <img src="./img/<?=$amil['img']?>" alt="" class="rounded-full w-16 bg-green-800 mx-auto">
          <p class="text-center text-white mt-3 font-bold"><?=$amil['uname']?></p>
          <p class="text-center text-sm text-white">Amil</p>
        </div>
        <div class="text-white p-7">
            <a href="master.php" class="block my-2 text-sm transition duration-300 hover:text-green-500">Dashboard</a>
          <a href="muzakki.php" class="block my-2 text-sm transition duration-300 hover:text-green-500">Data Muzakki</a>
          <a href="mustahik.php" class="block my-2 text-sm transition duration-300 hover:text-green-500">Data Mustahik</a>
          <a href="zakat.php" class="block my-2 text-sm transition duration-300 hover:text-green-500">Input Zakat</a>
          <a href="distribusi.php" class="block my-2 text-sm transition duration-300 hover:text-green-500">Distribusi</a>
          <a href="laporan.php" class="block my-2 text-sm transition duration-300 hover:text-green-500">Laporan</a>
        </div>
        <div class="text-white w-1/2 mx-14 absolute bottom-0 m-5">
          <button class="border border-white rounded-lg p-2 duration-300 hover:bg-green-600"><a href="./logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a></button>
        </div>
      </div>
      <div class="text-center mx-auto w-5/6">
        <h1 class="text-4xl font-bold underline mt-10">Dashboard</h1>
        <p class="text-lg m-2">Preview Data Keseluruhan</p>
        <div class="flex justify-around">
            <div class="rounded-lg overflow-hidden m-5">
              <canvas class="p-1" id="chartPie"></canvas>
              <p>Jumlah Muzakki : <?=$muzakki?></p>
              <p>Jumlah Mustahik : <?=$mustahik?></p>
            </div>
            <div class="my-10">
              <h1 class="font-bold text-2xl underline">Konversi Uang</h1>
              <div class="text-left p-5">
                <p>Beras per muzakki : 2,5 kg : Rp. 37500</p>
                <p>Beras yang terkumpul : <?=$beras['SUM(besar_bayar)']?> kg</p>
                <p>Uang yang terkumpul : Rp. <?=$uang['SUM(besar_bayar)']?></p>
                <?php
                  $konversi = $uang['SUM(besar_bayar)'] / 37500 * 2.5;
                  $total = $beras['SUM(besar_bayar)'] + $konversi;
                ?>
                <p>Konversi uang ke beras : <?=$uang['SUM(besar_bayar)']?> / 37500 = <?=$konversi?> kg</p>
                <p>Total beras : <?=$total?> kg</p>
              </div>
              <?php
              $sisa = $total - $jumlah['SUM(besar)'];
              ?>
              <div class="flex mx-auto justify-evenly my-10">
                <div>
                  <h1 class="font-bold text-lg border border-black p-3">Distribusi</h1>
                  <h2 class="font-bold text-2xl border border-black p-5"><?=$orang['SUM(jml_tanggungan)']?></h2>
                  <p class="border border-black">Orang</p>
                </div>
                <div>
                  <h1 class="font-bold text-lg border border-black p-3">Sisa Beras</h1>
                  <h2 class="font-bold text-2xl border border-black p-5"><?=$sisa?></h2>
                  <p class="border border-black">Kg</p>
                </div>
              </div>
          </div>
        </div>
      </div>
     </div>


   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   <script>
    const dataPie = {
      labels: ["Muzakki", "Mustahik", ],
      datasets: [
        {
          label: "Jumlah orang",
          data: [<?=$muzakki?>, <?=$mustahik?>],
          backgroundColor: [
            "#056c34",
            "#e49404",
          ],
        },
      ],
    };

    const configPie = {
      type: "pie",
      data: dataPie,
      options: {},
    };

    var chartBar = new Chart(document.getElementById("chartPie"), configPie);
  </script>
</body>
</html>