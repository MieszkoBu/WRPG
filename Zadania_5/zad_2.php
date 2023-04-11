<?php
$plik = 'licznik.txt';

if (file_exists($plik)) {
    $liczba_odwiedzin = (int) file_get_contents($plik);
    $liczba_odwiedzin++;
    file_put_contents($plik, $liczba_odwiedzin);
} else {
    $liczba_odwiedzin = 1;
    file_put_contents($plik, $liczba_odwiedzin);
}
echo "Liczba odwiedzin: " . $liczba_odwiedzin;
?>
