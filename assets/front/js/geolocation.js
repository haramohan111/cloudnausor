
function getLocation() {
	alert("ih");
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    alert("Geolocation is not supported by this browser.");
  }
}

function showPosition(position) {
   "Latitude: " + position.coords.latitude + 
  "<br>Longitude: " + position.coords.longitude;
  alert(position.coords.longitude)
}
