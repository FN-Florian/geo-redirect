<?php
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
*/

var_dump($countryCode);

echo "<br><br><br>Record:<br>";

var_dump($record);
?>
