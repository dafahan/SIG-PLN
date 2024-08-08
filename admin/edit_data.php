<!DOCTYPE html>
<html lang="en">
<?php 
include "header.php"; 
include "../koneksi.php"; // This file contains your database connection code

// Fetch status options from the state table
$query = "SELECT id, name FROM state";
$result = $koneksi->query($query);

// Fetch current data for the place to be edited
$id = $_GET['id_wisata'];
$query = mysqli_query($koneksi, "SELECT * FROM wisata WHERE id_wisata='$id'");
$data = mysqli_fetch_array($query);
?>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php include "menu_sidebar.php"; ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <?php include "menu_topbar.php"; ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Edit Data Tempat Wisata</h1>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Edit Data</h6>
                        </div>
                        <div class="card-body">
                            <div class="panel-body">
                                <form class="form-horizontal style-form" style="margin-top: 20px;" action="edit_aksi.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">ID</label>
                                        <div class="col-sm-8">
                                            <input name="id_wisata" type="text" id="id_wisata" class="form-control" value="<?php echo $data['id_wisata']; ?>" readonly />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Nama</label>
                                        <div class="col-sm-8">
                                            <input name="nama_wisata" type="text" id="nama_wisata" class="form-control" value="<?php echo $data['nama_wisata']; ?>" required />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Alamat</label>
                                        <div class="col-sm-8">
                                            <input name="alamat" class="form-control" id="alamat" type="text" value="<?php echo $data['alamat']; ?>" required />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Deskripsi</label>
                                        <div class="col-sm-8">
                                            <input name="deskripsi" class="form-control" id="deskripsi" type="text" value="<?php echo $data['deskripsi']; ?>" required />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Status</label>
                                        <div class="col-sm-8">
                                            <select name="harga_tiket" class="form-control" required>
                                                <option value="">Pilih Status</option>
                                                <?php while ($row = $result->fetch_assoc()) { ?>
                                                    <option value="<?php echo $row['name']; ?>" <?php if ($row['name'] == $data['harga_tiket']) echo 'selected'; ?>>
                                                        <?php echo $row['name']; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Latitude</label>
                                        <div class="col-sm-8">
                                            <input name="latitude" class="form-control" id="latitude" type="text" value="<?php echo $data['latitude']; ?>" required />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Longitude</label>
                                        <div class="col-sm-8">
                                            <input name="longitude" class="form-control" id="longitude" type="text" value="<?php echo $data['longitude']; ?>" required />
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-bottom: 20px;">
                                        <label class="col-sm-2 col-sm-2 control-label"></label>
                                        <div class="col-sm-8">
                                            <input type="submit" value="Simpan" class="btn btn-sm btn-primary" />&nbsp;
                                        </div>
                                    </div>
                                    <div style="margin-top: 20px;"></div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <?php include "footer.php"; ?>
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
</body>

</html>
