<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Using closures in event listeners</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script>
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 4,
          center: {lat: 6.217, lng: -75.567 }
        });

        var bounds = {
          north: 41.3850391,
          south: 40.3850391,
          east: 2.173343599999953,
          west: 2.153343599999953
        };

        // Display the area between the location southWest and northEast.
        map.fitBounds(bounds);

        // Add 5 markers to map at random locations.
        // For each of these markers, give them a title with their index, and when
        // they are clicked they should open an infowindow with text from a secret
        // message.
        var secretMessages = ['This', 'is', 'the', 'secret', 'message'];
        var lngSpan = bounds.east - bounds.west;
        var latSpan = bounds.north - bounds.south;
        for (var i = 0; i < secretMessages.length; ++i) {
          var marker = new google.maps.Marker({
            position: {
              lat: bounds.south + latSpan * Math.random(),
              lng: bounds.west + lngSpan * Math.random()
            },
            map: map
          });
          attachSecretMessage(marker, secretMessages[i]);
        }
      }

      // Attaches an info window to a marker with the provided message. When the
      // marker is clicked, the info window will open with the secret message.
      function attachSecretMessage(marker, secretMessage) {
        var infowindow = new google.maps.InfoWindow({
          content: secretMessage
        });

        marker.addListener('click', function() {
          infowindow.open(marker.get('map'), marker);
        });
      }
    </script>
    <script async defer
    src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d15866.496312003374!2d-75.55677075!3d6.18104325!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses-419!2sco!4v1542293420562">
    </script>
  </body>
</html>