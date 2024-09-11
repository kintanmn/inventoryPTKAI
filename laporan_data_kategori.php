

<?php

require 'function.php';
require 'cek.php';

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=laporan_data_kategori.xls");
?>


<head></head>
<body>
<h3>LAPORAN DATA KATEGORI BARANG UNIT IT PT KAI DAOP 5 PURWOKERTO</h3>

<table border="1">
<thead>
    <tr>
        <th>No</th>
        <th>Nama Kategori</th>
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
                                           
    </tr>
    <?php } ?>
</table>
</body>

