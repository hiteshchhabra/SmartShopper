<?php
	
$originLat = $_GET['originLat'];
$originLong = $_GET['originLong'];
$destLat = $_GET['destLat'];
$destLong = $_GET['destLong'];
$price = $_GET['price'];
$donation = $_GET['donation'];


?>

<html>
  <head>
               <link rel="stylesheet" href="css/bootstrap.css"> </link>
               <link rel="stylesheet" href="css/style.css"> </link>
  </head>
    <script type="text/javascript"
      src="http://maps.googleapis.com/maps/api/js?sensor=true">
    </script>
     <script type="text/javascript" src="js/jquery-1.9.0.min.js"></script>
    <script type="text/javascript">

var map;
var mapOptions;
//var originLat = <?= $_GET['originLat'] ?>;


var originLat = <?php echo $originLat; ?>;
var originLong = <?php echo $originLong; ?>;
var destLat = <?php echo $destLat; ?>;
var destLong = <?php echo $destLong; ?>;
var mapCenter;
var options;
var origin1 = "Georgia Tech";
var destination1 = "Klaus Computing";

var price=<?php echo $price; ?>;
var donation=<?php echo $donation; ?>;

function initialize(){

  if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(displayOnMap);
  }
 
}


function displayOnMap(){

  
   options = new Array();
      options[0] = google.maps.DirectionsTravelMode.DRIVING;
      options[1] = google.maps.DirectionsTravelMode.TRANSIT;
      options[2] = google.maps.DirectionsTravelMode.BICYCLING;
      options[3] = google.maps.DirectionsTravelMode.WALKING;
  //alert(latitude+" " +longitude);
  mapCenter = new google.maps.LatLng(originLat, originLong);
   mapOptions = {
          center: mapCenter,
          zoom: 12,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById("map_canvas"),
            mapOptions);

        //var marker, i;

     
      new google.maps.Marker({
        position: new google.maps.LatLng(originLat, originLong),
        map: map,
        title: "Your location"
         });

      var geocoder = new google.maps.Geocoder();
     geocoder.geocode({'latLng': mapCenter}, function(results, status) {

    if (status == google.maps.GeocoderStatus.OK) {
      
      if (results[1]) {
        
          origin1 = results[1].formatted_address;

        }
    }
  });

     var destLatLng = new google.maps.LatLng(destLat, destLong);
     geocoder.geocode({'latLng': destLatLng}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      if (results[1]) {
         
          destination1 = results[1].formatted_address;
        }
    }
  });
       /*google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent("");
          infowindow.open(map, marker);
        }
      })(marker, i));*/
      
      loadPath(0);
    }
    

    /*function loadResults(){
      //alert("hi");
      //alert(map);
      var results = new Array();
    results[0]={ text1:"test1",lat:latitude+0.05,longt:longitude+0.12 };
    results[1]={ text1:"test2",lat:latitude-0.05,longt:longitude-0.12 };
    //results[2]={ name:"test3",lat:"224.456",longt:"223.67" };
/*
   map = new google.maps.Map(document.getElementById("map_canvas"),
    mapOptions);*/
    //alert(results);
    //alert(map);
      /*for(var i=0;i<results.length;i++){
        //alert(results[i].lat + " ,"+ results[i].longt + " ," +results[i].text1);
        new google.maps.Marker({
          position: new google.maps.LatLng(results[i].lat, results[i].longt),
          map: map,
          title:results[i].text1
        });
        //alert(marker1);
      }*/

    

    function loadPath(modeOption){
      //alert(modeOption);
      var directions = new google.maps.DirectionsService();
      var renderer = new google.maps.DirectionsRenderer();
      var transitLayer;
      var mode = options[modeOption];
      //alert(mode);

      transitLayer = new google.maps.TransitLayer();

      /*var control = document.getElementById('transit-wpr');
        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(control);*/

        /*google.maps.event.addDomListener(control, 'click', function() {
          transitLayer.setMap(transitLayer.getMap() ? null : map);
        });*/
      


       var now = new Date();
       var tzOffset = (now.getTimezoneOffset() + 60) * 60 * 1000;
        var ms = new Date().getTime() - tzOffset;
        if (ms < now.getTime()) {
          ms += 24 * 60 * 60 * 1000;
        }
        
        var departure = new Date(ms);
         map = new google.maps.Map(document.getElementById("map_canvas"),
            mapOptions);
       var request = {
          origin: origin1,
          destination: destination1,
          travelMode: mode,
          provideRouteAlternatives: true,
          transitOptions: {
            departureTime: departure
          }
        };


        var panel = document.getElementById('panel');
        panel.innerHTML = '';
        directions.route(request, function(response, status) {
          if (status == google.maps.DirectionsStatus.OK) {
            renderer.setDirections(response);
            var distance = 0.0;
           
            $.each(response.routes[0].legs,function(index,value){
              distance += parseFloat(value.distance.text);
              
            });
            calculatePoint(distance,modeOption);

            renderer.setMap(map);
            renderer.setPanel(panel);

          } else {
            renderer.setMap(null);
            renderer.setPanel(null);
          }
        });

        //transitLayer.setMap(transitLayer.getMap() ? null : map);
    }


    function calculatePoint(distance, mode){
      var url = "point_calculation.php?distance="+distance+"&mode="+mode+"&price="+price+"&donation="+donation;
      $.ajax({
        url:url,
        success: function(resp){
          document.getElementById("points").innerHTML = "Points earned: "+resp;
        }
      });
    }
    </script>
 
  <body onload="displayOnMap()">
  	
   <div class="navbar-inverse">  
  
      <div class="navbar-inner lead"> <img src="shoppingcart_icon.png" height=50 width=50></img><span style="padding: 1px;font-family: Georgia; font-size: 36px;  color: #EEE"> <b>Smart Shopper</b></span> &nbsp; &nbsp; <span style="font-family: Goergia; font-size: 24px; color: #EEE"> ~ shopping has a whole new meaning ... </span></div>
  </div>

 <div class="container2">
    <div id="map_canvas" style="width: 800px; height: 500px; float: left;"></div>
   
   

    <div id="points">

    </div>



    

    <div id="panel" style=" padding: 10px; width: 450px; height: 400px; float: right;"></div>


  
</div>

 <div id="options" >
      <img  width="40" height="40" id="img1" src="walking.png" alt="Walking" onClick="loadPath(3)" />
      <img  width="40" height="40" id="img2" src="bicycle.png" alt="Bicycle" onClick="loadPath(2)" />
      <img  width="40" height="40" id="img3" src="transit.png" alt="Public Transit" onClick="loadPath(1)"/>
      <img  width="40" height="40" id="img4" src="car.png" alt="Car" onClick="loadPath(0)" />
   </div> 
    
  </body>

  </html>