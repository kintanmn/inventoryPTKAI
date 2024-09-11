<?php
require 'function.php';
require 'cek.php';

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Sistem Inventory Barang</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Logo -->
            <img src="assets\img\kai.png" class="navbar-img ps-3" height="35px">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">Inventory Barang Unit IT PT KAI DAOP 5 Purwokerto</a>
            
            
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="index.php">
                                Data Barang
                            </a>
                            <a class="nav-link" href="kategori.php">
                                 Data Kategori
                            </a>
                            <a class="nav-link" href="merk.php">
                                 Data Merk
                            </a>
                            <a class="nav-link" href="masuk.php">
                                Barang Masuk
                            </a>
                            <a class="nav-link" href="keluar.php">
                                Barang Keluar
                            </a>
                            <a class="nav-link" href="logout.php">
                                Logout
                            </a>
                            
                            
                            
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Data Barang Masuk</h1>
                        <div class="row">
                        <div class="card mb-4">
                            <div class="card-header">
                                <button name="formbarangmasuk" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                                    Tambah Data Barang Masuk
                                </button>
                                <div class="float-right">
                                    <a href="laporan_barang_masuk.php" target="_blank" class="btn btn-success">Export Excel</a>
                                </div>
                            </div>
                            <!-- Tambahkan dropdown untuk memilih bulan -->
                            <!--<div class="card-header">
                                <form method="get" class="form-inline">
                                    <label for="bulan" class="form-label">Tampilkan Berdasarkan Bulan:</label>
                                    <select name="bulan" id="bulan" class="form-control mx-2" >
                                    <option value="" disabled selected>select</option>
                                        <?php
                                        // Mendapatkan daftar bulan dari database
                                        $result = mysqli_query($conn, "SELECT DISTINCT MONTH(tanggal) AS bulan FROM barang_masuk");
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $bulanNum = $row['bulan'];
                                            $bulanName = date("F", mktime(0, 0, 0, $bulanNum, 10)); // Konversi angka bulan menjadi nama bulan
                                            echo "<option value='$bulanNum'>$bulanName</option>";
                                        }
                                        ?>
                                    </select>
                                    </br>
                                    <button name="dataperbulan" type="submit" class="btn btn-primary">Tampilkan</button>
                                </form>
                            </div>-->
                            

                            <div class="card-body">
                                <table id="datatablesSimple">
                                <script>
                                    $(document).ready(function() {
                                        $('#datatablesSimple').DataTable({
                                            "searching": true // Mengaktifkan fitur pencarian
                                        });
                                    });
                                </script>
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah</th>
                                            <th>Keterangan</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>

                                        <?php

                                        if(isset($_GET['dataperbulan'])) {
                                            $selectedMonth = $_GET['bulan'];
                                            $ambildata = mysqli_query($conn, "select * from barang_masuk, barang WHERE barang_masuk.id_barang=barang.id_barang AND MONTH(tanggal) = $selectedMonth");
                                        
                                        } else {
                                            $ambildata = mysqli_query($conn, "select * from barang_masuk, barang WHERE barang_masuk.id_barang=barang.id_barang");
                                        }
                                        $i = 1;
                                        while($data=mysqli_fetch_array($ambildata)){
                                            $idmasuk = $data['id_masuk'];
                                            $tanggal = $data['tanggal'];
                                            $idbarang = $data['id_barang'];
                                            $namabarang = $data['nama_barang'];
                                            $jumlah = $data['jumlah'];
                                            $keterangan = $data['keterangan'];
                                        ?>
                                        <tr>
                                            <td><?=$i++;?></td>
                                            <td><?=$tanggal;?></td>
                                            <td><?=$namabarang;?></td>
                                            <td><?=$jumlah;?></td>
                                            <td><?=$keterangan;?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?=$idmasuk;?>">
                                                    Edit
                                                </button>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?=$idmasuk;?>">
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>
                                       
                                        <!-- Modal Form Edit data barang masuk-->
                                        <div class="modal" id="edit<?=$idmasuk;?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit Data Barang Masuk</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post"> 
                                                            <select name="idbarang" class="form-control">
                                                            <option value="<?=$idbarang;?>" disable selected><?=$namabarang;?></option>
                                                                <?php
                                                                    $datakategori = mysqli_query($conn, "select * from barang");
                                                                    while($fetcharray = mysqli_fetch_array($datakategori)){
                                                                        $namabarang = $fetcharray['nama_barang'];
                                                                        $idbarang = $fetcharray['id_barang'];
                                                                ?>
                                                                <option value="<?=$idbarang;?>"><?=$namabarang;?></option>
                                                                <?php
                                                                    }
                                                                ?>
                                                            </select></br>
                                                            <input type="number" name="jumlah" value="<?=$jumlah;?>" class="form-control" required></br>
                                                            <textarea name="keterangan" class="form-control" placeholder="Keterangan" required ><?=$keterangan;?></textarea></br>
                                                            <input type="hidden" name="idmasuk" value="<?=$idmasuk;?>">
                                                            <button type="submit" class="btn btn-primary" name="updatemasuk">Submit</button>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Modal Form Delete barang -->
                                        <div class="modal" id="delete<?=$idmasuk;?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Delete Data Barang Masuk</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post">
                                                            <input type="hidden" name="idmasuk" value="<?=$idmasuk;?>">
                                                            <input type="hidden" name="jumlah" value="<?=$jumlah;?>">
                                                            <input type="hidden" name="idbarang" value="<?=$idbarang;?>">
                                                            <label>Apakah Anda yakin akan menghapus data ini?</label></br></br>
                                                            <button type="submit" class="btn btn-primary" name="deletemasuk">Submit</button>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        }
                                        ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data Barang Masuk</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <select name="idbarang" class="form-control">
                        <option value="" disabled selected>Nama barang</option>
                            <?php
                                $databarang = mysqli_query($conn, "select * from barang");
                                while($fetcharray = mysqli_fetch_array($databarang)){
                                    $namabarang = $fetcharray['nama_barang'];
                                    $idbarang = $fetcharray['id_barang'];
                            ?>
                            <option value="<?=$idbarang;?>"><?=$namabarang;?></option>
                            <?php
                                }
                            ?>
                        </select></br>
                        <input type="number" name="jumlah" placeholder="jumlah" class="form-control" require></br>
                        <textarea name="keterangan" class="form-control" placeholder="Keterangan" require></textarea></br>
                        <button type="submit" class="btn btn-primary" name="barangmasuk">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
        
                </div>
            </div>
        </div>
    </div>
</html>
