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

if ($op == 'edit') {
    $id = $_GET['id'];
    $sql1 = "SELECT * FROM book WHERE Idbuku = '$id'";
    $q1 = mysqli_query($conn, $sql1);
    $r1 = mysqli_fetch_array($q1);

    $title = $r1['judul'];
    $author = $r1['pengarang'];
    $year = $r1['tahun_terbit'];
    $isbn = $r1['isbn'];
}

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $year = $_POST['year'];
    $isbn = $_POST['isbn'];


    if ($title && $author && $year && $isbn) {
        if ($op == 'edit') { /* UPDATE DATA */
            $sql1 = "UPDATE book SET judul='$title', pengarang='$author', tahun_terbit='$year', isbn='$isbn'  WHERE Idbuku = '$id'";
            $q1 = mysqli_query($conn, $sql1);

            if ($q1) {
                $success = "Data berhasil diperbarui";
            } else {
                $error = "Data gagal diperbarui";
            }
        } else {
            /* INSERT DATA */
            $sql1 = "INSERT INTO book (judul, pengarang, tahun_terbit, isbn) VALUES ('$title','$author','$year','$isbn')";
            $q1 = mysqli_query($conn, $sql1);

            if ($q1) {
                $success = "Berhasil menambahkan data buku";
                header('Location: index.php');
            } else {
                $error = "Gagal menambahkan buku";
            }
        }
    } else {
        $error = "Semua data harus diisi";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Buku</title>

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
        <!-- ADD DATA -->
        <div class="card">
            <h5 class="card-header">Create / Edit Data</h5>
            <div class="card-body">

                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                }
                ?>
                <?php
                if ($success) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $success ?>
                    </div>
                <?php
                    header("refresh:2;url=index.php");
                }
                ?>

                <form action="" method="POST" id="form-book" onsubmit="return validateForm()">
                    <div class="mb-3">
                        <label for="title" class="form-label">Book Title</label>
                        <input type="text" class="form-control" name="title" id="title" value="<?php echo $title ?>">
                    </div>
                    <div class="mb-3">
                        <label for="author" class="form-label">Author</label>
                        <input type="text" class="form-control" id="author" name="author" value="<?php echo $author ?>">
                    </div>

                    <div class="mb-3">
                        <label for="year" class="form-label">Year</label>
                        <input type="int" class="form-control" id="year" name="year" value="<?php echo $year ?>">
                    </div>

                    <div class="mb-3">
                        <label for="isbn" class="form-label">ISBN</label>
                        <input type="int" class="form-control" name="isbn" id="isbn" value="<?php echo $isbn ?>"">
                    </div>

                    <button type=" submit" name="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function validateForm() {
            var title = document.getElementById('title').value;
            var author = document.getElementById('author').value;
            var year = document.getElementById('year').value;
            var isbn = document.getElementById('isbn').value;

            if (title.trim() === '' || author.trim() === '' || year.trim() === '' || isbn.trim() === '') {
                alert('Semua data harus diisi.');
                return false;
            }

            return true;
        }
    </script>
</body>

</html>