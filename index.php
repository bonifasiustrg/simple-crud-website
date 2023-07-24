<?php

include_once 'koneksi.php'; // Include koneksi.php

$title = "";
$author = "";
$year = null;
$isbn = null;

$error = "";
$success = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if ($op == 'delete') {
    $id = $_GET['id'];
    $sql1 = "DELETE FROM book WHERE Idbuku = '$id'";
    $q1 = mysqli_query($conn, $sql1);

    if ($q1) {
        $success = "Berhasil menghapus data";
    } else {
        $error = "Gagal menghapus data";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Perpustakaan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <style>
        .mx-auto {
            width: 80%;
            margin-top: 20px;

        }

        .card {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="mx-auto">
        <div class="position-relative p-5 text-center text-muted bg-body border border-dashed rounded-5">
            <h1 class="text-body-emphasis">Sistem Informasi Perpustakaan</h1>
            <p class="col-lg-6 mx-auto mb-4">
            Website yang menyediakan layanan untuk menampilkan dan menambahkan informasi buku secara interaktif dan komprehensif.
            </p>
            <a href="form.php"><button type="button" class="btn btn-primary px-5 mb-5">Tambah Buku</button></a>
        </div>

        <!-- SHOW ADDED DATA -->
        <div class="card">
            <h5 class="card-header text-white bg-secondary">Buku Perpustakaan</h5>
            <div class="card-body">

                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                    header("refresh:3;url=index.php");
                }
                ?>
                <?php
                if ($success) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $success ?>
                    </div>
                <?php
                    header("refresh:3;url=index.php");
                }
                ?>

                <!-- TABEL DATA BUKU -->
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Judul Buku</th>
                            <th scope="col">Pengarang</th>
                            <th scope="col">Tahun Terbit</th>
                            <th scope="col">ISBN</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    <tbody>
                        <?php
                        $sql2 = "SELECT * FROM book ORDER BY Idbuku ASC ";
                        $q2 = mysqli_query($conn, $sql2);
                        $urut = 1;

                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id = $r2['Idbuku'];
                            $title = $r2['judul'];
                            $author = $r2['pengarang'];
                            $year = $r2['tahun_terbit'];
                            $isbn = $r2['isbn'];
                        ?>

                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $title ?></td>
                                <td scope="row"><?php echo $author ?></td>
                                <td scope="row"><?php echo $year ?></td>
                                <td scope="row"><?php echo $isbn ?></td>
                                <td scope="row">
                                    <a href="form.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                    <a href="index.php?op=delete&id=<?php echo $id ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"><button type="button" class="btn btn-danger">Hapus</button></a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</body>

</html>