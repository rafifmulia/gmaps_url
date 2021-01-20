<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GMaps URL</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>

  <div class="container-fluid">
    <!-- Search API -->
    <div class="row my-4">
      <div class="col-12">
        <div class="card">
          <div class="card-header">GMaps Search API</div>
          <div class="card-body">
            <div class="form-group">
              <label>Search By Words</label>
            </div>
            <div class="form-group row">
              <div class="col-6">
                <input type="text" id="searchQuery" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <button type="button" id="btnSearchQuery" class="btn btn-primary">Search</button>
            </div>
            <hr>
            <div class="form-group">
              <label>Search By Latitude and Longitude</label>
            </div>
            <div class="form-group row">
              <div class="col-4">
                <label>Latitude</label>
                <input type="text" id="searchLat" class="form-control">
              </div>
              <div class="col-4">
                <label>Longitude</label>
                <input type="text" id="searchLng" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <button type="button" id="btnSearchLatLng" class="btn btn-primary">Search</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Direction API -->
    <div class="row my-4">
      <div class="col-12">
        <div class="card">
          <div class="card-header">GMaps Direction API</div>
          <div class="card-body">
            <div class="form-group row">
              <div class="col-6">
                <div class="form-group">
                  <label>Dari</label>
                  <input type="text" id="dirOrigin" class="form-control" placeholder="Kosongkan jika menggunakan lokasi sekarang">
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label>Tujuan</label>
                  <input type="text" id="dirDestination" class="form-control">
                </div>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-6">
                <label>Kendaraan</label>
                <select id="dirTravel" class="form-control">
                  <option value="1">Jalan Kaki</option>
                  <option value="2">Sepeda</option>
                  <option value="3">Motor</option>
                  <option value="4">Mobil</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <button type="button" id="btnDirection" class="btn btn-primary">Go</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Geo Links -->
    <div class="row my-4">
      <div class="col-12">
        <div class="card">
          <div class="card-header">Geo Links</div>
          <div class="card-body">
            <div class="form-group">
              <p><a href="geo:50,10">Location 50/10</a></p>
              <p><a href="geo:MargoCity">Location MargoCity</a></p>
              <p><a href="geo:?z=5&q=Margo+City">Zoom 5, Search for Margo City</a></p>
              <p><a href="geo:?q=Lenteng+Agung&z=15">Zoom 15, Search for Lenteng Agung</a></p>
              <p><a href="google.navigation:q=Lenteng+Agung">Navigation to Lenteng Agung</a></p>
              <p><a href="google.navigation:q=50,10">Navigation to 50/10</a></p>
              <p><a href="http://maps.google.com/maps?saddr=Margo+City&daddr=Lenteng+Agung">Route Margo City --> Lenteng Agung</a></p>
              <p><a href="http://maps.google.com/maps?saddr=50,10&daddr=50,20">Route 50/10 --> 50/20</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script>
    if (typeof jQuery == 'undefined') {
      throw new Error("Jquery Needed");
    }

    // jquery ready
    $(function() {
      // let data = {
      //   mapsUrl: null, // (maps:// || https://) + maps.google.com/maps
      // }

      function MapsUrl() {
        this.url = null

        this.setMapsUrl = function() {
          if /* if we're on iOS, open in Apple Maps */ ((navigator.platform.indexOf("iPhone") != -1) ||
            (navigator.platform.indexOf("iPad") != -1) ||
            (navigator.platform.indexOf("iPod") != -1)) {
            // this.url = 'maps://maps.google.com/maps'; // not work if open maps directly from mobile browser
            this.url = 'maps:/www.google.com/maps';
          } else /* else use google */ {
            // this.url = 'https://maps.google.com/maps'; // not work if open maps directly from mobile browser
            this.url = 'https://www.google.com/maps';
          }
        }

        this.setMapsUrl()

        this.searchApi = function(params) {
          window.open(this.url + '/search/?api=1&' + encodeURI(params));
        }

        this.dirApi = function(params) {
          window.open(this.url + '/dir/?api=1&' + encodeURI(params));
          // window.location = 'geo:40.765819,-73.975866';
        }

        return this
      }

      let mapsUrl = MapsUrl();


      $('#btnSearchQuery').on('click', function(e) {
        mapsUrl.searchApi('query=' + $('#searchQuery').val());
      });

      $('#btnSearchLatLng').on('click', function(e) {
        mapsUrl.searchApi('query=' + $('#searchLat').val() + ',' + $('#searchLng').val())
      });

      $('#btnDirection').on('click', function(e) {
        let params = '',
          origin = $('#dirOrigin'),
          destination = $('#dirDestination'),
          travel = $('#dirTravel');

        if (origin.val() != '') {
          params += `origin=${origin.val()}&`;
        }

        params += `destination=${destination.val()}&`;

        switch (travel.val()) {
          case '1': // jalan kaki
            params += `travelmode=walking`;
            break;
          case '2': // sepeda
            params += `travelmode=bicycling`;
            break;
          case '3': // motor
            params += `travelmode=motorcycling`;
            break;
          case '4': // mobil
            params += `travelmode=driving`;
            break;
        }

        // mapUrl.dirApi('comgooglemapsurl://https://www.google.com/maps/dir/?api=1&origin=-6.3233247,106.8188964&destination=-6.2450937,106.8643857&travelmode=driving');
        // mapUrl.dirApi('https://www.google.com/maps/dir/?api=1&destination=Stasiun+Lenteng+Agung&travelmode=driving');
        // mapUrl.dirApi('https://maps.google.com/?saddr=Signature+Park+Grande&daddr=Lenteng+Agung'); // not work
        mapsUrl.dirApi(params);
      });

    });
  </script>
</body>

</html>