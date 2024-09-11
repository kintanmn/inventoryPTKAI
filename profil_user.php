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
        <link href="css/styles.css" rel="stylesheet" />

        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark ">
            <!-- Logo -->
            <img src="assets\img\kai.png" class="navbar-img ps-3" height="35px" >
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
                        <h1 class="mt-4">Profil User</h1>
                        <div class="row">
                        <div class="card mb-4">
                            <div class="card-header">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                                Tambah User
                            </button>
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
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Password</th>
                                            <th>Role</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>

                                           <?php
                                           $ambildata = mysqli_query($conn, "select * from user");
                                           $i = 1;
                                           while($data=mysqli_fetch_array($ambildata)){
                                            $iduser = $data['id_user'];
                                            $username = $data['nama_user'];
                                            $email = $data['email'];
                                            $password = $data['password'];
                                            $role = $data['role'];
                                           ?> 

                                        <tr>
                                            <td><?=$i++;?></td>
                                            <td><?=$username;?></td>
                                            <td><?=$email;?></td>
                                            <td><?=$password;?></td>
                                            <td><?=$role;?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?=$iduser;?>">
                                                    Edit
                                                </button>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?=$iduser;?>">
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Modal Form Edit User -->
                                        <div class="modal" id="edit<?=$iduser;?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit User</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post">
                                                            <input type="text" name="username" value="<?=$username;?>"  class="form-control" required></br>
                                                            <input type="text" name="email" value="<?=$email;?>"  class="form-control" required></br>
                                                            <input type="text" name="password" value="<?=$password;?>"  class="form-control" required></br>
                                                            <select name="role" class="form-control">
                                                            <option value="<?=$role;?>" disable selected><?=$role;?></option>
                                                            <option value="admin">admin</option>
                                                            <option value="user">user</option>
                                                            </select></br>
                                                            <input type="hidden" name="iduser" value="<?=$iduser;?>">
                                                            <button type="submit" class="btn btn-primary" name="updateuser">Submit</button>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Modal Form Delete barang -->
                                        <div class="modal" id="delete<?=$iduser;?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Delete User</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post">
                                                            <input type="hidden" name="iduser" value="<?=$iduser;?>">
                                                            <label>Apakah Anda yakin akan menghapus User ini?</label></br></br>
                                                            <button type="submit" class="btn btn-primary" name="deleteuser">Submit</button>
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
    
    

    <!-- Modal Form Tambah user -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah User</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <input type="text" name="username" placeholder="Username" class="form-control" required></br>
                        <input type="text" name="email" placeholder="Email" class="form-control" required></br>
                        <input type="text" name="password" placeholder="Password" class="form-control" required></br>
                        <select name="role" class="form-control" required>
                            <option value="" disable selected>Role</option>
                            <option value="admin">admin</option>
                            <option value="user">user</option>
                        </select></br>
                        <button type="submit" class="btn btn-primary" name="tambahuser">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
</html>
