<?php
session_start();

//koneksi database
$conn = mysqli_connect("localhost","root","","stockbarang");

//login
if(isset($_POST['login'])){
    $nama_user = $_POST['nama_user'];
    $password = $_POST['password'];
    
    $query = "SELECT * FROM user WHERE nama_user='$nama_user' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) === 1){
        $row = mysqli_fetch_assoc($result);
        $_SESSION['log'] = true;
        $_SESSION['id_user'] = $row['id_user'];
        $_SESSION['nama_user'] = $row['nama_user'];
        $_SESSION['role'] = $row['role'];

        if($_SESSION['role'] == 'admin'){
            header('location:index_admin.php');
        }
        if($_SESSION['role'] == 'user'){
            header('location:index.php');
        }
    } else {
        header('location:login.php'); // Arahkan kembali pengguna ke halaman login jika login gagal
    }

    
}
  


// CRUD Barang
//tambah barang
if(isset($_POST['tambahbarang'])){
    $idbarang = $_POST['idbarang'];
    $namabarang = $_POST['namabarang'];
    $idkategori = $_POST['idkategori'];
    $idmerk = $_POST['idmerk'];
    $stok = $_POST['stok'];

    $addbarang = mysqli_query($conn, "insert into barang (id_barang, nama_barang, id_kategori, id_merk, stok) values ('$idbarang','$namabarang','$idkategori','$idmerk','$stok')");

    if($addbarang){
        if($_SESSION['role'] == 'admin'){
            header('location:index_admin.php');
        }
        if($_SESSION['role'] == 'user'){
            header('location:index.php');
        }
    } else{
        echo 'gagal';
    }
}

//update data barang
if(isset($_POST['updatebarang'])){
    $idbarang = $_POST['idbarang'];
    $namabarang = $_POST['namabarang'];
    $idkategori = $_POST['idkategori'];
    $idmerk = $_POST['idmerk'];
    $stok = $_POST['stok'];

    $update = mysqli_query($conn, "update barang set nama_barang='$namabarang', id_kategori='$idkategori', id_merk='$idmerk', stok='$stok' where id_barang='$idbarang'");

    if($update){
        if($_SESSION['role'] == 'admin'){
            header('location:index_admin.php');
        }
        if($_SESSION['role'] == 'user'){
            header('location:index.php');
        }
    } else {
        echo 'gagal';
    }
}

//delete data barang
if(isset($_POST['deletebarang'])){
    $idbarang = $_POST['idbarang'];

    $hapus = mysqli_query($conn, "delete from barang where id_barang='$idbarang'");
    if($hapus){
        if($_SESSION['role'] == 'admin'){
            header('location:index_admin.php');
        }
        if($_SESSION['role'] == 'user'){
            header('location:index.php');
        }
    } else {
        echo 'gagal';
    }
}


//CRUD Barang Masuk

//tambah data barang masuk
if(isset($_POST['barangmasuk'])){
    $idbarang = $_POST['idbarang'];
    $jumlah = $_POST['jumlah'];
    $keterangan = $_POST['keterangan'];

    $cekstok = mysqli_query($conn, "select * from barang where id_barang='$idbarang'");
    $ambildata = mysqli_fetch_array($cekstok);
    $stoksebelum = $ambildata['stok'];
    $stoksekarang = $stoksebelum + $jumlah;
    $updatestokmasuk = mysqli_query($conn, "update barang set stok='$stoksekarang' where id_barang='$idbarang'");
    

    $data_in = mysqli_query($conn, "insert into barang_masuk (id_barang, jumlah, keterangan) values ('$idbarang','$jumlah','$keterangan')");
    if($data_in){
        if($_SESSION['role'] == 'admin'){
            header('location:masuk_admin.php');
        }
        if($_SESSION['role'] == 'user'){
            header('location:masuk.php');
        }
    } else{
        echo 'gagal';
    }
}

//update data barang masuk
if(isset($_POST['updatemasuk'])){
    $idmasuk = $_POST['idmasuk'];
    $idbarang = $_POST['idbarang'];
    $jumlah = $_POST['jumlah'];
    $keterangan = $_POST['keterangan'];

    $lihatdatasebelum = mysqli_query($conn, "select * from barang_masuk where id_masuk='$idmasuk'");
    $datasebelum = mysqli_fetch_array($lihatdatasebelum);
    $idbarangsebelum = $datasebelum['id_barang'];
    $jumlahsebelum = $datasebelum['jumlah'];

    if($idbarangsebelum==$idbarang){
        $lihatstok = mysqli_query($conn, "select * from barang where id_barang='$idbarang'");
        $datastok = mysqli_fetch_array($lihatstok);
        $stokbarang = $datastok['stok'];

        $lihatjumlah = mysqli_query($conn, "select * from barang_masuk where id_masuk='$idmasuk'");
        $datajumlah = mysqli_fetch_array($lihatjumlah);
        $jumlahsebelum = $datajumlah['jumlah'];

        if($jumlah>$jumlahsebelum){
            $selisih = $jumlah-$jumlahsebelum;
            $tambahstok = $stokbarang+$selisih;
            $updatestok = mysqli_query($conn, "update barang set stok='$tambahstok' where id_barang='$idbarang'");
            $updatedatamasuk = mysqli_query($conn, "update barang_masuk set jumlah='$jumlah', keterangan='$keterangan' where id_masuk='$idmasuk'");
            if($updatetok&&$updatedatamasuk){
                if($_SESSION['role'] == 'admin'){
                    header('location:masuk_admin.php');
                }
                if($_SESSION['role'] == 'user'){
                    header('location:masuk.php');
                }
            } else {
                echo 'gagal';
            }
        } if($jumlah<$jumlahsebelum){
            $selisih = $jumlahsebelum-$jumlah;
            $kurangistok = $stokbarang-$selisih;
            $updatestok = mysqli_query($conn, "update barang set stok='$kurangistok' where id_barang='$idbarang'");
            $updatedatamasuk = mysqli_query($conn, "update barang_masuk set jumlah='$jumlah', keterangan='$keterangan' where id_masuk='$idmasuk'");
            if($updatetok&&$updatedatamasuk){
                if($_SESSION['role'] == 'admin'){
                    header('location:masuk_admin.php');
                }
                if($_SESSION['role'] == 'user'){
                    header('location:masuk.php');
                }
            } else {
                echo 'gagal';
            }
        } if($jumlah==$jumlahsebelum){
            $updatedatamasuk = mysqli_query($conn, "update barang_masuk set jumlah='$jumlah', keterangan='$keterangan' where id_masuk='$idmasuk'");
            if($updatedatamasuk){
                if($_SESSION['role'] == 'admin'){
                    header('location:masuk_admin.php');
                }
                if($_SESSION['role'] == 'user'){
                    header('location:masuk.php');
                }
            } else {
                echo 'gagal';
            }
        }
    } else {
        $lihatstoksebelum = mysqli_query($conn, "select * from barang where id_barang='$idbarangsebelum'");
        $datastoksebelum = mysqli_fetch_array($lihatstoksebelum);
        $stoksebelum1 = $datastoksebelum['stok'];
        $stoksekarang1 = $stoksebelum1 - $jumlahsebelum;
        $updatestok1 = mysqli_query($conn, "update barang set stok='$stoksekarang1' where id_barang='$idbarangsebelum'");

        $lihatstok = mysqli_query($conn, "select * from barang where id_barang='$idbarang'");
        $ambildata = mysqli_fetch_array($lihatstok);
        $stoksebelum2 = $ambildata['stok'];
        $stoksekarang2 = $stoksebelum2 + $jumlah;
        $updatestok2 = mysqli_query($conn, "update barang set stok='$stoksekarang2' where id_barang='$idbarang'");
        $updatedatamasuk = mysqli_query($conn, "update barang_masuk set id_barang='$idbarang', jumlah='$jumlah', keterangan='$keterangan' where id_masuk='$idmasuk'");
        if($updatedatamasuk){
            if($_SESSION['role'] == 'admin'){
                header('location:masuk_admin.php');
            }
            if($_SESSION['role'] == 'user'){
                header('location:masuk.php');
            }
        } else {
            echo 'gagal';
        }
    }    
}

//delete data barang masuk
if(isset($_POST['deletemasuk'])){
    $idmasuk = $_POST['idmasuk'];
    $idbarang = $_POST['idbarang'];
    $jumlah = $_POST['jumlah'];

    $hapus = mysqli_query($conn, "delete from barang_masuk where id_masuk='$idmasuk'");
    if($hapus){
        $lihatbarang = mysqli_query($conn, "select * from barang where id_barang='$idbarang'");
        $databarang = mysqli_fetch_array($lihatbarang);
        $stoksebelum = $databarang['stok'];
        $stoksesudah = $stoksebelum - $jumlah;
        $updatestok = mysqli_query($conn, "update barang set stok='$stoksesudah' where id_barang='$idbarang'");
        if($_SESSION['role'] == 'admin'){
            header('location:masuk_admin.php');
        }
        if($_SESSION['role'] == 'user'){
            header('location:masuk.php');
        }
    } else {
        echo 'gagal';
    }
}




//CRUD Barang Keluar

//tambah data barang keluar
if(isset($_POST['barangkeluar'])){
    $idbarang = $_POST['idbarang'];
    $noinventaris = $_POST['noinventaris'];
    $keterangan = $_POST['keterangan'];

    $cekstok = mysqli_query($conn, "select * from barang where id_barang='$idbarang'");
    $ambildata = mysqli_fetch_array($cekstok);
    $stoksebelum = $ambildata['stok'];


    if($stoksebelum >= 1){
        $stoksekarang = $stoksebelum - 1 ;
        $updatestokmasuk = mysqli_query($conn, "update barang set stok='$stoksekarang' where id_barang='$idbarang'");

        $data_in = mysqli_query($conn, "insert into barang_keluar (id_barang, no_inventaris, keterangan) values ('$idbarang','$noinventaris','$keterangan')");
        if($data_in){
            if($_SESSION['role'] == 'admin'){
                header('location:keluar_admin.php');
            }
            if($_SESSION['role'] == 'user'){
                header('location:keluar.php');
            }
        } else{
            echo 'gagal';
        }
    } else{
        echo '
        <script>
        alert("Stok saat ini tidak mencukupi");
        window.location.href= "keluar.php";       
        </script>
        ';
    }
}

//update data barang keluar 
if(isset($_POST['updatekeluar'])){
    $idkeluar = $_POST['idkeluar'];
    $idbarang = $_POST['idbarang'];
    $noinventaris = $_POST['noinventaris'];
    $keterangan = $_POST['keterangan'];

    $lihatdatasebelum = mysqli_query($conn, "select * from barang_keluar where id_keluar='$idkeluar'");
    $datasebelum = mysqli_fetch_array($lihatdatasebelum);
    $idbarangsebelum = $datasebelum['id_barang'];
    $noinventarissebelum = $datasebelum['noinventaris'];

    if($idbarangsebelum==$idbarang){
        $lihatstok = mysqli_query($conn, "select * from barang where id_barang='$idbarang'");
        $datastok = mysqli_fetch_array($lihatstok);
        $stokbarang = $datastok['stok'];
        $updatedatakeluar = mysqli_query($conn, "update barang_keluar set no_inventaris='$noinventaris', keterangan='$keterangan' where id_keluar='$idkeluar'");
        if($updatedatakeluar){
            if($_SESSION['role'] == 'admin'){
                header('location:keluar_admin.php');
            }
            if($_SESSION['role'] == 'user'){
                header('location:keluar.php');
            }
        } else {
            echo 'gagal';
        } 
    }
    else {
        $lihatstoksebelum = mysqli_query($conn, "select * from barang where id_barang='$idbarangsebelum'");
        $datastoksebelum = mysqli_fetch_array($lihatstoksebelum);
        $stoksebelum1 = $datastoksebelum['stok'];
        $stoksekarang1 = $stoksebelum1 + 1;
        
        $lihatstok = mysqli_query($conn, "select * from barang where id_barang='$idbarang'");
        $ambildata = mysqli_fetch_array($lihatstok);
        $stoksebelum2 = $ambildata['stok'];
        $stoksekarang2 = $stoksebelum2 - 1;
        
        if($stoksekarang2>=0){
            $updatestok1 = mysqli_query($conn, "update barang set stok='$stoksekarang1' where id_barang='$idbarangsebelum'");
            $updatestok2 = mysqli_query($conn, "update barang set stok='$stoksekarang2' where id_barang='$idbarang'");
            $updatedatakeluar = mysqli_query($conn, "update barang_keluar set id_barang='$idbarang', no_inventaris='$noinventaris', keterangan='$keterangan' where id_keluar='$idkeluar'");    
            if($_SESSION['role'] == 'admin'){
                header('location:keluar_admin.php');
            }
            if($_SESSION['role'] == 'user'){
                header('location:keluar.php');
            }
        } else{
            echo '
            <script>
            alert("Stok saat ini tidak mencukupi");
            window.location.href= "keluar.php";       
            </script>
            ';
        }
            

    }
  
}

//delete data barang keluar
if(isset($_POST['deletekeluar'])){
    $idkeluar = $_POST['idkeluar'];
    $idbarang = $_POST['idbarang'];
    $jumlah = $_POST['jumlah'];

    $hapus = mysqli_query($conn, "delete from barang_keluar where id_keluar='$idkeluar'");
    if($hapus){
        $lihatbarang = mysqli_query($conn, "select * from barang where id_barang='$idbarang'");
        $databarang = mysqli_fetch_array($lihatbarang);
        $stoksebelum = $databarang['stok'];
        $stoksesudah = $stoksebelum + $jumlah;
        $updatestok = mysqli_query($conn, "update barang set stok='$stoksesudah' where id_barang='$idbarang'");
        if($_SESSION['role'] == 'admin'){
            header('location:keluar_admin.php');
        }
        if($_SESSION['role'] == 'user'){
            header('location:keluar.php');
        }
    } else {
        echo 'gagal';
    }
}

//CRUD Kategori

//tambah kategori
if(isset($_POST['tambahkategori'])){
    $namakategori = $_POST['namakategori'];

    $addkategori = mysqli_query($conn, "insert into kategori (nama_kategori) values ('$namakategori')");

    if($addkategori){
        if($_SESSION['role'] == 'admin'){
            header('location:kategori_admin.php');
        }
        if($_SESSION['role'] == 'user'){
            header('location:kategori.php');
        }
    } else{
        echo 'gagal';
    }
}

//update data kategori
if(isset($_POST['updatekategori'])){
    $idkategori = $_POST['idkategori'];
    $namakategori = $_POST['namakategori'];

    $update = mysqli_query($conn, "update kategori set nama_kategori='$namakategori' where id_kategori='$idkategori'");

    if($update){
        if($_SESSION['role'] == 'admin'){
            header('location:kategori_admin.php');
        }
        if($_SESSION['role'] == 'user'){
            header('location:kategori.php');
        }
    } else {
        echo 'gagal';
    }
}

//delete data kategori
if(isset($_POST['deletekategori'])){
    $idkategori = $_POST['idkategori'];

    $hapus = mysqli_query($conn, "delete from kategori where id_kategori='$idkategori'");
    if($hapus){
        if($_SESSION['role'] == 'admin'){
            header('location:kategori_admin.php');
        }
        if($_SESSION['role'] == 'user'){
            header('location:kategori.php');
        }
    } else {
        echo 'gagal';
    }
}


//CRUD Merk

//tambah merk
if(isset($_POST['tambahmerk'])){
    $idmerk = $_POST['idmerk'];
    $namamerk = $_POST['namamerk'];

    $addmerk = mysqli_query($conn, "insert into merk (nama_merk) values ('$namamerk')");

    if($addmerk){
        if($_SESSION['role'] == 'admin'){
            header('location:merk_admin.php');
        }
        if($_SESSION['role'] == 'user'){
            header('location:merk.php');
        }
    } else{
        echo 'gagal';
    }
}

//update data merk
if(isset($_POST['updatemerk'])){
    $idmerk = $_POST['idmerk'];
    $namamerk = $_POST['namamerk'];

    $update = mysqli_query($conn, "update merk set nama_merk='$namamerk' where id_merk='$idmerk'");

    if($update){
        if($_SESSION['role'] == 'admin'){
            header('location:merk_admin.php');
        }
        if($_SESSION['role'] == 'user'){
            header('location:merk.php');
        }
    } else {
        echo 'gagal';
    }
}

//delete data merk
if(isset($_POST['deletemerk'])){
    $idmerk = $_POST['idmerk'];

    $hapus = mysqli_query($conn, "delete from merk where id_merk='$idmerk'");
    if($hapus){
        if($_SESSION['role'] == 'admin'){
            header('location:merk_admin.php');
        }
        if($_SESSION['role'] == 'user'){
            header('location:merk.php');
        }
    } else {
        echo 'gagal';
    }
}


?>


