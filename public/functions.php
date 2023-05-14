<?php

    function tambahmus($datmus){
        global $conn;
        $nama = htmlspecialchars($datmus['nama']);
        $kategori = htmlspecialchars($datmus['kategori']);
        $jml_tanggungan = htmlspecialchars($datmus['jml_tanggungan']);

        mysqli_query($conn, "INSERT INTO mustahik VALUES ('','$nama', '$kategori', '$jml_tanggungan')");
        return mysqli_affected_rows($conn);
    }

    function editmus($datmus){
        global $conn;
        $id = htmlspecialchars($datmus['id']);
        $nama = htmlspecialchars($datmus['nama']);
        $kategori = htmlspecialchars($datmus['kategori']);
        $jml_tanggungan = htmlspecialchars($datmus['jml_tanggungan']);

        mysqli_query($conn, "UPDATE mustahik SET nama= '$nama', kategori = '$kategori', jml_tanggungan = '$jml_tanggungan' WHERE id_mustahik = '$id'");
        return mysqli_affected_rows($conn);
    }

    function hapusmus($idmus){
        global $conn;
        $id = htmlspecialchars($idmus['id']);
        mysqli_query($conn, "DELETE FROM mustahik WHERE id_mustahik = $id");
        return mysqli_affected_rows($conn);
    }

    function tambahmuz($datmuz){
        global $conn;
        $nama = htmlspecialchars($datmuz['nama']);
        $jml_tanggungan = htmlspecialchars($datmuz['jml_tanggungan']);
        $beras = $jml_tanggungan * 2.5;
        $uang = $jml_tanggungan * 37500;

        mysqli_query($conn, "INSERT INTO muzakki VALUES ('','$nama', '$jml_tanggungan', '$beras', '$uang')");
        return mysqli_affected_rows($conn);
    }

    function editmuz($datmuz){
        global $conn;
        $id = htmlspecialchars($datmuz['id']);
        $nama = htmlspecialchars($datmuz['nama']);
        $jml_tanggungan = htmlspecialchars($datmuz['jml_tanggungan']);
        $beras = $jml_tanggungan * 2.5;
        $uang = $jml_tanggungan * 37500;

        mysqli_query($conn, "UPDATE muzakki SET nama= '$nama', jml_tanggungan = '$jml_tanggungan', beras = '$beras', uang = '$uang' WHERE id_muzakki = '$id'");
        return mysqli_affected_rows($conn);
    }

    function hapusmuz($idmuz){
        global $conn;
        $id = htmlspecialchars($idmuz['id']);
        mysqli_query($conn, "DELETE FROM muzakki WHERE id_muzakki = $id");
        return mysqli_affected_rows($conn);
    }

    function tambahzak($datzak){
        global $conn;
        $nama = htmlspecialchars($datzak['nama']);
        $tanggungan = htmlspecialchars($datzak['jml_tanggungan']);
        if($datzak['jenis'] == 'beras'){
            $besar = $tanggungan * 2.5;
            mysqli_query($conn, "INSERT INTO bayarzakat VALUES ('','$nama', '$tanggungan', '$besar', '1', '0')");
        }elseif($datzak['jenis'] == 'uang'){
            $besar = $tanggungan * 37500;
            mysqli_query($conn, "INSERT INTO bayarzakat VALUES ('','$nama', '$tanggungan', '$besar', '0', '1')");
        }
        return mysqli_affected_rows($conn);
    }

    function editzak($datzak){
        global $conn;
        $id = htmlspecialchars($datzak['id']);
        $nama = htmlspecialchars($datzak['nama2']);
        $tanggungan = htmlspecialchars($datzak['jml_tanggungan']);
        if($datzak['jenis'] == 'beras'){
            $besar = $tanggungan * 2.5;
            mysqli_query($conn, "UPDATE bayarzakat SET nama_kk= '$nama', jml_tanggungan= '$tanggungan', besar_bayar = '$besar', beras = '1', uang = '0' WHERE id_zakat = '$id'");
        }elseif($datzak['jenis'] == 'uang'){
            $besar = $tanggungan * 37500;
            mysqli_query($conn, "UPDATE bayarzakat SET nama_kk= '$nama', jml_tanggungan= '$tanggungan', besar_bayar = '$besar', beras = '0', uang = '1' WHERE id_zakat = '$id'");
        }

        return mysqli_affected_rows($conn);
    }

    function hapuszak($idzak){
        global $conn;
        $id = htmlspecialchars($idzak['id']);
        mysqli_query($conn, "DELETE FROM bayarzakat WHERE id_zakat = $id");
        return mysqli_affected_rows($conn);
    }

    function tambahdis($datdis){
        global $connection;
        $master = new sql($connection);
        $fetch_beras = $master->besarbayar('beras')->fetch_array();
        $fetch_uang = $master->besarbayar('uang')->fetch_array();
        $fetch_mustahik = $master->all_org_mustahik()->fetch_array();
        $konversi = $fetch_uang['SUM(besar_bayar)'] / 37500 * 2.5;
        $total = $fetch_beras['SUM(besar_bayar)'] + $konversi;
        $pembagian = $total / $fetch_mustahik['SUM(jml_tanggungan)'];

        global $conn;
        $nama = htmlspecialchars($datdis['nama']);
        $sqlmus = mysqli_query($conn, "SELECT * FROM mustahik WHERE nama = '$nama'");
        $mustahik    =mysqli_fetch_array($sqlmus);
        $kategori = htmlspecialchars($mustahik['kategori']);
        $jml_tanggungan = htmlspecialchars($datdis['jml_tanggungan']);
        $besar = $jml_tanggungan * $pembagian;
        
        mysqli_query($conn, "INSERT INTO distribusi VALUES ('','$nama', '$kategori', '$jml_tanggungan', '$besar', NOW())");

        return mysqli_affected_rows($conn);
    }

    function editdis($datdis){
        global $connection;
        $master = new sql($connection);
        $fetch_beras = $master->besarbayar('beras')->fetch_array();
        $fetch_uang = $master->besarbayar('uang')->fetch_array();
        $fetch_mustahik = $master->all_org_mustahik()->fetch_array();
        $konversi = $fetch_uang['SUM(besar_bayar)'] / 37500 * 2.5;
        $total = $fetch_beras['SUM(besar_bayar)'] + $konversi;
        $pembagian = $total / $fetch_mustahik['SUM(jml_tanggungan)'];

        global $conn;
        $id = htmlspecialchars($datdis['id']);
        $nama = htmlspecialchars($datdis['nama']);
        $sqlmus = mysqli_query($conn, "SELECT * FROM mustahik WHERE nama = '$nama'");
        $mustahik    =mysqli_fetch_array($sqlmus);
        $kategori = htmlspecialchars($mustahik['kategori']);
        $jml_tanggungan = htmlspecialchars($datdis['jml_tanggungan']);
        $besar = $jml_tanggungan * $pembagian;

        mysqli_query($conn, "UPDATE distribusi SET nama= '$nama', kategori = '$kategori', jml_tanggungan = '$jml_tanggungan', besar = '$besar', waktu = NOW()  WHERE id_penerimaan = '$id'");

        return mysqli_affected_rows($conn);
    }

    function hapusdis($iddis){
        global $conn;
        $id = htmlspecialchars($iddis['id']);
        mysqli_query($conn, "DELETE FROM distribusi WHERE id_penerimaan = $id");
        return mysqli_affected_rows($conn);
    }
?>