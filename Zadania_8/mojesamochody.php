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
    if (isset($_POST['edit'])) {
        $carId = $_POST['car_id'];
        $userId = $_SESSION['user_id'];
        if (checkCarOwnership($carId, $userId)) {
            editCar($carId);
            header("Location: mojesamochody.php");
            exit();
        } else {
            die("Brak autoryzacji do wykonania tej operacji.");
        }
    }
}

function checkCarOwnership($carId, $userId)
{
    global $pdo;

    $stmt = $pdo->prepare("SELECT COUNT(*) FROM samochody WHERE id_samochod = ? AND id_uzytkownik = ?");
    $stmt->execute([$carId, $userId]);
    $count = $stmt->fetchColumn();

    return $count > 0;
}

function editCar($carId)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM samochody WHERE id_samochod = ?");
    $stmt->execute([$carId]);
    $car = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($car) {
        $updatedBrand = $_POST['marka'];
        $updatedModel = $_POST['model'];
        $updatedPrice = $_POST['cena'];
        $updatedYear = $_POST['rok'];
        $updatedDescribe = $_POST['opis'];
        $stmt = $pdo->prepare("UPDATE samochody SET marka = ?, model = ?,cena = ?, rok = ?, opis = ? WHERE id_samochod = ?");
        $stmt->execute([$updatedBrand, $updatedModel, $updatedPrice, $updatedYear, $updatedDescribe, $carId]);

        echo "Samochód został pomyślnie zaktualizowany!";
    } else {
        echo "Nie znaleziono samochodu o podanym identyfikatorze.";
    }
}

$userId = $_SESSION['user_id'];
$cars = getCarsByUserId($userId);

function getCarsByUserId($userId)
{
    global $pdo;

    $stmt = $pdo->prepare("SELECT * FROM samochody WHERE id_uzytkownik = ?");
    $stmt->execute([$userId]);
    $cars = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $cars;
}
?>
<a href="index.php">Strona główna</a>
<a href="dodajsamochod.php">Dodaj samochód</a>
<a href="wszystkiesamochody.php">Wszystkie samochody</a>
<?php foreach ($cars as $car) : ?>
    <form method="POST" action="">
        <p>ID: <?php echo $car['id_samochod']; ?></p>
        <p>Marka: <?php echo $car['marka']; ?></p>
        <p>Model: <?php echo $car['model']; ?></p>
        <p>Cena: <?php echo $car['cena']; ?></p>
        <p>Rok: <?php echo $car['rok']; ?></p>
        <p>Opis: <?php echo $car['opis']; ?></p>
        <input type="hidden" name="car_id" value="<?php echo $car['id_samochod']; ?>">
        <label>Marka:</label>
        <input type="text" name="marka" value="<?php echo $car['marka']; ?>" required><br>
        <label>Model:</label>
        <input type="text" name="model" value="<?php echo $car['model']; ?>" required><br>
        <label>Cena:</label>
        <input type="number" name="cena" value="<?php echo $car['cena']; ?>" required><br>
        <label>Rok:</label>
        <input type="number" name="rok" value="<?php echo $car['rok']; ?>" required><br>
        <label>Opis:</label>
        <textarea name="opis" required><?php echo $car['opis']; ?></textarea><br>
        <input type="submit" name="edit" value="Edytuj samochód">
    </form>
<?php endforeach; ?>
