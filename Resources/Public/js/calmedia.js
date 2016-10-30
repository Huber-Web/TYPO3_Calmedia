function calOpenOverlay(title, date, url, location){
	if(url == undefined) url = null;
	if(location == undefined) location = null;
	var element = document.getElementById("calMedia--overlay");
	var titleEl = document.getElementById("calMedia--overlay-title");
	var dateEl = document.getElementById("calMedia--overlay-date");
	var locEl = document.getElementById("calMedia--overlay-location");
	var urlEl = document.getElementById("calMedia--overlay-url");
	if(location){
		locEl.innerHTML = 'Ort: ' + location;
		locEl.style.display = 'block';
	}else{
		locEl.style.display = 'none';
	}
	titleEl.innerHTML = title;
	dateEl.innerHTML = date;
	urlEl.innerHTML = url;
	element.style.display = 'block';
}

function calHoldOverlay(){
	document.getElementById("calMedia--overlay").style.display = 'block';
}

function calCloseOverlay(){
	document.getElementById("calMedia--overlay").style.display = 'none';
}

function calClickOverlay(){
	var url = document.getElementById("calMedia--overlay-url").innerHTML;
	url = url.replace(/&amp;/g, "&");
	window.open(decodeURI(url), '_self');
}

function calColExt(id, def){
	var element = document.getElementById(id);
	if((!element.style.display && def == 'none') || element.style.display == 'none'){
		element.style.display = 'block';
	}else{
		element.style.display = 'none';
	}
}

function initMap(){
	var map = new google.maps.Map(document.getElementById('map'), {
		zoom: 16,
		styles: [{
		      featureType: 'poi',
		      stylers: [{ visibility: 'off' }]  // Turn off points of interest.
		    },{
		      featureType: 'transit.station',
		      stylers: [{ visibility: 'off' }]  // Turn off points of interest.
		    }]
	});
	var geocoder = new google.maps.Geocoder();
	geocoder.geocode( {address: homeAddress}, function(results, status){
		if(status == google.maps.GeocoderStatus.OK){
			var homeInfo = new google.maps.InfoWindow({
				content: '<h3>' + homeTitle + '</h3><br/>'+
					'<p>' + results[0].formatted_address.replace(/,/g,'<br/>') + '</p>' +
					'<p><a href="https://www.google.at/maps?daddr=' + results[0].formatted_address + '" target="_blank">' + transLink + '</a></p>'
			});
			var homeMarker = new google.maps.Marker({
				map: map,
				position: results[0].geometry.location
			});
			homeMarker.addListener('click', function(){
				homeInfo.open(map, homeMarker);
			});
		}
	});
	geocoder.geocode( {address: dateAddress}, function(results, status){
		if(status == google.maps.GeocoderStatus.OK){
			var locInfo = new google.maps.InfoWindow({
				content: '<h3>' + dateLocation + '</h3>' +
					'<p>' + results[0].formatted_address.replace(/,/g,'<br/>') + '</p>' +
					'<p><a href="https://www.google.at/maps?daddr=' + results[0].formatted_address + '" target="_blank">' + transLink + '</a></p>'
			});
			map.setCenter(results[0].geometry.location);
			var locMarker = new google.maps.Marker({
				map: map,
				position: results[0].geometry.location
			});
			locMarker.addListener('click', function(){
				locInfo.open(map, locMarker);
			});
		}
	});
	
}