<!doctype html>
<html lang="en">

<?php
// koenk database
$koneksi = mysqli_connect("localhost", "root", "", "db_gudang");

// input kategori
if (isset($_POST['subkat'])) {
    $kategori = $_POST['kategori'];

    mysqli_query($koneksi, "INSERT INTO categories VALUES('','$kategori')");
    header("location:6.php");
}

// input produk
if (isset($_POST['subpro'])) {
    $produk = $_POST['produk'];
    $stock  = $_POST['stok'];
    $des  = $_POST['deskripsi'];
    $kategori = $_POST['kategori'];

    mysqli_query($koneksi, "INSERT INTO products VALUES('','$produk','$stock','$des','$kategori')");
    header("location:6.php");
}

// delete produk
if (isset($_POST['hapus'])) {
    $id = $_POST['id_produk'];

    mysqli_query($koneksi, "DELETE FROM products WHERE id_p='$id'");
    header("location:6.php");
}

// edit produk
if (isset($_POST['subedit'])) {
    $produk = $_POST['produk'];
    $stock  = $_POST['stok'];
    $des  = $_POST['deskripsi'];
    $kategori = $_POST['kategori'];
    $id = $_POST['id_produk'];

    mysqli_query($koneksi, "UPDATE products SET produk='$produk', stock='$stock', deskripsi='$des' where id_p='$id'");
}


?>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


    <title>Dumbways</title>
</head>

<body>
    <div class="container mb-5">
        <h1 class="text-center mb-5">Gudang Dumbways</h1>

        <?php
        $kategori = mysqli_query($koneksi, "SELECT * FROM categories");
        while ($row = mysqli_fetch_array($kategori)) :
            ?>
            <div class="accordion" id="accordionExample">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collaps<?= $row['id'] ?>" aria-expanded="true" aria-controls="collapseOne">
                                <?= $row['name'] ?>
                            </button>
                        </h2>
                    </div>
                    <div id="collaps<?= $row['id'] ?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama kategori</th>
                                        <th scope="col">Nama produk</th>
                                        <th scope="col">stock</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $id = $row['id'];
                                        $produk = mysqli_query($koneksi, "SELECT * FROM products inner join categories on category_id = id WHERE category_id = $id");
                                        $i = 1;
                                        while ($d = mysqli_fetch_assoc($produk)) :
                                            ?>
                                        <tr>
                                            <th scope="row"><?= $i ?></th>
                                            <td><?= $d['name'] ?></td>
                                            <td><?= $d['produk'] ?></td>
                                            <td><?= $d['stock'] ?></td>
                                            <td>
                                                <button type="button" class="btn btn-primary fas fa-trash" data-toggle="modal" data-target="#hapus<?= $d['id_p'] ?>" data-whatever="@mdo"></button>
                                                <button type="button" class="btn btn-primary fas fa-edit" data-toggle="modal" data-target="#edit<?= $d['id_p'] ?>" data-whatever="@mdo"></button>
                                                <button type="button" class="btn btn-primary fas fa-info-circle" data-toggle="modal" data-target="#detail<?= $d['id_p'] ?>" data-whatever="@mdo"></button>
                                            </td>
                                        </tr>

                                        <!-- modal hapus -->
                                        <div class="modal fade bd-example-modal-lg" id="hapus<?= $d['id_p'] ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Delete data <?= $d['produk'] ?></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post">
                                                            <input type="text" hidden value="<?= $d['id_p'] ?>" name="id_produk">

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                        <button type="submit" name="hapus" value="hapus" class="btn btn-primary">Yakin</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- modal edit -->
                                        <div class="modal fade bd-example-modal-lg" id="edit<?= $d['id_p'] ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit data <?= $d['produk'] ?></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post">
                                                            <input type="text" hidden value="<?= $d['id_p'] ?>" name="id_produk">
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Nama produk</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" value="<?= $d['produk'] ?>" name="produk" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Stocks</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" value="<?= $d['stock'] ?>" name="stok" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Deskrtipsi</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" value="<?= $d['deskripsi'] ?>" name="deskripsi" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Kategori</label>
                                                                <div class="col-sm-10">
                                                                    <select name="kategori" class="form-control">
                                                                        <?php
                                                                                $kat = mysqli_query($koneksi, "SELECT * FROM categories");
                                                                                ?>
                                                                        <option selected hidden value="<?= $d['id'] ?>"><?= $d['name'] ?></option>
                                                                        <?php while ($row = mysqli_fetch_array($kat)) : ?>
                                                                            <option value="<?= $row['id'] ?>"><?= $row['name']; ?></option>
                                                                        <?php endwhile; ?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                        <button type="submit" name="subedit" value="hapus" class="btn btn-primary">Yakin</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- modal detail -->
                                        <div class="modal fade bd-example-modal-lg" id="detail<?= $d['id_p'] ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Delete data <?= $d['produk'] ?></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <div class="row">
                                                            <div class="col-sm-2">
                                                                Kategori
                                                            </div>
                                                            <div class="col-sm">
                                                                : <?= $d['name'] ?>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-2">
                                                                Nama Produk
                                                            </div>
                                                            <div class="col-sm">
                                                                : <?= $d['produk'] ?>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-2">
                                                                Stock
                                                            </div>
                                                            <div class="col-sm">
                                                                : <?= $d['stock'] ?>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-2">
                                                                Deskripsi
                                                            </div>
                                                            <div class="col-sm">
                                                                : <?= $d['deskripsi'] ?>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                        <button type="submit" name="hapus" value="hapus" class="btn btn-primary">Yakin</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <?php $i++;
                                        endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>

        <button type="button" class="btn btn-secondary btn-md btn-block mt-5" data-toggle="modal" data-target="#input">Tambah Produk</button>
        <button type="button" class="btn btn-primary btn-md btn-block mt-2" data-toggle="modal" data-target="#kategori">Tambah Kategori</button>

        <!-- tambah data kategori -->
        <div class="modal fade bd-example-modal-lg" id="kategori" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah data kategori</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nama Kategori</label>
                                <div class="col-sm-10">
                                    <input type="text" name="kategori" class="form-control">
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                        <button type="submit" name="subkat" value="kategori" class="btn btn-primary">Yakin</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- tambah data produk -->
        <div class="modal fade bd-example-modal-lg" id="input" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah data produk</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nama produk</label>
                                <div class="col-sm-10">
                                    <input type="text" name="produk" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Stocks</label>
                                <div class="col-sm-10">
                                    <input type="text" name="stok" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Deskrtipsi</label>
                                <div class="col-sm-10">
                                    <input type="text" name="deskripsi" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Kategori</label>
                                <div class="col-sm-10">
                                    <select name="kategori" class="form-control">
                                        <?php
                                        $kat = mysqli_query($koneksi, "SELECT * FROM categories");
                                        while ($row = mysqli_fetch_array($kat)) :
                                            ?>
                                            <option hidden selected></option>
                                            <option value="<?= $row['id'] ?>"><?= $row['name']; ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                        <button type="submit" name="subpro" alue="produk" class="btn btn-primary">Yakin</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Optional JavaScript -->
    <!-- FontAwesome, jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://kit.fontawesome.com/be1c70ccf8.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>