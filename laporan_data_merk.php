

<?php

require 'function.php';
require 'cek.php';

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=laporan_data_merk.xls");
?>


<head></head>
<body>
<h3>LAPORAN DATA BARANG KELUAR UNIT IT PT KAI DAOP 5 PURWOKERTO</h3>

<table border="1">
<thead>
    <tr>
        <th>No</th>
        <th>Nama Merk</th>
    </tr>
</thead>
<tbody>
<?php
    $ambildata = mysqli_query($conn, "select * from merk");
    $i = 1;
    while($data=mysqli_fetch_array($ambildata)){
    $idmerk = $data['id_merk'];
    $namamerk = $data['nama_merk'];
?> 

    <tr>
    <td><?=$i++;?></td>
    <td><?=$namamerk;?></td>
                                           
    </tr>
    <?php } ?>
</table>
</body>

