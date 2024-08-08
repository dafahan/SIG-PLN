<?php include "header.php"; ?>
<?php
$id = $_GET['id_wisata'];
include_once "ambildata_id.php";
$obj = json_decode($data);
$id_wisata = "";
$nama_wisata = "";
$alamat = "";
$deskripsi = "";
$harga_tiket = "";
$lat = "";
$long = "";
foreach ($obj->results as $item) {
  $id_wisata .= $item->id_wisata;
  $nama_wisata .= $item->nama_wisata;
  $alamat .= $item->alamat;
  $deskripsi .= $item->deskripsi;
  $harga_tiket .= $item->harga_tiket;
  $lat .= $item->latitude;
  $long .= $item->longitude;
}

$title = "Detail dan Lokasi : " . $nama_wisata;
?>

<!-- Include Leaflet CSS and JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script type="text/javascript">
  document.addEventListener('DOMContentLoaded', function() {
    // Initialize the map
    var map = L.map('map-canvas').setView([<?php echo $lat ?>, <?php echo $long ?>], 13);

    // Add OpenStreetMap tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Define marker data
    var officeLocations = [
      [<?php echo $id_wisata ?>, '<?php echo $nama_wisata ?>', '<?php echo $alamat ?>', <?php echo $lat ?>, <?php echo $long ?>]
    ];

    // Add markers to the map
    officeLocations.forEach(function(office) {
      var marker = L.marker([office[3], office[4]]).addTo(map);
      var popupContent = '<div id="content">' +
                         '<h5>' + office[1] + '</h5>' +
                         '<div><a href="detail.php?id_wisata=' + office[0] + '">Info Detail</a></div>' +
                         '</div>';
      marker.bindPopup(popupContent);
    });
  });
</script>

<!-- start banner Area -->
<section class="about-banner relative">
  <div class="overlay overlay-bg"></div>
  <div class="container">
    <div class="row d-flex align-items-center justify-content-center">
      <div class="about-content col-lg-12">
        <h1 class="text-white">
          Detail Informasi Gardu PLN
        </h1>
      </div>
    </div>
  </div>
</section>
<!-- End banner Area -->

<!-- Start about-info Area -->
<section class="about-info-area section-gap">
  <div class="container" style="padding-top: 120px;">
    <div class="row">
      <div class="col-md-7" data-aos="fade-up" data-aos-delay="200">
        <div class="panel panel-info panel-dashboard">
          <div class="panel-heading centered">
            <h2 class="panel-title"><strong>Informasi Gardu </strong></h2>
          </div>
          <div class="panel-body">
            <table class="table">
              <tr>
                <th>Detail</th>
              </tr>
              <tr>
                <td>Nama</td>
                <td>
                  <h5><?php echo $nama_wisata ?></h5>
                </td>
              </tr>
              <tr>
                <td>Alamat</td>
                <td>
                  <h5><?php echo $alamat ?></h5>
                </td>
              </tr>
              <tr>
                <td>Deskripsi</td>
                <td>
                  <h5><?php echo $deskripsi ?></h5>
                </td>
              </tr>
              <tr>
                <td>Status</td>
                <td>
                  <h5><?php echo $harga_tiket ?></h5>
                </td>
              </tr>
              <tr>
                <td>Maps</td>
                <td>
                  <h5>
                    <a href="https://www.google.com/maps?q=<?php echo $lat ?>,<?php echo $long ?>" target="_blank" class="btn btn-primary">OPEN IN GMAPS</a>
                  </h5>
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>

      <div class="col-md-5" data-aos="zoom-in">
        <div class="panel panel-info panel-dashboard">
          <div class="panel-heading centered">
            <h2 class="panel-title"><strong>Lokasi</strong></h2>
          </div>
          <div class="panel-body">
            <div id="map-canvas" style="width:100%;height:380px;"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End about-info Area -->

<?php include "footer.php"; ?>
