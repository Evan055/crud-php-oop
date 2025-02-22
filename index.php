<?php
//ambil class proses_crud
include 'class/proses_crud.php';

//inisialisasi class proses_crud
$a= new proses_crud();

//ambil data dari database
$query=  "SELECT * FROM tbl_datadiri order by id DESC";
$results= $a->getData($query);

//var_dump($results); die();
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <!-- Link to External CSS -->
    <link rel="stylesheet" href="css/styles.css">
    
    <title>CRUD PHP IMAGE</title>
</head>
<body>
<div id="page-content">
    <div class="container">
        <button onclick="openModal('modalTambah')" class="btn btn-success mt-2 mb-2 ">Tambah Data</button>
        <a href="logout.php" class="btn btn-danger mt-2 mb-2 float-right"><i class="fa-solid fa-sign-out"></i>Logout</a>
        
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Tanggal Lahir</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no= 1;
                foreach ($results as $row) {
                    echo "<tr>";
                    echo "<td>" . $no . "</td>";
                    echo "<td>" . $row['nama'] . "</td>";
                    echo "<td>" . $row['ttl'] . "</td>";
                    echo "<td>" . $row['alamat'] . "</td>";
                    echo "<td>" . $row['jk'] . "</td>";
                    echo "
                        <td>
                            <!-- Edit button triggers the modal -->
                            <button class='btn btn-warning' onclick='openEditModal(
                                \"" . $row['id'] . "\", 
                                \"" . $row['nama'] . "\", 
                                \"" . $row['alamat'] . "\", 
                                \"" . $row['ttl'] . "\", 
                                \"" . $row['jk'] . "\"
                            )'>
                            <i class='fa-solid fa-pencil'></i> Edit
                            </button>

                            <a href='proses-hapus.php?id=" . $row['id'] . "' class='btn btn-danger' onclick='return confirm(\"Anda yakin akan menghapus data ini ?\")'>
                                <i class='fa-solid fa-trash'></i> Hapus
                            </a>
                        </td>
                    ";
                ?>
                <?php
                $no++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
    <!-- Modal Tambah Data -->
    <div id="modalTambah" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('modalTambah')">&times;</span>
        <h2>Tambah Data</h2>
        <form action="proses-tambah.php" method="POST">
        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" class="form-control" name="nama" required>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat:</label>
            <input type="text" class="form-control" name="alamat" required>
        </div>

        <div class="form-group">
            <label for="ttl">Tanggal Lahir:</label>
            <input type="date" class="form-control" name="ttl" required>
        </div>

        <div class="form-group">
            <label for="jk">Jenis Kelamin:</label>
            <select name="jk" class="form-control" required>
                <option value="Pria">Pria</option>
                <option value="Wanita">Wanita</option>
            </select>
        </div>

        <!-- <div class="form-group">
            <label for="gambar">Gambar:</label>
            <input type="file" class="form-control-file" name="gambar">
        </div> -->

        <div class="modal-footer">
            <button type="submit" class="btn btn-success">Tambah</button>
            <button type="button" class="btn btn-secondary" onclick="closeModal('modalTambah')">Kembali</button>
        </div>
    </form>
    </div>
    </div>

    <!-- Modal Edit Data -->
    <div id="modalEdit" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('modalEdit')">&times;</span>
        <h2>Edit Data</h2>
        <form action="proses-edit.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" class="form-control" name="id" id="editId">

            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" name="nama" id="editNama" required>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <input type="text" class="form-control" name="alamat" id="editAlamat" required>
            </div>        

            <div class="form-group">
                <label for="ttl">Tanggal Lahir:</label>
                <input type="date" class="form-control" name="ttl" id="editTtl" required>
            </div>

            <div class="form-group">
                <label for="jk">Jenis Kelamin:</label>
                <select name="jk" class="form-control" id="editJk" required>
                    <option value="Pria">Pria</option>
                    <option value="Wanita">Perempuan</option>
                </select>
            </div>

            <!-- <div class="form-group">
                <label for="gambar">Gambar:</label>
                <input type="file" class="form-control-file" name="gambar">
                <img id="editGambarPreview" src="" width="100">
            </div> -->

            <div class="modal-footer">
                <!-- "Simpan" button (to submit form) -->
                <button type="submit" class="btn btn-success" name="submit" id="submit">Simpan</button>
                <!-- "Kembali" button (to close modal and return to home) -->
                <button type="button" class="btn btn-secondary" onclick="closeModal('modalEdit')">Kembali</button>
            </div>
        </form>
    </div>
    </div>

    <script>
    function openModal(id) {
        document.getElementById(id).style.display = "block";
        // Add the blur effect to the main content
        document.getElementById("page-content").classList.add("blur");
    }

    function closeModal(id) {
        document.getElementById(id).style.display = "none";
        // Add the blur effect to the main content
        document.getElementById("page-content").classList.remove("blur");        
    }

    // Populate Edit Modal with selected data
    function openEditModal(id, nama, alamat, ttl, jk, gambar) {
        document.getElementById("editId").value = id;
        document.getElementById("editNama").value = nama;
        document.getElementById("editAlamat").value = alamat;
        document.getElementById("editTtl").value = ttl;
        document.getElementById("editJk").value = jk;
        openModal("modalEdit");
    }
    </script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>