<?php
require 'function.php';
require 'cek.php';
//session_start();
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
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark ">
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
                        <h1 class="mt-4">Data Barang</h1>
                        <div class="row">
                        <div class="card mb-4">
                            <div class="card-header">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                                    Tambah Barang
                                </button>
                                <div class="float-right">
                                    <a href="laporan_data_barang.php" target="_blank" class="btn btn-success">Export Excel</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <?php
                                $ambildatastok = mysqli_query($conn, "select * from barang where stok <1");

                                while($fetch = mysqli_fetch_array($ambildatastok)){
                                    $barang = $fetch['nama_barang'];
                                
                                ?>
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    <strong>Perhatian!</strong> Stok barang <?=$barang;?> telah habis
                                </div>
                                <?php
                                }
                                ?>
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
                                            <th>Nama Barang</th>
                                            <th>Kategori</th>
                                            <th>Merk</th>
                                            <th>Stok</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>

                                           <?php
                                           $ambildata = mysqli_query($conn, "select * from barang join kategori on barang.id_kategori=kategori.id_kategori join merk on barang.id_merk=merk.id_merk");
                                           $i = 1;
                                           while($data=mysqli_fetch_array($ambildata)){
                                            $idbarang = $data['id_barang'];
                                            $namabarang = $data['nama_barang'];
                                            $idkategori = $data['id_kategori'];
                                            $namakategori = $data['nama_kategori'];
                                            $idmerk = $data['id_merk'];
                                            $namamerk = $data['nama_merk'];
                                            $stok = $data['stok'];
                                           ?> 

                                        <tr>
                                            <td><?=$i++;?></td>
                                            <td><?=$namabarang;?></td>
                                            <td><?=$namakategori;?></td>
                                            <td><?=$namamerk;?></td>
                                            <td><?=$stok;?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?=$idbarang;?>">
                                                    Edit
                                                </button>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?=$idbarang;?>">
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Modal Form Edit barang -->
                                        <div class="modal" id="edit<?=$idbarang;?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit Barang</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post">
                                                            <input type="text" name="namabarang" value="<?=$namabarang;?>"  class="form-control" required></br>
                                                            <select name="idkategori" class="form-control">
                                                            <option value="<?=$idkategori;?>" disable selected><?=$namakategori;?></option>
                                                                <?php
                                                                    $datakategori = mysqli_query($conn, "select * from kategori");
                                                                    while($fetcharray = mysqli_fetch_array($datakategori)){
                                                                        $namakategori = $fetcharray['nama_kategori'];
                                                                        $idkategori = $fetcharray['id_kategori'];
                                                                ?>
                                                                <option value="<?=$idkategori;?>"><?=$namakategori;?></option>
                                                                <?php
                                                                    }
                                                                ?>
                                                            </select></br>
                                                            <select name="idmerk" class="form-control">
                                                            <option value="<?=$idmerk;?>" disable selected><?=$namamerk;?></option>
                                                                <?php
                                                                    $datamerk = mysqli_query($conn, "select * from merk");
                                                                    while($fetcharray = mysqli_fetch_array($datamerk)){
                                                                        $namamerk = $fetcharray['nama_merk'];
                                                                        $idmerk = $fetcharray['id_merk'];
                                                                ?>
                                                                <option value="<?=$idmerk;?>"><?=$namamerk;?></option>
                                                                <?php
                                                                    }
                                                                ?>
                                                            </select></br>
                                                            <input type="number" name="stok" value="<?=$stok;?>" class="form-control" disabled></br>
                                                            <input type="hidden" name="idbarang" value="<?=$idbarang;?>">
                                                            <button type="submit" class="btn btn-primary" name="updatebarang">Submit</button>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Modal Form Delete barang -->
                                        <div class="modal" id="delete<?=$idbarang;?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Delete Barang</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post">
                                                            <input type="hidden" name="idbarang" value="<?=$idbarang;?>">
                                                            <label>Apakah Anda yakin akan menghapus barang ini?</label></br></br>
                                                            <button type="submit" class="btn btn-primary" name="deletebarang">Submit</button>
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
                            <input type="button" value="Export Excel" onclick="window.open('laporan_data_barang.php')">
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
    
    

    <!-- Modal Form Tambah barang -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Barang</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <input type="text" name="namabarang" placeholder="Nama Barang" class="form-control" required></br>
                        <select name="idkategori" class="form-control" required>
                        <option value="" disabled selected>Kategori</option>
                            <?php
                                $datakategori = mysqli_query($conn, "select * from kategori");
                                while($fetcharray = mysqli_fetch_array($datakategori)){
                                    $namakategori = $fetcharray['nama_kategori'];
                                    $idkategori = $fetcharray['id_kategori'];
                            ?>
                            <option value="<?=$idkategori;?>"><?=$namakategori;?></option>
                            <?php
                                }
                            ?>
                        </select></br>
                        <select name="idmerk" class="form-control" required>
                        <option value="" disabled selected>Merk</option>
                            <?php
                                $datamerk = mysqli_query($conn, "select * from merk");
                                while($fetcharray = mysqli_fetch_array($datamerk)){
                                    $namamerk = $fetcharray['nama_merk'];
                                    $idmerk = $fetcharray['id_merk'];
                            ?>
                            <option value="<?=$idmerk;?>"><?=$namamerk;?></option>
                            <?php
                                }
                            ?>
                        </select></br>
                        <input type="number" name="stok" placeholder="Stok" class="form-control" required></br>
                        <button type="submit" class="btn btn-primary" name="tambahbarang">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
</html>
