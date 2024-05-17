<?php

require 'vendor/autoload.php';

use GeoIp2\Database\Reader;

$reader = new Reader('/usr/share/GeoIP/GeoLite2-Country.mmdb');


$visitorIp = $_SERVER['REMOTE_ADDR'];

$record = $reader->country($visitorIp);

// Beispiel: Holen Sie sich die ASN-Informationen für eine IP-Adresse
/*
$record = $reader->asn($visitorIp);

echo 'ASN: ' . $record->autonomousSystemNumber . "\n";
echo 'Organisation: ' . $record->autonomousSystemOrganization . "\n";

echo "<br><br>";*/
var_dump($record);
echo "<br><br>";
echo 'ISO Code: ' . $record->country->isoCode . "\n";


/*
require_once 'vendor/autoload.php'; // Pfade und Abhängigkeiten anpassen

use GeoIp2\Database\Reader;

// Pfad zur GeoIP2-Datenbank
$databaseFile = 'GeoLite2-ASN.mmdb';

// IP-Adresse des Besuchers erfassen
$visitorIp = $_SERVER['REMOTE_ADDR'];

// Herkunftsland bestimmen
$reader = new Reader($databaseFile);
$record = $reader->country($visitorIp);
$countryCode = $record->country->isoCode;

/*
include("config.php");

// Weiterleitung durchführen
if (isset($redirectUrls[$countryCode])) {
    $redirectUrl = $redirectUrls[$countryCode];
} else {
    $redirectUrl = $defaultRedirectUrl;
}

// URL-Parameter übernehmen
if ($_SERVER['QUERY_STRING']) {
    $redirectUrl .= '?' . $_SERVER['QUERY_STRING'];
}

header("Location: $redirectUrl");
exit();


var_dump($countryCode);

echo "<br><br><br>Record:<br>";

var_dump($record);
*/
?>

