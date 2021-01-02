@extends('layout/main')

@section('tittle','About Us')
@section('container')
<script>
    // Initialize and add the map
function initMap() {
// The location of Uluru
const uluru = { lat: -25.344, lng: 131.036 };
// The map, centered at Uluru
const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 4,
    center: uluru,
});
// The marker, positioned at Uluru
const marker = new google.maps.Marker({
    position: uluru,
    map: map,
});
}
</script>

<section class="container-fluid mt-5 mb-3">
    <div class="p-3 bg-white">
        About us
        <h1>My First Google Map</h1>

<div id="map" style="width:100%;height:400px;"></div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBIwzALxUPNbatRBj3Xi1Uhp0fFzwWNBkE&callback=initMap&libraries=&v=weekly"></script>
    </div>
</section>
@endsection