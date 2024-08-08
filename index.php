<?php include "header.php"; ?>

<!-- start banner Area -->
<section class="banner-area relative">
  <div class="overlay overlay-bg"></div>
  <div class="container">
    <div class="row fullscreen align-items-center justify-content-between">
      <div class="col-lg-6 col-md-6 banner-left">
        <h6 class="text-white">SISTEM INFORMASI GEOGRAFIS PLN</h6>
        <h1 class="text-white">KOTA BANDAR LAMPUNG</h1>
        <p class="text-white">
          Sistem informasi ini merupakan aplikasi pemetaan geografis gardu PLN di wilayah Bandar Lampung. Aplikasi ini memuat informasi dan lokasi dari gardu PLN di Bandar Lampung.
        </p>
        <a href="#peta" class="primary-btn text-uppercase">Lihat Detail</a>
      </div>
    </div>
  </div>
</section>
<!-- End banner Area -->

<main id="main">

  <!-- Start about-info Area -->
  <section class="price-area section-gap">
    <section id="peta" class="about-info-area section-gap">
      <div class="container">
        <div class="title text-center">
          <h1 class="mb-10">Peta Lokasi</h1>
          <br>
        </div>
        <div class="row align-items-center">
          <div id="map" style="width:100%;height:480px;"></div>
          
          <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
          <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
          <script>
            // Initialize the map
            var map = L.map('map').setView([-5.450000, 105.266667], 12);

            // Add OpenStreetMap tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
              attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Define the SVG icon as a string
            function getCustomSVGIcon(color) {
              return `
                <svg width="28" height="41" xmlns="http://www.w3.org/2000/svg">
                  <path d="M14 1c-6.8 0-12.5 5.7-12.5 11.9 0 2.8 1.6 6.3 2.8 8.7l9.7 17.9 9.6-17.9c1.2-2.4 2.9-5.8 2.9-8.7C26.5 6.7 20.8 1 14 1zm0 7.2c2.7 0 4.9 2.1 4.9 4.7 0 2.6-2.2 4.7-4.9 4.7-2.7 0-4.9-2.1-4.9-4.7s2.2-4.7 4.9-4.7z" fill="${color}" />
                  <path d="M14 7.2c-3.2 0-5.8 2.6-5.8 5.8s2.6 5.8 5.8 5.8 5.8-2.6 5.8-5.8-2.6-5.8-5.8-5.8z" fill="none" stroke="#fff" stroke-width="1" />
                </svg>`;
            }

            // Fetch data from the server
            fetch('http://localhost/SIG/ambildata.php')
              .then(response => response.json())
              .then(data => {
                // Add markers to the map
                data.results.forEach(function(office) {
                  var icon = L.divIcon({
                    className: 'custom-icon',
                    html: getCustomSVGIcon(office.color), // Ensure each office has a color
                    iconSize: [28, 41],
                    iconAnchor: [14, 41]
                  });

                  var marker = L.marker([office.latitude, office.longitude], { icon: icon }).addTo(map);
                  var popupContent = '<div id="content">' +
                                    '<h5>' + office.nama_wisata + '</h5>' +
                                    '<div><a href="detail.php?id_wisata=' + office.id_wisata + '">Info Detail</a></div>' +
                                    '</div>';
                  marker.bindPopup(popupContent);
                });
              })
              .catch(error => console.error('Error fetching data:', error));
          </script>

        </div>
      </div>
    </section>
    <!-- End about-info Area -->

    <!-- Start price Area -->
    <div class="container">
      <div class="row d-flex justify-content-center">
        <div class="menu-content pb-70 col-lg-8">
          <div class="title text-center">
            <h1 class="mb-10">Jangkauan Peta</h1>
            <p>Aplikasi pemetaan geografis Gardu PLN di kota Bandar Lampung ini memuat informasi dan lokasi dari Gardu PLN di Bandar Lampung. Aplikasi ini memuat sejumlah informasi mengenai :
            </p>
          </div>
        </div>
      </div>
      <!-- End other-issue Area -->
    </div>

    <!-- ======= Counts Section ======= -->
    <section id="counts">
      <div class="container">
        <div class="title text-center">
          <h1 class="mb-10">Jumlah Gardu</h1>
          <br>
        </div>
        <div class="row d-flex justify-content-center">
          <?php
          include_once "countsma.php";
          $obj = json_decode($data);
          $sman = "";
          foreach ($obj->results as $item) {
            $sman .= $item->sma;
          }
          ?>
          <div class="text-center">
            <h1><span data-toggle="counter-up"><?php echo $sman; ?></span></h1>
            <br>
          </div>
          <?php
          include_once "countsmk.php";
          $obj2 = json_decode($data);
          $smkn = "";
          foreach ($obj2->results as $item2) {
            $smkn .= $item2->smk;
          }
          ?>
        </div>
      </div>
    </section><!-- End Counts Section -->
  </section>
  <!-- End testimonial Area -->
</main>

<?php include "footer.php"; ?>
