
<?php
include './config.php';
session_start();

$nim    = "";
$nama   = "";
$email  = "";
$fakultas   = "";
$info1  = "";
$info2  = "";


if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if($op=='delete'){
    $id     = $_GET['id'];
    $sql1   = "delete  from mahasiswa where id = '$id'";
    $q1     = mysqli_query($koneksi,$sql1);
    if($q1){
        $info1="Data sudah dihapus";
    }
    else{
        $info2="Data gagal dihapus";
    }
}

if ($op == 'edit') {
    $id     = $_GET['id'];
    $sql1   = "select * from mahasiswa where id = '$id'";
    $q1     = mysqli_query($koneksi, $sql1);
    $r1     = mysqli_fetch_array($q1);
    $nama       = $r1['nama'];
    $nim        = $r1['nim'];
    $email      = $r1['alamat'];
    $fakultas   = $r1['jurusan'];

    if($nim==''){
        $info2="data tidak ditemukan";
    }
}
//Untuk create data
if (isset($_POST['simpan'])) {
    
    $nama       = $_POST['nama'];
    $nim        = $_POST['nim'];
    $email      = $_POST['email'];
    $fakultas   = $_POST['fakultas'];

    if ($nim && $nama && $email && $fakultas) {

        if ($op != 'edit') {//update
            $sql1 = "insert into mahasiswa (nama,nim,alamat,jurusan) values ('$nama','$nim','$email','$fakultas')";
            $q1 = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $info1 = "Data berhasil dimasukkan";
            } else {
                $info2 = "Data gagal dimasukkan";
            }
            
        } 
        else {//tambah
            $sql1 = "update mahasiswa set nama = '$nama',nim ='$nim',alamat = '$email' , jurusan='$fakultas' where id = '$id' ";
            $q1 = mysqli_query($koneksi, $sql1);

            if ($q1) {
                $info1 = "Data sudah di-update";
            } else {
                $info2 = "Data tidak dapat diupdate";
            }
        }
    } 
    else {
        $info2 = "Masih ada Data yang kosong";
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <style>
        .mx-auto {
            width: 70%;
        }

        .card {
            margin-top: 10px;
        }
    </style>
    <title>Data Mahasiswa</title>
</head>

<body>
    <div class="mx-auto">
        <!--Input data-->
        <div class="card">
            <div class="card-header bg-primary text-white">
                Edit Data
            </div>
            <div class="card-body">

                <?php
                if ($info2) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $info2; ?>
                    </div>
                <?php
                    header("refresh:5;url=indeks.php");
                }
                ?>

                <?php
                if ($info1) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $info1; ?>
                    </div>
                <?php
                }
                ?>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="Nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Jevon Ariel Putra" value="<?php echo "$nama" ?>">
                    </div>
                    <div class="mb-3">
                        <label for="Nama" class="form-label">NIM</label>
                        <input type="text" class="form-control" id="nim" name="nim" placeholder="201XXXXXXXXX" value="<?php echo "$nim" ?>">
                    </div>
                    <div class="mb-3">
                        <label for="Nama" class="form-label">Alamat Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="contoh@student.ub.ac.id" value="<?php echo "$email" ?>">
                    </div>
                    <div class="mb-3">
                        <label for="Nama" class="form-label">Fakultas</label>
                        <select class="form-control" name="fakultas" id="fakultas">
                            <option value="">-Pilih Fakultas-</option>
                            <option value="TIF" <?php if ($fakultas == "TIF") echo "selected" ?>>Teknik Informatika</option>
                            <option value="TEKKOM" <?php if ($fakultas == "TEKKOM") echo "selected" ?>>Teknik Komputer</option>
                            <option value="SI" <?php if ($fakultas == "SI") echo "selected" ?>>Sistem Informasi</option>
                            <option value="TI" <?php if ($fakultas == "TI") echo "selected" ?>>Teknologi Informasi</option>
                            <option value="PTI" <?php if ($fakultas == "PTI") echo "selected" ?>>Pendidikan teknologi informasi</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="simpan" class="btn btn-secondary">
                    </div>
                </form>
            </div>
        </div>
        <!--Output data-->
        <div class="card">
            <div class="card-header bg-primary text-white">
                Data Mahasiswa
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>NAMA</th>
                            <th>NIM</th>
                            <th>EMAIL</th>
                            <th>FAKULTAS</th>
                            <th>Perintah</th>
                        </tr>
                    <tbody>
                        <?php
                        $koneksi    = mysqli_connect($host, $user, $pass, $db);
                        $sql2 =  "select * from mahasiswa order by id desc";
                        $q2   = mysqli_query($koneksi, $sql2);
                        $urut = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id = $r2['id'];
                            $name = $r2['nama'];
                            $nim = $r2['nim'];
                            $email = $r2['alamat'];
                            $fakultas = $r2['jurusan'];
                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $name ?></td>
                                <td scope="row"><?php echo $nim ?></td>
                                <td scope="row"><?php echo $email ?></td>
                                <td scope="row"><?php echo $fakultas ?></td>
                                <td scope="row">
                                    <a href="indeks.php?op=edit&id=<?php echo $id ?>">
                                        <button type="button" class="btn btn-secondary ">
                                            edit
                                        </button>
                                    </a>
                                    <a href="indeks.php?op=delete&id=<?php echo $id ?>" onclick="return confirm('Data akan dihapus')">
                                        <button type="button" class="btn btn-secondary ">
                                            delete
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        <?php
                        }

                        ?>
                    </tbody>
                    </thead>
                </table>
                <a href="logout.php">Logout</a>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    -->
</body>

</html>