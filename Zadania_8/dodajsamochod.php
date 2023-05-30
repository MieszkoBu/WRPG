<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    die("Brak autoryzacji do wykonania tej operacji.");
}

try {
    $pdo = new PDO("mysql:host=localhost;dbname=moja_baza", 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Błąd połączenia z bazą danych: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_uzytkownik = $_SESSION['user_id'];
    addCar($id_uzytkownik);
    header("Location: mojesamochody.php");
    exit();
}

function addCar($userId)
{
    global $pdo;

    $marka = $_POST['marka'];
    $model = $_POST['model'];
    $cena = $_POST['cena'];
    $rok = $_POST['rok'];
    $opis = $_POST['opis'];

    $stmt = $pdo->prepare("INSERT INTO samochody (id_uzytkownik, marka, model, cena, rok, opis) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$userId, $marka, $model, $cena, $rok, $opis]);
    echo "Samochód został dodany pomyślnie!";
}
?>
<a href="index.php">Strona główna</a>
<a href="wszystkiesamochody.php">Wszystkie samochody</a>
<?php
if (isset($_SESSION['user_id'])) {
    echo '<a href="mojesamochody.php">Moje samochody</a>';
}
?>
<form method="POST" action="">
    <label>Marka:</label>
    <input type="text" name="marka" required><br>
    <label>Model:</label>
    <input type="text" name="model" required><br>
    <label>Cena:</label>
    <input type="number" name="cena" required><br>
    <label>Rok:</label>
    <input type="number" name="rok" required><br>
    <label>Opis:</label>
    <textarea name="opis" required></textarea><br>
    <input type="submit" value="Dodaj samochód">
</form>
