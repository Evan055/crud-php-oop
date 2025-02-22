<?php
include "class/proses_crud.php";

$a= new proses_crud();

$nama   = $_POST['nama'];
$alamat = $_POST['alamat'];
$ttl    = $_POST['ttl'];
$jk     = $_POST['jk'];

$hasil= $a->execute("INSERT INTO tbl_datadiri(nama,ttl,alamat,jk) VALUES('$nama','$ttl','$alamat','$jk')");
//var_dump($hasil); die();
echo "<script>alert('Data Berhasil Ditambahkan.');window.location='index.php';</script>";
?>