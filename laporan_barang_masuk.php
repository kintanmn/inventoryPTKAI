

<?php

require 'function.php';
require 'cek.php';



header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=laporan_barang_masuk.xls");
?>

<head></head>
<body>
<h3>LAPORAN DATA BARANG MASUK UNIT IT PT KAI DAOP 5 PURWOKERTO</h3>

<table border="1">

    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Keterangan</th>
        </tr>
    </thead>   
    <tbody>
    <?php
        $ambildata = mysqli_query($conn, "select * from barang_masuk, barang WHERE barang_masuk.id_barang=barang.id_barang");
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
    <?php } ?>
</table>
</body>


