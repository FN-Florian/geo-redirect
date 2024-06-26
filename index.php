<?php
error_reporting(0);

require 'vendor/autoload.php';

use GeoIp2\Database\Reader;

$reader = new Reader('/usr/share/GeoIP/GeoLite2-Country.mmdb');


$visitorIp = getClientIP();//$_SERVER['REMOTE_ADDR'];

$record = $reader->country($visitorIp);
$isocode = $record->country->isoCode;

if(isset($_GET['referralCode']))
{
    $referralCode = $_GET['referralCode'];
}
else
{
    $referralCode = "";
}

if(isset($_GET['lang']))
{
    $isocode = strtoupper($_GET['lang']);
}


// Default
$redirectUrl = "https://www.mcfit.com/checkout?validForm=false&ghostStudio=true&step=contract-selection";

if($isocode == "DE")
{
    $redirectUrl = "https://www.mcfit.com/checkout?validForm=false&ghostStudio=true&step=contract-selection";
}
elseif($isocode == "AT")
{
    $redirectUrl = "https://www.mcfit.com/at/checkout?validForm=false&ghostStudio=true&step=contract-selection";
}
elseif($isocode == "IT")
{
    $redirectUrl = "https://www.mcfit.com/it/checkout?validForm=false&ghostStudio=false&step=studio-selection";
}
elseif($isocode == "ES")
{
    $redirectUrl = "https://www.mcfit.com/es/checkout?validForm=false&ghostStudio=true&step=contract-selection";
}

if($referralCode != "")
{
    $redirectUrl = $redirectUrl."&referralCode=".$referralCode;
}


header("Location: $redirectUrl");

echo "
<meta http-equiv='refresh' content='0.0; URL=".$redirectUrl."'>
";



function getClientIP() {
    $ipaddress = '';

    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';

    return $ipaddress;
}

?>