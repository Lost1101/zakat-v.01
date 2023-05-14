<?php
    $fetch_amil = $master->amil()->fetch_array();
?>
<div class="w-1/6 bg-green-950 h-screen">
        <div>
          <img src="./img/logo.png" alt="" class="w-24 mx-auto my-6">
          <img src="./img/<?=$fetch_amil['img']?>" alt="" class="rounded-full w-16 bg-green-800 mx-auto">
          <p class="text-center text-white mt-3 font-bold"><?=$fetch_amil['uname']?></p>
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