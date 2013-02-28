		var initialLocation;
		var latitude; 
		var longitude;
		var map;
		var marker, myOptions;
		var tags=[];
	    var text= "";
		var pid="";
		var pname = "";
		var price = 0.0;
		var destLat,destLong;
		var charitable;
		
		function determineLocation() {
					
					$("#search-text").val("");
										
					$("#search-text").keyup(function(){
						text = $("#search-text").val();
						autofill();
					});
					
				$("#search-text").autocomplete({
					source: tags
					});
									
					
					$( "#search-text" ).on( "autocompleteselect", function( event, ui ) {
							//alert(ui.item.value);
							pid = ui.item.value.split(">")[1];
							pname = ui.item.value.split(">")[0];
							price = ui.item.value.split(">")[2];
							handleData();
					});
					
					
					
					
					
				if (navigator.geolocation) {
					navigator.geolocation.getCurrentPosition(displayOnMap);
					
					
				}
				else {
					// geolocation not supported on this browser
					alert("not supported!!");
				}
			}
			
			function autofill() {
			
			var url = "fetchProductData.php?q="+text+"&lat="+latitude+"&long="+longitude;
			
			
								$.ajax({
									
									dataType: "json",
									url: url,
									success: function(data) {
											
									
											//alert(typeof data);
											
											$.each(data.products, function(index,value){
													//alert('2');
													//alert(value.name);
													
													tags.push(value.name+'>'+value.product_id+'>'+value.min_price);
													
													//alert(tags);
											  });
											
									}
									
								});
			}
			
			
			function displayOnMap(position) {
			var infowindow = new google.maps.InfoWindow({content: ""});
			
				latitude = position.coords.latitude;
				longitude = position.coords.longitude;
			
				
			  //alert(latitude +" " +longitude);
				
				myOptions = {
					zoom: 12,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				};
				
				map = new google.maps.Map(document.getElementById("map-content"),myOptions);
				
				initialLocation = new google.maps.LatLng(latitude, longitude);

				
				marker = new google.maps.Marker({
					position: initialLocation,
					map: map,
					title: "You are here",
					icon: "marker.png"	
				});
				
				
				map.setCenter(initialLocation);
				
					   google.maps.event.addListener(marker, 'click', function() {
						 infowindow.setContent(this.title);
						 infowindow.open(map,this);  
					  });
			}
			
/*			function textsearch(results){
			 
				
				
					var text = document.getElementById('search-text').value;
					
					alert(text);
					
					var request = {
									location: initialLocation,
									radius: '500',
									query:  text
							  };
							  
				 var service = new google.maps.places.PlacesService(map);
				 service.textSearch(request, callback);
			}
		
		   function callback(results, status) {
		   
		   	  
				  
				if (status == google.maps.places.PlacesServiceStatus.OK) {
				  
				 var infowindow = new google.maps.InfoWindow({content: ""});
					var temp,i;
					
					for (i = 0; i < results.length; i++) {
						var place = results[i];
							
							
						temp = new google.maps.Marker({
							position: place.geometry.location,
							map: map,
							title: place.name
						});
						
						google.maps.event.addListener(temp, 'click', function(i) {
						
									infowindow.setContent(place.name);
									infowindow.open(map,this);
							
						});
					}
				  		
				
				    map.setCenter(initialLocation);
				 }
			}
	*/

	
			function handleData(){
			
				var url = "fetchData.php?";
		
				//var text = $('#search-text').val();
				
				/*var checked = ($('#chkdonation').is(':checked')=== true) ? 1 : 0;
				var radius = document.getElementById('rvalue').innerHTML;
				//alert(text + " , " + checked);
				*/
				
				url += 'q='+pid+'&lat='+latitude+'&long='+longitude;
					
				//alert(url);
				
				$.ajax({
					dataType: "json",
					url:  url,
					success: function(data){  updateMap(data); }
				
				});
			
			}
			
			function updateMap(result){
			
		
			var product = $('#prod');
			var pricespan = $('#price');
			
			product.html("<b>"+pname+"</b></br>");
			
			var hr = $('<hr>');
			
			hr.appendTo(product);
			
			pricespan.html("Price:  <b> $" +price/100+"</b>");
			
			var infowindow = new google.maps.InfoWindow({content: ""});
			var temp,i;
			   console.log(result);
			   $.each(result, function(index, value){
			   					
					
					var string = "<b>"+value.merchant_name + "</b> - " + value.street + "<br />";
					string += "<button id=\"go\""+index+" onclick=\" sendTo(); \"> Go! </button>";
							
							
						temp = new google.maps.Marker({
							position: new google.maps.LatLng(value.latitude,value.longitude),
							map: map,
							title: value.merchant_name,
							icon:  (value.charitable===1) ? 'marker_green.png' : ''
						});
						
						google.maps.event.addListener(temp, 'click', function(i) {
						
									infowindow.setContent(string);
									infowindow.open(map,this);
									//alert(this.position);
									destLat = value.latitude;
									destLong = value.longitude;
									charitable = value.charitable;
							
						});
						
						/*google.maps.event.addListener(temp, 'mouseover', function(i) {
						
									products.html(string);
								
							
						}); */
						
					});
				  		
				    map.setOptions({zoom: 10});
				    map.setCenter(initialLocation);
				
			
			}
			
			function sendTo(){
			
				var url = "home.php?";
		
				//var text = $('#search-text').val();
				
				/*var checked = ($('#chkdonation').is(':checked')=== true) ? 1 : 0;
				var radius = document.getElementById('rvalue').innerHTML;
				//alert(text + " , " + checked);
				*/
				
				url += 'originLat='+latitude+'&originLong='+longitude+'&destLat='+destLat+'&destLong='+destLong+'&price='+price/100+'&donation='+charitable;
					
				//alert(url);
				
				$.ajax({
					
					url:  url,
					success: function(){  window.location = url; }
				
				});
			
			}