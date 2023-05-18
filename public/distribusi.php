<?php
  session_start();
  ob_start();
  include "koneksi.php";
  $nm_db = 'distribusi';
  include "limit.php";
  $master = new sql($connection);

  $sqldistribusi = $master->data_distribusi();
  if(isset($_POST['search'])){
    $sqldistribusi = search($_POST['keyword']);
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
    <title>MyZakat | Solusi Zakat Digital</title>
</head>
<body class="font-worksans">
    <div>
        <div>
            <button id="defaultModalButton" data-modal-toggle="defaultModal" class="bg-green-950 text-white text-2xl fixed bottom-5 right-5 rounded-full w-12 h-12 drop-shadow-lg z-50 duration-300 hover:bg-green-600">+</button>
        </div>
          <div id="defaultModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                    <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                        <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                Distribusi
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="defaultModal">
                                X<span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <form action="aksi.php?aksi=tambahdist" method="post">
                            <div class="gap-4 mb-4 sm:grid-cols-2">
                                <div>
                                    <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kepala Keluarga Mustahik</label>
                                    <select id="nama" name="nama" class="nama bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block p-2.5 " style="width: 100%;">
                                    <option selected="" value="">-Pilih Nama-</option>
                                    <?php
                                        $sqlmustahik = $master->all_mustahik();
                                        foreach($sqlmustahik as $mustahik) :
                                    ?>
                                        <option value="<?=$mustahik['nama']?>"><?=$mustahik['nama']?> (<?=$mustahik['jml_tanggungan']?>)</option>
                                    <?php endforeach;?>
                                    </select>
                                </div>
                                    <div class="flex justify-between mt-5">
                                        <?php
                                            $fetch_beras = $master->besarbayar('beras')->fetch_array();
                                            $fetch_uang = $master->besarbayar('uang')->fetch_array();
                                            $fetch_mustahik = $master->all_org_mustahik()->fetch_array();
                            
                                                $konversi = $fetch_uang['SUM(besar_bayar)'] / 37500 * 2.5;
                                                $total = $fetch_beras['SUM(besar_bayar)'] + $konversi;
                                                $pembagian = $total / $fetch_mustahik['SUM(jml_tanggungan)'];
                                        ?>
                                            <label for="jml_tanggungan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah Tanggungan</label>
                                            <input type="number" name="jml_tanggungan" id="jml_tanggungan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 " placeholder="Banyak orang yang menerima" required>
                                            <span>x <?=number_format((float)$pembagian, 2, '.', '')?> Kg (/mustahik)</span>
                                    </div>
                                    <div>
                                        <h4>Total didapat : <span class="font-bold" id="calculation"></span></h4>
                                    </div>
                                </div>
                            <button type="submit" name="tambah" class="text-black text-center border border-black rounded-lg p-2">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
    </div>
    <div class="flex">
    <?php
      include "header.php";
      ?>
      <div class="mx-auto p-10 w-5/6">
        <h1 class="font-bold text-4xl underline text-center">Distribusi</h1>
        <div>
            <form action="" method="post">
                <input type="text" placeholder="Cari..." name="keyword" class="my-5 border border-black rounded-lg p-2">
                <button type="submit" name="search" class="border border-black rounded-lg bg-zinc-100 p-2">Cari</button>
            </form>
        </div>

        <?php include "halaman.php"; ?>

        <div class="mx-auto">    
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left border border-black">
                    <table class="w-full text-sm text-left border border-black">
                    <thead class="text-xs border border-black">
                        <tr>
                            <th scope="col" class="py-3 text-center">
                                ID Terima
                            </th>
                            <th scope="col" class="py-3 text-center">
                                Nama
                            </th>
                            <th scope="col" class="py-3 text-center">
                                Kategori
                            </th>
                            <th scope="col" class="py-3 text-center">
                                Besar Didapat
                            </th>
                            <th scope="col" class="py-3 text-center">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1;
                    ?>
                    <?php foreach($sqldistribusi as $distribusi) : ?>
                        <tr>
                            <th scope="row" class="py-4 font-medium text-black text-center">
                                <?=$distribusi['id_penerimaan']?>
                            </th>
                            <td class="py-4 text-center">
                                <?=$distribusi['nama']?>
                            </td>
                            <td class="py-4 text-center">
                                <?=$distribusi['kategori']?>
                            </td>
                            <td class="py-4 text-center">
                                <?=number_format((float)$distribusi['besar'], 2, '.', '')?> kg
                            </td>
                            <td class="py-4 flex justify-center text-center">
                                <button id="defaultModalButton" data-modal-toggle="edit<?=$i?>" class="font-medium text-green-600 hover:underline mx-2">Edit</button>
                                <div id="edit<?=$i?>" tabindex="-1" aria-hidden="true" class="justify-start text-left hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
                                    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                                        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                                            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    Distribusi
                                                </h3>
                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex" data-modal-toggle="edit<?=$i?>">
                                                    X<span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <form action="aksi.php?aksi=editdist" method="post">
                                                <div class="gap-4 mb-4 sm:grid-cols-2">
                                                    <div>
                                                    <input type="text" name="before" value="<?=$distribusi['nama']?>" class="hidden">
                                                        <input type="text" name="id" value="<?=$distribusi['id_penerimaan']?>" class="hidden">
                                                        <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kepala Keluarga Mustahik</label>
                                                        <select id="nama2" name="nama2" class="nama2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block p-2.5 " style="width: 100%;">
                                                        <option selected="<?=$distribusi['nama']?>" value="<?=$distribusi['nama']?>"><?=$distribusi['nama']?></option>
                                                        <?php
                                                            $sqlmustahik = $master->all_mustahik();
                                                            foreach($sqlmustahik as $mustahik) :
                                                        ?>
                                                            <option value="<?=$mustahik['nama']?>"><?=$mustahik['nama']?> (<?=$mustahik['jml_tanggungan']?>)</option>
                                                        <?php endforeach;?>
                                                        </select>
                                                    </div>
                                                    <div class="flex justify-between mt-5">
                                                        <?php
                                                            $fetch_beras = $master->besarbayar('beras')->fetch_array();
                                                            $fetch_uang = $master->besarbayar('uang')->fetch_array();
                                                            $fetch_mustahik = $master->all_org_mustahik()->fetch_array();
                                            
                                                                $konversi = $fetch_uang['SUM(besar_bayar)'] / 37500 * 2.5;
                                                                $total = $fetch_beras['SUM(besar_bayar)'] + $konversi;
                                                                $pembagian = $total / $fetch_mustahik['SUM(jml_tanggungan)'];
                                                        ?>
                                                            <label for="jml_tanggungan2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah Tanggungan</label>
                                                            <input type="number" name="jml_tanggungan2" value="<?=$distribusi['jml_tanggungan'];?>" id="jml_tanggungan2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 " placeholder="Banyak tanggungan" required>
                                                            <span>x <?=number_format((float)$pembagian, 2, '.', '')?> Kg (/mustahik)</span>
                                                    </div>
                                                    <div>
                                                        <h4>Total didapat : <span class="font-bold" id="calculation2"></span></h4>
                                                    </div>
                                                </div>
                                                <button type="submit" name="edit" class="text-black text-center border border-black rounded-lg p-2">Edit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <form action="aksi.php?aksi=hapusdist" method="post">
                                    <input type="text" name="id" value="<?=$distribusi['id_penerimaan']?>" class="hidden">
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

      <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
      <script>
        document.addEventListener("DOMContentLoaded", function(event) {
        document.getElementById('defaultModalButton').click();
        });

        $(document).ready(function() {
            $('#nama').select2();
        });
        
        $(".nama").select2({
        width: 'resolve'
        });

        $(document).ready(function() {
            $('#nama2').select2();
        });
        
        $(".nama2").select2({
        width: 'resolve'
        });

        function calculate_cost() {
        let count = parseInt(document.getElementById('jml_tanggungan').value);
        if (count > 0) {
            size = <?=number_format((float)$pembagian, 2, '.', '')?>;
            cost = count * size;
            document.getElementById('calculation').innerHTML = cost+' kg';
            }
        }

        document.getElementById('jml_tanggungan').onchange = function() { 
        calculate_cost(); 
        }

        function calculate_cost2() {
        let count = parseInt(document.getElementById('jml_tanggungan2').value);
        if (count > 0) {
            size = <?=number_format((float)$pembagian, 2, '.', '')?>;
            cost = count * size;
            document.getElementById('calculation2').innerHTML = cost+' kg';
            }
        }

        document.getElementById('jml_tanggungan2').onchange = function() { 
        calculate_cost2(); 
        }
      </script>
</body>
</html>

<?php 
    function search($keyword){
        global $conn;

        $query = "SELECT * FROM distribusi WHERE nama LIKE '%$keyword%'";
        return mysqli_query($conn, $query);
    }
?>