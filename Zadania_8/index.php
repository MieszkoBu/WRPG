<?php
session_start();
try {
    $pdo = new PDO("mysql:host=localhost;dbname=moja_baza", 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Błąd połączenia z bazą danych: " . $e->getMessage());
}

function registerUser($login, $haslo)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM uzytkownik WHERE login = ?");
    $stmt->execute([$login]);
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        echo "Podany login już istnieje. Wybierz inny login.";
        return;
    }

    $hashedPassword = password_hash($haslo, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO uzytkownik (login, haslo, id_rola) VALUES (?, ?, 1)");
    $stmt->execute([$login, $hashedPassword]);
}

function loginUser($login, $haslo)
{
    global $pdo;

    $stmt = $pdo->prepare("SELECT * FROM uzytkownik WHERE login = ?");
    $stmt->execute([$login]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($haslo, $user['haslo'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['id_rola'];
        header("Location: mojesamochody.php");
        exit();
    } else {
        echo "Błędny login lub hasło.";
    }
}

function displayCars()
{
    global $pdo;

    $stmt = $pdo->prepare("SELECT * FROM samochody ORDER BY cena ASC LIMIT 5");
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

function logoutUser()
{
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}

function checkAuthentication($role)
{
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] != $role) {
        die("Brak autoryzacji do wykonania tej operacji.");
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $login = $_POST['login'];
    $haslo = $_POST['haslo'];

    registerUser($login, $haslo);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_login'])) {
    $login = $_POST['login'];
    $haslo = $_POST['haslo'];

    loginUser($login, $haslo);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
    logoutUser();
}

?>

<form method="POST" action="">
    <label>Login:</label>
    <input type="text" name="login" required><br>
    <label>Hasło:</label>
    <input type="password" name="haslo" required><br>
    <input type="submit" name="register" value="Zarejestruj">
</form>

<form method="POST" action="">
    <label>Login:</label>
    <input type="text" name="login" required><br>
    <label>Hasło:</label>
    <input type="password" name="haslo" required><br>
    <input type="submit" name="submit_login" value="Zaloguj">
</form>

<form method="POST" action="">
    <input type="submit" name="logout" value="Wyloguj">
</form>
<a href="dodajsamochod.php">Dodaj samochód</a>
<a href="wszystkiesamochody.php">Wszystkie samochody</a>
<?php
if (isset($_SESSION['user_id'])) {
    echo '<a href="mojesamochody.php">Moje samochody</a>';
}
?>
<h2>Lista wszystkich samochodów posortowana według rocznika:</h2>
<?php
displayCars();
?>
