$url = 'https://raw.githubusercontent.com/ippscan/ippscanTEAM/main/Montervpn';

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$getList = curl_exec($ch);

if (curl_errno($ch)) {
    die('Unable to fetch content from the URL: ' . curl_error($ch));
}

curl_close($ch);

$strings = explode("\n", $getList);

$warp = "//profile-title: base64:V0FSUCAoM1lFRPCfkqUp\n";
$warp .= "//profile-update-interval: 24\n";
$warp .= "//subscription-userinfo: upload=0; download=0; total=10737418240000000; expire=0\n";
$warp .= "//support-url: https://github.com/3yed821\n";
$warp .= "//profile-web-page-url: https://github.com/3yed82\n\n";


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
