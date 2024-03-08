<?php

    $getList = file_get_contents('https://raw.githubusercontent.com/nameless4pub/warp-ip/main/warp.json?v1.'.time());
    $strings = explode("\n", $getList);

    title = "//profile-title: base64:" + base64.b64encode('3yed82⭐️'.encode('utf-8')).decode('utf-8') + "\n"
    update_interval = "//profile-update-interval: 1\n"
    sub_info = "//subscription-userinfo: upload=0; download=0; total=10737418240000000; expire=2546249531\n"
    profile_web = "//profile-web-page-url: https://github.com/3yed82\n"
    last_modified = "//last update on: " + warp_ip()[1] + "\n"

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
