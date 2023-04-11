<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
<?php
if (isset($_FILES['plik']['name'])) {
    $plik = $_FILES['plik']['tmp_name'];
    $nazwa_pliku = $_FILES['plik']['name'];
    $linie = file($plik);
    $odwrocona_tablica = array_reverse($linie);
    $nowy_plik = tmpfile();
    foreach ($odwrocona_tablica as $linia) {
        fwrite($nowy_plik, $linia);
    }
    rewind($nowy_plik);
    $zawartosc = stream_get_contents($nowy_plik);
    fclose($nowy_plik);
    file_put_contents('nowy_'.$nazwa_pliku, $zawartosc);
    echo 'Plik został odwrócony. <a href="nowy_'.$nazwa_pliku.'">Pobierz</a>';
}
?>
<form method="post" enctype="multipart/form-data">
  <input type="file" name="plik">
  <input type="submit" value="Odwróć kolejność">
</form>
</body>
</html>
