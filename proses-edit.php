<?php
include "class/proses_crud.php";

$a= new proses_crud();

$id   = $_POST['id'];
$nama   = $_POST['nama'];
$alamat = $_POST['alamat'];
$ttl    = $_POST['ttl'];
$jk     = $_POST['jk'];

$hasil= $a->execute("UPDATE tbl_datadiri SET nama='$nama',ttl='$ttl',alamat='$alamat',jk='$jk' WHERE id='$id'");
//var_dump($hasil); die();
echo "<script>alert('Data Berhasil Diperbarui.');window.location='index.php';</script>";
?>