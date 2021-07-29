<?php

namespace App\Http\Controllers;
error_reporting(E_ALL ^ E_DEPRECATED);

use App\Models\Home;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        return view('main');
    }

    public function addForm(Request $request)
    {
        $ipList = $request->get('proxy');
        // @todo  прокси лист сперва проверить на isset,чекнуть как лучше завадилировать textarea правильно
        // 1) валидация
        // 2) парсим строки
        // 3) доабвляю через форич в таблицу каждое прокси (есть дока в ларе способ попроще)

        $checkOptions = [
            'API_KEY' => '42886w-68b734-i3s0bw-839128', // Your API Key.
            'ASN_DATA' => 1, // Enable ASN data response.
            'VPN_DETECTION' => 0, // Check for both VPN's and Proxies instead of just Proxies.
            'RISK_DATA' => 0, // 0 = Off, 1 = Risk Score (0-100), 2 = Risk Score & Attack History.
            'INF_ENGINE' => 0, // Enable or disable the real-time inference engine.
            'TLS_SECURITY' => 0, // Enable or disable transport security (TLS).
            'QUERY_TAGGING' => 0, // Enable or disable query tagging.
            'CUSTOM_TAG' => 'test', // Specify a custom query tag instead of the default (Domain+Page).
        ];

        if (isset($ipList) && strlen($ipList) > 0) {
            $ipArray = explode("\n", $ipList);
            foreach ($ipArray as $ip) {
                $regExpCheck = preg_match("/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/", $ip);
                if ($regExpCheck) {
                    $start = microtime(true);

                    $isProxy = \proxycheck\proxycheck::check($ip, $checkOptions);
                    $proxyData = $isProxy[array_keys($isProxy)[2]];
                    if ($isProxy[array_keys($isProxy)[2]]['proxy'] === 'yes') {
                        $port = $proxyData['port'] ?? '';
                        $q = Home::insert([
                            'ip_port' => $ip . ':' . $port,
                            'proxy_type' => $proxyData['type'],
                            'location' => $proxyData['country'],
                            'timeout' => microtime(true) - $start,
                            'ip' => $ip,
                            'created_at' => DB::raw('now()'),

                        ]);
                    }
                }
            }
        }

        return view('main');
    }
}
