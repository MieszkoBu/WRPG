<?php
$plik = 'odnosniki.txt';

if (file_exists($plik)) {
    $linie = file($plik);
    $odnosniki = array();
    foreach ($linie as $linia) {
        $czesci = explode(';', $linia);
        $adres = trim($czesci[0]);
        $opis = trim($czesci[1]);
        $odnosniki[] = '<a href="' . $adres . '">' . $opis . '</a>';
    }
    foreach ($odnosniki as $odnosnik) {
        echo '<li>' . $odnosnik . '</li>';
    }
} else {
    echo 'Plik ' . $plik . ' nie istnieje.';
}
?>
