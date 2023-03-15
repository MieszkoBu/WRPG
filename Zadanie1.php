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
function cenzura($zdanie){

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

?>
