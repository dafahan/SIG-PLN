<?php
include "koneksi.php";

$query = "
SELECT w.id_wisata, w.nama_wisata,w.deskripsi, w.alamat, w.longitude, w.latitude, w.harga_tiket, s.color
FROM wisata w
JOIN state s ON w.harga_tiket = s.name";

$Q = mysqli_query($koneksi, $query);

if ($Q) {
    $posts = array();
    if (mysqli_num_rows($Q)) {
        while ($post = mysqli_fetch_assoc($Q)) {
            $posts[] = $post;
        }
    }
    $data = json_encode(array('results' => $posts));
    echo $data;
}
?>
