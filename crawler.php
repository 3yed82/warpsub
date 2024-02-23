<?php

$getList = @file_get_contents('https://raw.githubusercontent.com/ippscan/ippscanTEAM/main/Montervpn');

if ($getList === false) {
    die("مشکلی در بارگیری محتوا به وجود آمده است.");
}

$strings = explode("\n", $getList);

$warp = "//profile-title: base64:V0FSUCAoM1lFRPCfkqUp\n";
$warp .= "//profile-update-interval: 24\n";
$warp .= "//subscription-userinfo: upload=0; download=0; total=10737418240000000; expire=0\n";
$warp .= "//support-url: https://github.com/3yed821\n";
$warp .= "//profile-web-page-url: https://github.com/3yed82\n\n";
$warp .= "warp://auto#WarpInWarp ⭐️&&detour=warp://auto#Warp 🇮🇷";

$i = 1;
$pattern = '/^warp:\/\/.*$/';
foreach ($strings as $val) {
    if ($i > 3) {
        break;
    }
    if (preg_match($pattern, $val) && !str_contains($val, '&&detour=')) {
        $warp .= "\n" . str_replace(['🇮🇷', '🛡', '✔️', '⭐️', '✅'], '', $val);
        $i++;
    }
}

file_put_contents("export/warp", $warp);
