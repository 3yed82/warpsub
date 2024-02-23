<?php

$getList = file_get_contents('https://raw.githubusercontent.com/ippscan/ippscanTEAM/main/gulagVPN');
$jsonData = json_decode($getList, true);

// Initialize the configuration
$warp = "//profile-title: base64:V0FSUCAoM1lFRPCfkqUp\n";
$warp .= "//profile-update-interval: 24\n";
$warp .= "//subscription-userinfo: upload=0; download=0; total=10737418240000000; expire=0\n";
$warp .= "//support-url: https://github.com/3yed-61\n";
$warp .= "//profile-web-page-url: https://github.com/3yed-61\n\n";

// Loop through the inbounds section
foreach ($jsonData['inbounds'] as $inbound) {
    $warp .= json_encode($inbound, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . "\n";
}

// Loop through the outbounds section
foreach ($jsonData['outbounds'] as $outbound) {
    $warp .= json_encode($outbound, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . "\n";
}

// Loop through the route section
$warp .= json_encode($jsonData['route'], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . "\n";

file_put_contents("export/warp", $warp);
