<?php
// Zadanie 1.1
function kostka(){
    return rand(1,6) . "<br>";
}
echo kostka();
// Zadanie 1.2
function srednica($promien){
    return $promien*2;
}
echo srednica(5) . "<br>";
// Zadanie 1.3
function cenzura($zdanie, $niepozadane_slowa) {
    $slowawzdaniu = explode(" ", $zdanie);
    foreach($slowawzdaniu as &$slowo) {
      if(in_array($slowo, $niepozadane_slowa)) {
        $slowo = str_repeat("*", strlen($slowo));
      }
    }
    return implode(" ", $slowawzdaniu);
  }
  $zdanie = "dsada cenzura gs słowo asds dupa";
$niepozadane_slowa = array("słowo", "cenzura","dupa");

echo cenzura($zdanie, $niepozadane_slowa);

}
$slowa=array("dupa","aaaas","ffasda");
$zdanie = "dafags dupa gds, aaaas, dasfd, ffasda";
echo cenzura($zdanie);
// Zadanie 1.4
function data($pesel){
    $rok=substr($pesel,0,2);
    $miesiac=substr($pesel,2,2);
    $dzien=substr($pesel,4,2);
    $data=$dzien . "-" . $miesiac . "-" . $rok;
    return $data;
}
$pesel=123456789;
echo data($pesel) . "<br>";
// Zadanie 1.5
function oblicz_pole_trojkata($podstawa, $wysokosc) {
    return 0.5 * $podstawa * $wysokosc;
}

function oblicz_pole_prostokata($dlugosc, $szerokosc) {
    return $dlugosc * $szerokosc;
}

function oblicz_pole_trapezu($podstawa1, $podstawa2, $wysokosc) {
    return 0.5 * ($podstawa1 + $podstawa2) * $wysokosc;
}
echo "Wybierz figurę, dla której chcesz obliczyć pole:" . "<br>";
echo "1. Trójkąt" . "<br>";
echo "2. Prostokąt" . "<br>";
echo "3. Trapez" . "<br>";
$wybor = "2";
switch ($wybor) {
    case 1:
        echo "Podaj długość podstawy trójkąta: " . "<br>";
        $podstawa = 4;
        echo "Podaj wysokość trójkąta: " . "<br>";
        $wysokosc = 3;
        $pole = oblicz_pole_trojkata($podstawa, $wysokosc);
        echo "Pole trójkąta wynosi: " . $pole;
        break;
    case 2:
        echo "Podaj długość boku a prostokąta: " . "<br>";
        $a = 6;
        echo "Podaj długość boku b prostokąta: " . "<br>";
        $b = 5;
        $pole = oblicz_pole_prostokata($a, $b);
        echo "Pole prostokąta wynosi: " . $pole;
        break;
    case 3:
        echo "Podaj długość pierwszej podstawy trapezu: " . "<br>";
        $podstawa1 = 3;
        echo "Podaj długość drugiej podstawy trapezu: " . "<br>";
        $podstawa2 = 4;
        echo "Podaj wysokość trapezu: ";
        $wysokosc = 6;
        $pole = oblicz_pole_trapezu($podstawa1, $podstawa2, $wysokosc);
        echo "Pole trapezu wynosi: " . $pole;
        break;
    default:
        echo "Nieprawidłowy wybór!";
        break;
}
?>
