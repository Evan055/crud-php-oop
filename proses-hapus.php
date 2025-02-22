<?php
include "class/proses_crud.php";

$a= new proses_crud();

$id= $_GET['id'];

$hasil= $a->delete($id, 'tbl_datadiri');
//var_dump($hasil); die();
if ($hasil){
    echo "<script>alert('Data Berhasil Dihapus.');window.location='index.php';</script>";
}
?>