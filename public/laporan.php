<?php
  session_start();
  ob_start();
  include "koneksi.php";

  $sqlamil = mysqli_query($conn, "SELECT * FROM amil WHERE uname = '$_SESSION[uname]'");
  $amil    =mysqli_fetch_array($sqlamil);

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
          <button class="border border-white rounded-lg p-2"><a href="./logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a></button>
        </div>
      </div>
      <div class="text-center mx-auto p-5">
        <div>
            <h1 class="font-bold text-4xl underline text-center">Laporan</h1>
            <div>
              <a href="./lappengumpulan.php"><button class="border border-black rounded-lg p-10 m-10 duration-300 hover:bg-green-600"><i class="fa-solid fa-print"></i> Buat Laporan Pengumpulan (.pdf)</button></a>
              <a href="./lapdistribusi.php"><button class="border border-black rounded-lg p-10 m-10 duration-300 hover:bg-green-600"><i class="fa-solid fa-print"></i> Buat Laporan Distribusi (.pdf)</button></a>
            </div>
        </div>
      </div>
     </div>
</body>
</html>