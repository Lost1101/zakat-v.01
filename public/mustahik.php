<?php
  session_start();
  ob_start();
  include "koneksi.php";
  $nm_db = 'mustahik';
  include "limit.php";
  $master = new sql($connection);

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
                                Tambah Mustahik
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="defaultModal">
                                X<span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <form action="aksi.php?aksi=tambahmus" method="post">
                            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                <div>
                                    <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kepala Keluarga Mustahik</label>
                                    <input type="text" name="nama" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5" placeholder="Tulis nama.." required>
                                </div>
                                <div>
                                    <label for="jml_tanggungan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah Tanggungan</label>
                                    <input type="number" name="jml_tanggungan" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 " placeholder="Masukkan jumlah tanggungan..." required>
                                </div>
                                <div>
                                    <label for="kategori" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori Mustahik</label>
                                    <select id="kategori" name="kategori" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 ">
                                        <option selected="" value="Fakir">Fakir</option>
                                        <option value="Miskin">Miskin</option>
                                        <option value="Amil">Amil</option>
                                        <option value="Muallaf">Muallaf</option>
                                        <option value="Riqab">Riqab</option>
                                        <option value="Gharim">Gharim</option>
                                        <option value="Fi Sabilillah">Fi Sabilillah</option>
                                        <option value="Ibnu Sabil">Ibnu Sabil</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" name="tambah" class="text-black text-center border border-black rounded-lg p-2">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>

    <div class="flex">
    <?php
      include "header.php";
      ?>
      <div class="mx-auto p-10 w-5/6">
        <h1 class="font-bold text-4xl underline text-center">Master Data Mustahik</h1>
        <div>
            <form action="">
                <input type="text" placeholder="Cari..." name="cari" class="my-5 border border-black rounded-lg p-2">
                <button type="submit" class="border border-black rounded-lg bg-zinc-100 p-2">Cari</button>
            </form>
        </div>

        <?php include "halaman.php";?>

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
                                Kategori
                            </th>
                            <th scope="col" class="py-3 text-center">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1;
                    $sqlmustahik = $master->data_mustahik();
                    ?>
                    <?php foreach($sqlmustahik as $mustahik) : ?>
                        <tr>
                            <th scope="row" class="py-4 font-medium text-black text-center">
                                <?=$mustahik['id_mustahik']?>
                            </th>
                            <td class="py-4 text-center">
                                <?=$mustahik['nama']?>
                            </td>
                            <td class="py-4 text-center">
                                <?=$mustahik['jml_tanggungan']?>
                            </td>
                            <td class="py-4 text-center">
                                <?=$mustahik['kategori']?>
                            </td>
                            <td class="py-4 flex justify-center text-center">
                                <button id="defaultModalButton" data-modal-toggle="edit<?=$i?>" class="font-medium text-green-600 hover:underline mx-2">Edit</button>
                                <div id="edit<?=$i?>" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                                    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                                        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                                            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    Edit Mustahik
                                                </h3>
                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="edit<?=$i?>">
                                                    X<span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <form action="aksi.php?aksi=editmus" method="post">
                                                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                                    <input type="text" name="id" value="<?=$mustahik['id_mustahik']?>" class="hidden">
                                                    <div>
                                                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kepala Keluarga Mustahik</label>
                                                        <input type="text" value="<?=$mustahik['nama']?>" name="nama" id="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500" placeholder="Tulis nama.." required>
                                                    </div>
                                                    <div>
                                                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah Tanggungan</label>
                                                        <input type="number" name="jml_tanggungan" value="<?=$mustahik['jml_tanggungan']?>" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500" placeholder="Masukkan jumlah tanggungan..." required>
                                                    </div>
                                                    <div>
                                                        <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori Mustahik</label>
                                                        <select name="kategori" id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500">
                                                            <option selected="<?=$mustahik['kategori']?>" value="<?=$mustahik['kategori']?>"><?=$mustahik['kategori']?></option>
                                                            <option value="Fakir">Fakir</option>
                                                            <option value="Miskin">Miskin</option>
                                                            <option value="Amil">Amil</option>
                                                            <option value="Muallaf">Mu'allaf</option>
                                                            <option value="Riqab">Riqab</option>
                                                            <option value="Gharim">Gharim</option>
                                                            <option value="Fi Sabilillah">Fi Sabilillah</option>
                                                            <option value="Ibnu Sabil">Ibnu Sabil</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <button type="submit" name="edit" class="text-black text-center border border-black rounded-lg p-2">Edit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <form action="aksi.php?aksi=hapusmus" method="post">
                                    <input type="text" name="id" value="<?=$mustahik['id_mustahik']?>" class="hidden">
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