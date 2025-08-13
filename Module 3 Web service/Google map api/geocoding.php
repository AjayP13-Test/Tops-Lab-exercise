<?php
$locationData = null;
$error = null;

if (isset($_POST['address'])) {
    $address = urlencode($_POST['address']);
    $apiKey = "YOUR_API_KEY"; // Replace with your API key

    $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key={$apiKey}";

    $response = @file_get_contents($url);

    if ($response) {
        $data = json_decode($response, true);
        if ($data['status'] == 'OK') {
            $location = $data['results'][0]['geometry']['location'];
            $locationData = [
                'formatted_address' => $data['results'][0]['formatted_address'],
                'lat' => $location['lat'],
                'lng' => $location['lng']
            ];
        } else {
            $error = "No results found for the given address.";
        }
    } else {
        $error = "Unable to connect to Google Maps API.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Google Maps Geocoding</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY"></script>
</head>
<body class="bg-light">
<div class="container my-5">
    <h2 class="text-center mb-4">Google Maps Geocoding</h2>

    <form method="POST" class="d-flex justify-content-center mb-4">
        <input type="text" name="address" class="form-control w-50" placeholder="Enter an address" required>
        <button type="submit" class="btn btn-primary ms-2">Find Location</button>
    </form>

    <?php if ($error): ?>
        <div class="alert alert-danger text-center"><?= $error ?></div>
    <?php endif; ?>

    <?php if ($locationData): ?>
        <div class="card mx-auto shadow-sm p-3" style="max-width: 500px;">
            <h5>Address: <?= $locationData['formatted_address'] ?></h5>
            <p>Latitude: <?= $locationData['lat'] ?></p>
            <p>Longitude: <?= $locationData['lng'] ?></p>
        </div>

        <div id="map" class="mt-4" style="height: 400px;"></div>
        <script>
            function initMap() {
                var location = { lat: <?= $locationData['lat'] ?>, lng: <?= $locationData['lng'] ?> };
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 15,
                    center: location
                });
                new google.maps.Marker({
                    position: location,
                    map: map
                });
            }
            initMap();
        </script>
    <?php endif; ?>
</div>
</body>
</html>
