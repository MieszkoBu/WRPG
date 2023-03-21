<?php
//Zadanie 2.1
function losowa_tablica($indeks) {
    $tablica = range(0, 100);
    shuffle($tablica);
    $tablica = array_slice($tablica ,0,10);
    return $tablica[$indeks];
}
$indeks = 2;
echo losowa_tablica($indeks);
//Zadanie 2.2
function jaka_narodowosc($kraj) {
    global $kraje;
    if (isset($kraje[$kraj])) {
        return $kraje[$kraj];
    } else {
        return 'Nieznana narodowość dla kraju ' . $kraj;
    }
}
$kraje = array(
    'Polska' => 'Polak',
    'Niemcy' => 'Niemiec',
    'Francja' => 'Francuz',
    'Włochy' => 'Włoch',
    'Hiszpania' => 'Hiszpan',
    'Japonia' => 'Japończyk';
);

$kraj = 'Polska';
echo "Narodowość dla kraju $kraj to " . jaka_narodowosc($kraj);
?>
