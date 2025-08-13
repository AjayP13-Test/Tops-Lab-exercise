<?php
$city = "Ahmedabad"; // Change to any city
$apiKey = "YOUR_API_KEY"; // Replace with your OpenWeatherMap API key

// API endpoint
$url = "https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric";

// Make API request
$response = file_get_contents($url);

if ($response === FALSE) {
    die("Error fetching weather data.");
}

// Convert JSON to PHP array
$data = json_decode($response, true);

// Extract data
$temperature = $data['main']['temp'];
$description = $data['weather'][0]['description'];
$icon = $data['weather'][0]['icon'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Weather in <?php echo $city; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card p-4 shadow-sm">
        <h2 class="mb-3">Weather in <?php echo $city; ?></h2>
        <h4><?php echo $temperature; ?>°C</h4>
        <p class="text-capitalize"><?php echo $description; ?></p>
        <img src="https://openweathermap.org/img/wn/<?php echo $icon; ?>@2x.png" alt="Weather Icon">
    </div>
</div>
</body>
</html>
