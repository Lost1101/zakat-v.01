<?php
  session_start();
  ob_start();
  include "koneksi.php";
  include "functions.php";

    $jumlahDataPerHalaman = 10;
    $jumlahData = count(query("SELECT * FROM muzakki"));
    $jumlahHalaman = ceil( $jumlahData / $jumlahDataPerHalaman);
    $halamanAktif = (isset($_GET['halaman'])) ? $_GET['halaman'] : 1;
    $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

  $sqlamil = mysqli_query($conn, "SELECT * FROM amil WHERE uname = '$_SESSION[uname]'");
  $amil    =mysqli_fetch_array($sqlamil);

  $sqlmuzakki = query("SELECT * FROM muzakki LIMIT $awalData, $jumlahDataPerHalaman");

if( isset($_POST['tambah']) ){


    if(tambahmuz($_POST) > 0 ){
        echo "
            <script>
                alert('Data berhasil ditambahkan!');
                document.location.href = 'muzakki.php';
            </script>
        ";
    }else{
        echo "
            <script>
                alert('Data gagal ditambahkan!');
                document.location.href = 'muzakki.php';
            </script>
        ";
    }
  }

if( isset($_POST['edit']) ){


        if(editmuz($_POST) > 0 ){
            echo "
                <script>
                    alert('Data berhasil diubah!');
                    document.location.href = 'muzakki.php';
                </script>
            ";
        }else{
            echo "
                <script>
                    alert('Data gagal diubah!');
                    document.location.href = 'muzakki.php';
                </script>
            ";
        }
    }

    if( isset($_POST['hapus']) ){


        if(hapusmuz($_POST) > 0 ){
            echo "
                <script>
                    alert('Data berhasil dihapus!');
                    document.location.href = 'muzakki.php';
                </script>
            ";
        }else{
            echo "
                <script>
                    alert('Data gagal dihapus!');
                    document.location.href = 'muzakki.php';
                </script>
            ";
        }
    }



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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
    <title>MyZakat | Solusi Zakat Digital</title>
</head>
<body class="font-worksans">
    <div>
        <button id="defaultModalButton" data-modal-toggle="defaultModal" class="bg-green-950 text-white text-2xl fixed bottom-5 right-5 rounded-full w-12 h-12 drop-shadow-lg z-50 duration-300 hover:bg-green-600">+</button>
    </div>
        <div id="defaultModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                    <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                        <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                Tambah Muzakki
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="defaultModal">
                                X<span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <form action="" method="post">
                            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                <div>
                                    <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kepala Keluarga Muzakki</label>
                                    <input type="text" name="nama" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500" placeholder="Tulis nama.." required>
                                </div>
                                <div>
                                    <label for="jml_tanggungan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah Tanggungan</label>
                                    <input type="number" name="jml_tanggungan" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500" placeholder="Masukkan jumlah tanggungan..." required>
                                </div>
                            </div>
                            <button type="submit" name="tambah" class="text-black text-center border border-black rounded-lg p-2">Edit</button>
                        </form>
                    </div>
                </div>
            </div>

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
      <div class="mx-auto p-10 w-5/6">
        <h1 class="font-bold text-4xl underline text-center">Master Data Muzakki</h1>
        <div>
            <form action="">
                <input type="text" placeholder="Cari..." name="cari" class="my-5 border border-black rounded-lg p-2">
                <button type="submit" class="border border-black rounded-lg bg-zinc-100 p-2">Cari</button>
            </form>
        </div>

        <div class="navigasi my-5">
            <?php if($halamanAktif > 1) : ?>
                <a href="?halaman=<?= $halamanAktif - 1 ?>" class="nav">&laquo;</a>
            <?php endif; ?>

            <?php for($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                <?php if($i == $halamanAktif) : ?>
                <a href="?halaman=<?= $i?>" class="nav text-green-900 font-bold underline"><?= $i;?></a>
                <?php else: ?>
                <a href="?halaman=<?= $i?>" class="nav"><?= $i;?></a>
                <?php endif; ?>
            <?php endfor; ?>

            <?php if($halamanAktif < $jumlahHalaman) : ?>
                    <a href="?halaman=<?= $halamanAktif + 1 ?>" class="nav">&raquo;</a>
            <?php endif; ?>
        </div>

        <div class="mx-auto">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left border border-black">
                    <table class="w-full text-sm text-left border border-black">
                    <thead class="text-xs border border-black">
                        <tr>
                            <th scope="col" class="py-3 text-center">
                                ID
                            </th>
                            <th scope="col" class="py-3 text-center">
                                Nama Kepala Keluarga
                            </th>
                            <th scope="col" class="py-3 text-center">
                                Jumlah Tanggungan
                            </th>
                            <th scope="col" class="py-3 text-center">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1 ?>
                    <?php foreach($sqlmuzakki as $muzakki) : ?>
                        <tr>
                            <th scope="row" class="py-4 font-medium text-black text-center">
                                <?=$muzakki['id_muzakki']?>
                            </th>
                            <td class="py-4 text-center">
                                <?=$muzakki['nama']?>
                            </td>
                            <td class="py-4 text-center">
                                <?=$muzakki['jml_tanggungan']?>
                            </td>
                            <td class="py-4 flex justify-center text-center">
                                <button id="defaultModalButton" data-modal-toggle="edit<?=$i?>" class="font-medium text-green-600 hover:underline mx-2">Edit</button>
                                <div id="edit<?=$i?>" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                                    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                                        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                                            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    Edit Muzakki
                                                </h3>
                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="edit<?=$i?>">
                                                    X<span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <form action="" method="post">
                                                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                                    <div>
                                                        <label for="id">ID :</label>
                                                        <input type="text" name="id" value="<?=$muzakki['id_muzakki']?>" class="hidden">
                                                    </div>
                                                    <div>
                                                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kepala Keluarga Muzakki</label>
                                                        <input type="text" value="<?=$muzakki['nama']?>" name="nama" id="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 " placeholder="Tulis nama.." required>
                                                    </div>
                                                    <div>
                                                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah Tanggungan</label>
                                                        <input type="number" name="jml_tanggungan" value="<?=$muzakki['jml_tanggungan']?>" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5" placeholder="Masukkan jumlah tanggungan..." required>
                                                    </div>
                                                </div>
                                                <button type="submit" name="edit" class="text-black text-center border border-black rounded-lg p-2">Edit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <button id="defaultModalButton" data-modal-toggle="detail<?=$i?>" class="font-medium text-green-600 hover:underline mx-2">Detail</button>
                                <div id="detail<?=$i?>" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                                    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                                        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                                            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    Detail Muzakki
                                                </h3>
                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="detail<?=$i?>">
                                                    X<span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <div>
                                                <h4>Nama Kepala Keluarga : <?=$muzakki['nama']?></h4>
                                                <h4>Jumlah Tanggungan : <?=$muzakki['jml_tanggungan']?></h4>
                                                <p>Perhitungan :</p>
                                                <br>
                                                <p>Beras : <?=$muzakki['jml_tanggungan']?> x 2,5 kg = <?=$muzakki['beras']?> kg</p>
                                                <p>Uang : <?=$muzakki['jml_tanggungan']?> x 37.500 = Rp. <?=$muzakki['uang']?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form action="" method="post">
                                    <input type="text" name="id" value="<?=$muzakki['id_muzakki']?>" class="hidden">
                                    <button type="submit" name="hapus" class="font-medium text-green-600 hover:underline mx-2">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php $i++ ?>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
      </div>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
      <script>
        document.addEventListener("DOMContentLoaded", function(event) {
        document.getElementById('defaultModalButton').click();
        });
      </script>
</body>
</html>