<?php

// Weiterleitungen basierend auf dem Herkunftsland definieren
$redirectUrls = [
    'DE' => 'https://www.mcfit.com/checkout?validForm=false&ghostStudio=true&step=contract-selection',
    'US' => 'https://your-url-for-usa.com',
    // Weitere Ländercodes und URLs hinzufügen...
];

// Standard-URL für den Fall, dass das Land nicht erkannt wird
$defaultRedirectUrl = 'https://mcfit.com';


?>