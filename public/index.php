<?php

require_once __DIR__ . '/../vendor/autoload.php';
use api\LocationIQClient;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $locationIQClient = new LocationIQClient();

    if (isset($_POST['address'])) {
        $address = $_POST['address'];
        $response = $locationIQClient->getAddressCoordinates($address);
        $result = json_decode($response, true);

        if (!empty($result)) {
            $latitude = $result[0]['lat'];
            $longitude = $result[0]['lon'];
            $resultMessage = "Координаты для адреса '{$address}': Широта: {$latitude}, Долгота: {$longitude}";
        } else {
            $resultMessage = "Не удалось получить координаты для адреса '{$address}'";
        }
    } elseif (isset($_POST['latitude']) && isset($_POST['longitude'])) {
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];
        $response = $locationIQClient->getCoordinatesAddress($latitude, $longitude);
        $result = json_decode($response, true);

        if (!empty($result)) {
            $resultMessage = "Адрес для координат ({$latitude}, {$longitude}): {$result['display_name']}";
        } else {
            $resultMessage = "Не удалось получить адрес для координат ({$latitude}, {$longitude})";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>LocationIQ API Client</title>
</head>
<body>

<div class="container">
    <h1>LocationIQ API Client</h1>
    
    <form method="post" action="index.php">
        <label for="address">Введите адрес:</label>
        <input type="text" name="address" id="address" required>
        <button type="submit">Найти координаты</button>
    </form>

    <form method="post" action="index.php">
        <label for="latitude">Введите широту:</label>
        <input type="text" name="latitude" id="latitude" required>
        <label for="longitude">Введите долготу:</label>
        <input type="text" name="longitude" id="longitude" required>
        <button type="submit">Найти адрес</button>
    </form>

    <?php if (isset($resultMessage)): ?>
        <div class="result">
            <p><?php echo $resultMessage; ?></p>
        </div>
    <?php endif; ?>
</div>

</body>
</html>