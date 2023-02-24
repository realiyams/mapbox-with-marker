<!DOCTYPE html>
<?php
	// CONNECT to DATABASE
	include "connect.php";

  $query = 'DESC Destinasi';
  $sql = mysqli_query($connect, $query);
  if (!$sql){
    include "database.php";
  }
?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mapbox API</title>
  
  <script src='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js'></script>
  <link href='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css' rel='stylesheet' />
</head>

<body>
  <center>
    <h1>PETA MENGGUNAKAN MAPBOX</h1><hr>

    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.min.js"></script>
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.css" type="text/css">
    
    <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script>
    <style>
      .geocoder {
        position: absolute;
        z-index: 1;
        width: 50%;
        left: 50%;
        margin-left: -25%;
        top: 100px;
      }
      .mapboxgl-ctrl-geocoder {
        min-width: 100%;
      }
      #map {
        margin-top: 75px;
      }
    </style>

    <div id='map' style='width: 600px; height: 400px;'></div>
    <div id="geocoder" class="geocoder"></div>
    <script>
      mapboxgl.accessToken = <?php echo '"'.$_ENV['accessToken'].'"'; ?>;
      
      var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center : [107.609811, -6.914744],
        zoom : 10
      });

      // Add the control to the map
      var geocoder = new MapboxGeocoder({
        accessToken: mapboxgl.accessToken,
        mapboxgl: mapboxgl
      });
      document.getElementById('geocoder').appendChild(geocoder.onAdd(map));

      // Geocoder on result
      geocoder.on('result', function(e) {

        // console.log(e);
        document.getElementById("lokasi").value = e.result.place_name;
        document.getElementById("lat").value = e.result.center[1];      
        document.getElementById("lng").value = e.result.center[0]; 
      })
    </script>

    <?php 
      // QUERY SQL
      $query = "SELECT * FROM Destinasi"; 
      // RUN QUERY
      $sql = mysqli_query($connect, $query);

      // CATCH DATA
      while($data = mysqli_fetch_array($sql)){      
      // CREATE ALL MARKER DATABASE 
        echo "<script>
          var infoMarker = '<h3>".$data['lokasi']."</h3><br>Latitude : ".$data['latitude']."<br>Longitude : ".$data['longitude']."<br><br><form action=\'hapus.php\' method=\'POST\' enctype=\'multipart/form-data\'><input type=\'number\' id=\'id\' name=\'id\' value=". $data['id'] ." hidden><input type=\"submit\" value=\"Hapus\"></form>';

          var marker = new mapboxgl.Marker()
            .setLngLat([".$data['longitude'].", ".$data['latitude']."])
            .setPopup(new mapboxgl.Popup().setHTML(infoMarker))
            .addTo(map);
        </script>";
      }
    ?>

    <form method="POST" action="simpan.php" enctype="multipart/form-data">
      
      <table cellpadding="8">
        <tr>
          <td>Lokasi</td>
          <td><input type="text" id="lokasi" name="lokasi" readonly></td>
        </tr>
        <tr>
          <td>Latitude</td>
          <td><input type="text" name="latitude" id="lat" readonly></td>
        </tr>
        <tr>
          <td>Longitude</td>
          <td><input type="text" name="longitude" id="lng" readonly></td>
        </tr>
      </table>
      
      <hr>
      <input type="submit" value="Simpan">
      <input type="reset" value="batal">

    </form>
  </center>
</body>
</html>