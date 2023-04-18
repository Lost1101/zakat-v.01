<?php
  session_start();
  ob_start();
  include "koneksi.php";
  include "functions.php";

    $jumlahDataPerHalaman = 10;
    $jumlahData = count(query("SELECT * FROM mustahik"));
    $jumlahHalaman = ceil( $jumlahData / $jumlahDataPerHalaman);
    $halamanAktif = (isset($_GET['halaman'])) ? $_GET['halaman'] : 1;
    $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

    $sqlamil = mysqli_query($conn, "SELECT * FROM amil WHERE uname = '$_SESSION[uname]'");
    $amil    =mysqli_fetch_array($sqlamil);

    $bayarzakat = mysqli_query($conn, "SELECT * FROM bayarzakat LIMIT $awalData, $jumlahDataPerHalaman");

  if( isset($_POST['tambah']) ){
    if(tambahzak($_POST) > 0 ){
        echo "
            <script>
                alert('Data berhasil ditambahkan!');
                document.location.href = 'zakat.php';
            </script>
        ";
    }else{
        echo "
            <script>
                alert('Data gagal ditambahkan!');
                document.location.href = 'zakat.php';
            </script>
        ";
        }
    }

    if( isset($_POST['edit']) ){
        if(editzak($_POST) > 0 ){
            echo "
                <script>
                    alert('Data berhasil diubah!');
                    document.location.href = 'zakat.php';
                </script>
            ";
        }else{
            echo "
                <script>
                    alert('Data gagal diubah!');
                    document.location.href = 'zakat.php';
                </script>
            ";
            }
        }

    if( isset($_POST['hapus']) ){
        if(hapuszak($_POST) > 0 ){
            echo "
                <script>
                    alert('Data berhasil dihapus!');
                    document.location.href = 'zakat.php';
                </script>
            ";
        }else{
            echo "
                <script>
                    alert('Data gagal dihapus!');
                    document.location.href = 'zakat.php';
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
          <div id="defaultModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                    <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                        <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                Input Zakat
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="defaultModal">
                                X<span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <form action="" method="post">
                            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                <div>
                                    <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kepala Keluarga Muzakki</label>
                                    <input type="text" name="nama" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5" placeholder="Tulis nama.." required>
                                </div>
                                <div>
                                    <label for="besar" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Besar</label>
                                    <input type="number" name="besar" id="besar" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5" placeholder="Besar yang dibayar..." required>
                                </div>
                                <div>
                                    <div class="flex items-center mb-4">
                                        <input id="uang" type="radio" value="uang" name="jenis" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 focus:ring-green-500 dark:focus:ring-green-600">
                                        <label for="default-radio-1" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Uang</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input checked id="beras" type="radio" value="beras" name="jenis" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 focus:ring-green-500">
                                        <label for="default-radio-2" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Beras</label> 
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="tambah" class="text-black text-center border border-black rounded-lg p-2">Tambah</button>
                        </form>
                    </div>
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
              <button class="border border-white rounded-lg p-2"><a href=""><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a></button>
            </div>
          </div>
      <div class="mx-auto p-10 w-5/6">
        <h1 class="font-bold text-4xl underline text-center">Input Zakat</h1>
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
                                Jenis Bayar
                            </th>
                            <th scope="col" class="py-3 text-center">
                                Besar
                            </th>
                            <th scope="col" class="py-3 text-center">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1 ?>
                    <?php foreach($bayarzakat as $zakat) : ?>
                        <tr>
                            <th scope="row" class="py-4 font-medium text-black text-center">
                                <?=$zakat['id_zakat']?>
                            </th>
                            <td class="py-4 text-center">
                                <?=$zakat['nama_kk']?>
                            </td>
                            <td class="py-4 text-center">
                                <?php if ($zakat['beras'] == 1){
                                    echo "Beras";
                                }else{
                                    echo "Uang";
                                }
                                ?>
                            </td>
                            <td class="py-4 text-center">
                            <?=$zakat['besar_bayar'];?>
                            <?php
                            if ($zakat['beras'] == 1){
                                echo "kg";}
                            ?>
                            </td>
                            <td class="py-4 flex justify-center text-center">
                                <button id="defaultModalButton" data-modal-toggle="edit<?=$i?>" class="font-medium text-green-600 hover:underline mx-2">Edit</button>
                                    <div id="edit<?=$i?>" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                                        <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                                            <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                                                <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                        Input Zakat
                                                    </h3>
                                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="edit<?=$i?>">
                                                        X<span class="sr-only">Close modal</span>
                                                    </button>
                                                </div>
                                                <form action="" method="post">
                                                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                                    <input type="text" name="id" value="<?=$zakat['id_zakat']?>" class="hidden">
                                                        <div>
                                                            <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kepala Keluarga Muzakki</label>
                                                            <input type="text" name="nama" value="<?=$zakat['nama_kk']?>" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5" placeholder="Tulis nama.." required>
                                                        </div>
                                                        <div>
                                                            <label for="besar" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Besar</label>
                                                            <input type="number" name="besar" value="<?=$zakat['besar_bayar'];?>" id="besar" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5" placeholder="Besar yang dibayar..." required>
                                                        </div>
                                                        <div>
                                                            <div class="flex items-center mb-4">
                                                                <input <?php if($zakat['uang'] == 1){
                                                                    echo "checked";
                                                                }else{
                                                                    echo "";
                                                                }?> id="uang" type="radio" value="uang" name="jenis" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 focus:ring-green-500 dark:focus:ring-green-600">
                                                                <label for="default-radio-1" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Uang</label>
                                                            </div>
                                                            <div class="flex items-center">
                                                                <input <?php if($zakat['beras'] == 1){
                                                                    echo "checked";
                                                                }else{
                                                                    echo "";
                                                                }?> id="beras" type="radio" value="beras" name="jenis" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 focus:ring-green-500">
                                                                <label for="default-radio-2" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Beras</label> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="submit" name="edit" class="text-black text-center border border-black rounded-lg p-2">Edit</button>
                                                </form>
                                            </div>
                                        </div>
                                </div>
                                <form action="" method="post">
                                    <input type="text" name="id" value="<?=$zakat['id_zakat']?>" class="hidden">
                                    <button type="submit" name="hapus" class="font-medium text-green-600 hover:underline mx-2">Hapus</button>
                                </form>
                                <button class="font-medium text-green-600 hover:underline mx-2"><a href="./cetakzakat.php?nama=<?=$zakat['nama_kk']?>&amp;besar=<?=$zakat['besar_bayar']?>&amp;beras=<?=$zakat['beras']?>&amp;uang=<?=$zakat['uang']?>">Cetak</a></button>
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
</body>
</html>