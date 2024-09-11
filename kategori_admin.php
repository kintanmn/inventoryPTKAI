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
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Logo -->
            <img src="assets\img\kai.png" class="navbar-img ps-3" height="35px">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index_admin.php">Inventory Barang Unit IT PT KAI DAOP 5 Purwokerto</a>
            
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                        <a class="nav-link" href="index_admin.php">
                                Data Barang
                            </a>
                            <a class="nav-link" href="kategori_admin.php">
                                Data Kategori
                            </a>
                            <a class="nav-link" href="merk_admin.php">
                                Data Merk
                            </a>
                            <a class="nav-link" href="masuk_admin.php">
                                Barang Masuk
                            </a>
                            <a class="nav-link" href="keluar_admin.php">
                                Barang Keluar
                            </a>
                            <a class="nav-link" href="profil_user.php">
                                Profil User
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
                        <h1 class="mt-4">Data Kategori</h1>
                        <div class="row">
                        <div class="card mb-4">
                            <div class="card-header">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                                    Tambah Kategori
                                </button>
                                <div class="float-right">
                                    <a href="laporan_data_kategori.php" target="_blank" class="btn btn-success">Export Excel</a>
                                </div>
                            </div>
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
                                            <th>Nama Kategori</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>

                                           <?php
                                           $ambildata = mysqli_query($conn, "select * from kategori");
                                           $i = 1;
                                           while($data=mysqli_fetch_array($ambildata)){
                                            $idkategori = $data['id_kategori'];
                                            $namakategori = $data['nama_kategori'];
                                           ?> 

                                        <tr>
                                            <td><?=$i++;?></td>
                                            <td><?=$namakategori;?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?=$idkategori;?>">
                                                    Edit
                                                </button>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?=$idkategori;?>">
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Modal Form Edit Kategori -->
                                        <div class="modal" id="edit<?=$idkategori;?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit Kategori</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post">
                                                            <input type="text" name="namakategori" value="<?=$namakategori;?>"  class="form-control" required></br>
                                                            <input type="hidden" name="idkategori" value="<?=$idkategori;?>">
                                                            <button type="submit" class="btn btn-primary" name="updatekategori">Submit</button>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Modal Form Delete Kategori -->
                                        <div class="modal" id="delete<?=$idkategori;?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Delete Kategori</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post">
                                                            <input type="hidden" name="idkategori" value="<?=$idkategori;?>">
                                                            <label>Apakah Anda yakin akan menghapus kategori ini?</label></br></br>
                                                            <button type="submit" class="btn btn-primary" name="deletekategori">Submit</button>
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
    
    

    <!-- Modal Form Tambah Kategori -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Kategori</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <input type="text" name="namakategori" placeholder="Nama Kategori" class="form-control" required></br>
                        <button type="submit" class="btn btn-primary" name="tambahkategori">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
</html>
