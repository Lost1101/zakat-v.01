<?php
include "koneksi.php";
include "functions.php";

    if($_GET['aksi']=="tambahzakat"){
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
    
        if($_GET['aksi']=="editzakat"){
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
    
        if($_GET['aksi']=="hapuszakat"){
            $id_hps_zak = $_GET['id'];
            if(hapuszak($id_hps_zak) > 0 ){
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

            if($_GET['aksi']=="tambahmuz"){
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
            
            if($_GET['aksi']=="editmuz"){
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
            
                if($_GET['aksi']=="hapusmuz"){
                    $id_hps_muz = $_GET['id'];
                    if(hapusmuz($id_hps_muz) > 0 ){
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

                if($_GET['aksi']=="tambahmus"){


                    if(tambahmus($_POST) > 0 ){
                        echo "
                            <script>
                                alert('Data berhasil ditambahkan!');
                                document.location.href = 'mustahik.php';
                            </script>
                        ";
                    }else{
                        echo "
                            <script>
                                alert('Data gagal ditambahkan!');
                                document.location.href = 'mustahik.php';
                            </script>
                        ";
                    }
                  }
                
                if($_GET['aksi']=="editmus"){
                
                
                        if(editmus($_POST) > 0 ){
                            echo "
                                <script>
                                    alert('Data berhasil diubah!');
                                    document.location.href = 'mustahik.php';
                                </script>
                            ";
                        }else{
                            echo "
                                <script>
                                    alert('Data gagal diubah!');
                                    document.location.href = 'mustahik.php';
                                </script>
                            ";
                        }
                    }
                
                    if($_GET['aksi']=="hapusmus"){
                
                        $id_hps_mus = $_GET['id'];
                        if(hapusmus($id_hps_mus) > 0 ){
                            echo "
                                <script>
                                    alert('Data berhasil dihapus!');
                                    document.location.href = 'mustahik.php';
                                </script>
                            ";
                        }else{
                            echo "
                                <script>
                                    alert('Data gagal dihapus!');
                                    document.location.href = 'mustahik.php';
                                </script>
                            ";
                        }
                    }

                    if($_GET['aksi']=="tambahdist"){
                        if(tambahdis($_POST) > 0 ){
                            echo "
                                <script>
                                    alert('Data berhasil ditambahkan!');
                                    document.location.href = 'distribusi.php';
                                </script>
                            ";
                        }else{
                            echo "
                                <script>
                                    alert('Data gagal ditambahkan!');
                                    document.location.href = 'distribusi.php';
                                </script>
                            ";
                            }
                        }
                    
                        if($_GET['aksi']=="editdist"){
                            if(editdis($_POST) > 0 ){
                                echo "
                                    <script>
                                        alert('Data berhasil diubah!');
                                        document.location.href = 'distribusi.php';
                                    </script>
                                ";
                            }else{
                                echo "
                                    <script>
                                        alert('Data gagal diubah!');
                                        document.location.href = 'distribusi.php';
                                    </script>
                                ";
                                }
                            }
                    
                        if($_GET['aksi']=="hapusdist"){
                            $id_hps_dist = $_GET['id'];
                            if(hapusdis($id_hps_dist) > 0 ){
                                echo "
                                    <script>
                                        alert('Data berhasil dihapus!');
                                        document.location.href = 'distribusi.php';
                                    </script>
                                ";
                            }else{
                                echo "
                                    <script>
                                        alert('Data gagal dihapus!');
                                        document.location.href = 'distribusi.php';
                                    </script>
                                ";
                                }
                            }
                
?>