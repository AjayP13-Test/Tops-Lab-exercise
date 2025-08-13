<?php
$weatherData = null;
$error = null;

if (isset($_POST['city'])) {
    $city = trim($_POST['city']);
    $apiKey = "YOUR_API_KEY"; // Replace with your API key

    $url = "https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric";

    $response = @file_get_contents($url);

    if ($response) {
        $data = json_decode($response, true);
        if ($data['cod'] == 200) {
            $weatherData = [
                "city" => $data['name'],
                "temperature" => $data['main']['temp'],
                "description" => $data['weather'][0]['description'],
                "icon" => $data['weather'][0]['icon'],
                "humidity" => $data['main']['humidity'],
                "wind_speed" => $data['wind']['speed']
            ];
        } else {
            $error = $data['message'];
        }
    } else {
        $error = "Unable to connect to weather service.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Weather Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container my-5">
    <h2 class="mb-4 text-center">Weather Dashboard</h2>

    <form method="POST" class="d-flex justify-content-center mb-4">
        <input type="text" name="city" class="form-control w-50" placeholder="Enter city name" required>
        <button type="submit" class="btn btn-primary ms-2">Get Weather</button>
    </form>

    <?php if ($error): ?>
        <div class="alert alert-danger text-center"><?= ucfirst($error) ?></div>
    <?php endif; ?>

    <?php if ($weatherData): ?>
        <div class="card mx-auto shadow-sm" style="max-width: 400px;">
            <div class="card-body text-center">
                <h4><?= $weatherData['city'] ?></h4>
                <img src="https://openweathermap.org/img/wn/<?= $weatherData['icon'] ?>@2x.png" alt="Weather icon">
                <h3><?= $weatherData['temperature'] ?>°C</h3>
                <p class="text-capitalize"><?= $weatherData['description'] ?></p>
                <p>💧 Humidity: <?= $weatherData['humidity'] ?>%</p>
                <p>💨 Wind: <?= $weatherData['wind_speed'] ?> m/s</p>
            </div>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
