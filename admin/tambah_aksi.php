<?php
// koneksi database
error_reporting(E_ALL);
ini_set('display_errors', 1);
include '../koneksi.php';

$nama = $_POST['nama_wisata'];
$alamat = $_POST['alamat'];
$deskripsi = $_POST['deskripsi'];
$status = $_POST['harga_tiket']; 
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];

// menginput data ke database
$query = "INSERT INTO wisata (nama_wisata, alamat, deskripsi, harga_tiket, latitude, longitude) VALUES ('$nama', '$alamat', '$deskripsi', '$status', '$latitude', '$longitude')";
mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

// mengalihkan halaman kembali ke index.php
header("location:tampil_data.php");
?>
