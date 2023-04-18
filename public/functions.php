<?php

    function query($query){
        global $conn;
    
        $result = mysqli_query($conn, $query);
        $rows = [];
        while($row = mysqli_fetch_assoc($result)){
            $rows[] = $row;
        }
        return $rows;
    }

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
        $besar = htmlspecialchars($datzak['besar']);
        if($datzak['jenis'] == 'beras'){
            mysqli_query($conn, "INSERT INTO bayarzakat VALUES ('','$nama', '$besar', '1', '0')");
        }elseif($datzak['jenis'] == 'uang'){
            mysqli_query($conn, "INSERT INTO bayarzakat VALUES ('','$nama', '$besar', '0', '1')");
        }
        return mysqli_affected_rows($conn);
    }

    function editzak($datzak){
        global $conn;
        $id = htmlspecialchars($datzak['id']);
        $nama = htmlspecialchars($datzak['nama']);
        $besar = htmlspecialchars($datzak['besar']);

        if($datzak['jenis'] == 'beras'){
            mysqli_query($conn, "UPDATE bayarzakat SET nama_kk= '$nama', besar_bayar = '$besar', beras = '1', uang = '0' WHERE id_zakat = '$id'");
        }elseif($datzak['jenis'] == 'uang'){
            mysqli_query($conn, "UPDATE bayarzakat SET nama_kk= '$nama', besar_bayar = '$besar', beras = '0', uang = '1' WHERE id_zakat = '$id'");
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
        global $conn;
        $nama = htmlspecialchars($datdis['nama']);
        $kategori = htmlspecialchars($datdis['kategori']);
        $besar = htmlspecialchars($datdis['besar']);
        $jml_tanggungan = htmlspecialchars($datdis['jml_tanggungan']);
        
        mysqli_query($conn, "INSERT INTO distribusi VALUES ('','$nama', '$kategori', '$jml_tanggungan', '$besar', NOW())");

        return mysqli_affected_rows($conn);
    }

    function editdis($datdis){
        global $conn;
        $id = htmlspecialchars($datdis['id']);
        $nama = htmlspecialchars($datdis['nama']);
        $besar = htmlspecialchars($datdis['besar']);
        $kategori = htmlspecialchars($datdis['kategori']);
        $jml_tanggungan = htmlspecialchars($datdis['jml_tanggungan']);

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