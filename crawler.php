<?php

    $getList = file_get_contents('https://raw.githubusercontent.com/ippscan/ippscanTEAM/main/gulagVPN?v1.'.time());
    $strings = explode("\n", $getList);

    $warp = "//profile-title: base64:V0FSUCAoM1lFRPCfkqUp\n";
    $warp .= "//profile-update-interval: 24\n";
    $warp .= "//subscription-userinfo: upload=0; download=0; total=10737418240000000; expire=0\n";
    $warp .= "//support-url: https://github.com/3yed82\n";
    $warp .= "//profile-web-page-url: https://github.com/3yed82\n\n";
    ${
  "log": {
    "level": "warn",
    "output": "box.log",
    "timestamp": true
  },
  "dns": {
    "servers": [
      {
        "tag": "dns-remote",
        "address": "https://dnslow.me/dns-query",
        "address_resolver": "dns-direct"
      },
      {
        "tag": "dns-trick-direct",
        "address": "https://sky.rethinkdns.com/",
        "detour": "direct-fragment"
      },
      {
        "tag": "dns-direct",
        "address": "https://dnslow.me/dns-query",
        "address_resolver": "dns-local",
        "detour": "direct"
      },
      {
        "tag": "dns-local",
        "address": "local",
        "detour": "direct"
      },
      {
        "tag": "dns-block",
        "address": "rcode://success"
      }
    ],
    "rules": [
      {
        "domain": "dnslow.me",
        "server": "dns-direct"
      },
      {
        "domain_suffix": ".ir",
        "geosite": "ir",
        "server": "dns-direct"
      },
      {
        "domain": "cp.cloudflare.com",
        "server": "dns-remote",
        "rewrite_ttl": 3000
      }
    ],
    "final": "dns-remote",
    "static_ips": {
      "sky.rethinkdns.com": [
        "172.67.204.84",
        "104.21.69.44",
        "2606:4700:3032::6815:452c",
        "2606:4700:3031::ac43:cc54",
        "104.18.203.232",
        "104.18.202.232",
        "172.64.172.4",
        "172.64.173.4",
        "2606:4700:e4::ac40:ad04",
        "2606:4700:e4::ac40:ac04"
      ]
    },
    "independent_cache": true
  },
  "inbounds": [
    {
      "type": "tun",
      "tag": "tun-in",
      "mtu": 9000,
      "inet4_address": "172.19.0.1/28",
      "inet6_address": "fdfe:dcba:9876::1/126",
      "auto_route": true,
      "strict_route": true,
      "endpoint_independent_nat": true,
      "sniff": true,
      "sniff_override_destination": true,
      "domain_strategy": "prefer_ipv4"
    },
    {
      "type": "mixed",
      "tag": "mixed-in",
      "listen": "127.0.0.1",
      "listen_port": 2334,
      "sniff": true,
      "sniff_override_destination": true,
      "domain_strategy": "prefer_ipv4"
    },
    {
      "type": "direct",
      "tag": "dns-in",
      "listen": "127.0.0.1",
      "listen_port": 6450,
      "override_address": "1.1.1.1",
      "override_port": 53
    }
  ],
  "outbounds": [
    {
      "type": "selector",
      "tag": "select",
      "outbounds": [
        "auto",
        "🇮🇷 WARP - Iran",
        "🇩🇪 WARP - Germany"
      ],
      "default": "auto"
    },
    {
      "type": "urltest",
      "tag": "auto",
      "outbounds": [
        "🇮🇷 WARP - Iran",
        "🇩🇪 WARP - Germany"
      ],
      "url": "http://cp.cloudflare.com/",
      "interval": "10m0s"
    },
    {
      "type": "wireguard",
      "tag": "🇮🇷 WARP - Iran",
      "local_address": [
        "172.16.0.2/32",
        "2606:4700:110:8c91:4063:21d0:7dd5:f218/128"
      ],
      "private_key": "AJ0si9MKGCtoC/NHwKc8G0MADbTPl/1M7KNWvM24W1g=",
      "server": "162.159.192.142",
      "server_port": 7103,
      "peer_public_key": "bmXOC+F1FxEMF9dyiK2H5/1SUtzH0JuVo51h2wPfgyo=",
      "reserved": "AAAA",
      "mtu": 1280,
      "fake_packets": "5-10",
      "fake_packets_size": "40-100",
      "fake_packets_delay": "20-250"
    },
    {
      "type": "wireguard",
      "tag": "🇩🇪 WARP - Germany",
      "detour": "🇮🇷 WARP - Iran",
      "local_address": [
        "172.16.0.2/32",
        "2606:4700:110:8c15:3f90:ad2d:8810:77f3/128"
      ],
      "private_key": "iKXZlb1y3GtpI6shoSD3OMaC3RWmvO1kebNJRHeOm14=",
      "server": "162.159.192.142",
      "server_port": 7103,
      "peer_public_key": "bmXOC+F1FxEMF9dyiK2H5/1SUtzH0JuVo51h2wPfgyo=",
      "reserved": "AAAA",
      "mtu": 1280,
      "fake_packets": "5-10",
      "fake_packets_size": "40-100",
      "fake_packets_delay": "20-250"
    },
    {
"type": "dns",
      "tag": "dns-out"
    },
    {
      "type": "direct",
      "tag": "direct"
    },
    {
      "type": "direct",
      "tag": "direct-fragment",
      "tls_fragment": {
        "enabled": true,
        "size": "5-10",
        "sleep": "1-5"
      }
    },
    {
      "type": "direct",
      "tag": "bypass"
    },
    {
      "type": "block",
      "tag": "block"
    }
  ],
  "route": {
    "geoip": {
      "path": "geo-assets/sagernet-sing-geoip-geoip.db"
    },
    "geosite": {
      "path": "geo-assets/sagernet-sing-geosite-geosite.db"
    },
    "rules": [
      {
        "inbound": "dns-in",
        "outbound": "dns-out"
      },
      {
        "port": 53,
        "outbound": "dns-out"
      },
      {
        "clash_mode": "Direct",
        "outbound": "direct"
      },
      {
        "clash_mode": "Global",
        "outbound": "select"
      },
      {
        "domain_suffix": ".ir",
        "geosite": "ir",
        "geoip": "ir",
        "outbound": "bypass"
      }
    ],
    "final": "select",
    "auto_detect_interface": true,
    "override_android_vpn": true
  },
  "experimental": {
    "cache_file": {
      "enabled": true,
      "path": "clash.db"
    },
    "clash_api": {
      "external_controller": "127.0.0.1:6756"
    }
  }
};

    $i = 1;
    $pattern = '/^warp:\/\/.*$/';
    foreach ($strings as $val) {
        if ( $i > 3) {
            break;
        }
        if (preg_match($pattern, $val) && !str_contains($val, '&&detour=')) {
            $warp .= "\n".str_replace(['🇮🇷', '🛡', '✔️', '⭐️', '✅'], '', $val);
            $i++;
        }
    }

    file_put_contents("export/warp", $warp);
