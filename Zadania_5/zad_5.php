<?php
$dozwolone_adresy_ip = array('127.0.0.1', '192.168.0.1');
$adres_ip = $_SERVER['REMOTE_ADDR'];
if (in_array($adres_ip, $dozwolone_adresy_ip)) {
    include 'strona_dla_dozwolonych.php';
} else {
    include 'strona_dla_pozostalych.php';
}
?>
