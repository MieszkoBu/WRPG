<?php
session_start();
try {
    $pdo = new PDO("mysql:host=localhost;dbname=moja_baza", 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Błąd połączenia z bazą danych: " . $e->getMessage());
}
function displayCars()
{
    global $pdo;

    $stmt = $pdo->prepare("SELECT * FROM samochody");
    $stmt->execute();
    $cars = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($cars) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Marka</th><th>Model</th><th>Cena</th></tr>";
        foreach ($cars as $car) {
            echo "<tr>";
            echo "<td>" . $car['id_samochod'] . "</td>";
            echo "<td>" . $car['marka'] . "</td>";
            echo "<td>" . $car['model'] . "</td>";
            echo "<td>" . $car['cena'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Brak samochodów do wyświetlenia.";
    }
}
?>
<a href="index.php">Strona główna</a>
<a href="dodajsamochod.php">Dodaj samochód</a>
<?php
if (isset($_SESSION['user_id'])) {
    echo '<a href="mojesamochody.php">Moje samochody</a>';
}
?>
<h2>Lista wszystkich samochodów:</h2>
<?php
displayCars();
?>
