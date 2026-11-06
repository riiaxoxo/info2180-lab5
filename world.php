<?php
$username = 'lab5_user';
$password = 'password123';

$conn = new PDO(
    'mysql:host=localhost;dbname=world;charset=utf8mb4',
    $username,
    $password
);

$country = isset($_GET['country']) ? $_GET['country'] : '';

$country = isset($_GET['country']) ? $_GET['country'] : '';
$lookup = isset($_GET['lookup']) ? $_GET['lookup'] : '';

if ($lookup === 'cities') {
    $sql = "SELECT cities.name, cities.district, cities.population
            FROM cities
            JOIN countries ON cities.country_code = countries.code
            WHERE countries.name LIKE ?";

    $stmt = $conn->prepare($sql);
    $stmt->execute(["%$country%"]);

    $cities = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($cities) > 0) {
        echo "<table border='1'>";
        echo "<tr><th>Name</th><th>District</th><th>Population</th></tr>";

        foreach ($cities as $city) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($city['name']) . "</td>";
            echo "<td>" . htmlspecialchars($city['district']) . "</td>";
            echo "<td>" . htmlspecialchars($city['population']) . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No cities found.";
    }

} else {
    $sql = "SELECT * FROM countries WHERE name LIKE ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute(["%$country%"]);

    $countries = $stmt->fetchAll(PDO::FETCH_ASSOC);


if (count($countries) > 0) {
    echo "<table border='1'>";

    echo "<tr>";
    echo "<th>Country Name</th>";
    echo "<th>Continent</th>";
    echo "<th>Independence Year</th>";
    echo "<th>Head of State</th>";
    echo "</tr>";

    foreach ($countries as $country) {
        echo "<tr>";

        echo "<td>" . htmlspecialchars($country['name']) . "</td>";
        echo "<td>" . htmlspecialchars($country['continent']) . "</td>";
        echo "<td>" . htmlspecialchars($country['independence_year'] ?? '') . "</td>";
        echo "<td>" . htmlspecialchars($country['head_of_state'] ?? '') . "</td>";

        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No countries found.";
}
}
?>
