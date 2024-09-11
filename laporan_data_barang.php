

<?php

require 'function.php';
require 'cek.php';

header("Content-type:application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=laporan_data_barang.xls");
?>

    <head></head>
    <body>
<h3>LAPORAN DATA BARANG  UNIT IT PT KAI DAOP 5 PURWOKERTO</h3>

<table border="1">
<thead>
    <tr>
        <th>No</th>
        <th>Nama Barang</th>
        <th>Kategori</th>
        <th>Merk</th>
        <th>Stok</th>
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
    </tr>
    <?php } ?>
</table>
</body>


