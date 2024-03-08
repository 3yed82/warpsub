<?php

    $getList = file_get_contents('https://raw.githubusercontent.com/nameless4pub/warpsub/main/export/warp?v1.'.time());
    $strings = explode("\n", $getList);

    $warp = "//profile-title: base64:V0FSUHwzWUVE4q2Q77iP\n";
    $warp .= "//profile-update-interval: 24\n";
    $warp .= "//subscription-userinfo: upload=0; download=0; total=10737418240000000; expire=0\n";
    $warp .= "//profile-web-page-url: https://github.com/3yed82\n\n";
    $warp .= "warp://auto#🇮🇷 WARP &&detour=warp://auto#🇩🇪 WARP

    $i = 1;
    $pattern = '/^warp:\/\/.*$/';
    foreach ($strings as $val) {
    if ($i > 2) {
        break;
    }
    if (preg_match($pattern, $val) && !str_contains($val, '&&detour=')) {
        $warp .= "\n" . $val . '#Warp 🇮🇷 IP&&detour=' . $val . '#Warp 🇩🇪 IP';
        $i++;
    }
}
     file_put_contents("export/warp", $warp);
