<?php

namespace App\Http\Controllers;
error_reporting(E_ALL ^ E_DEPRECATED);

use App\Models\Home;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use proxycheck\proxycheck;

class HomeController extends Controller
{
    public function index()
    {
        return view('main');
    }

    public function addForm(Request $request)
    {
        $checkOptions = [
            'API_KEY' => '42886w-68b734-i3s0bw-839128', // Your API Key.
            'ASN_DATA' => 1, // Enable ASN data response.
            'VPN_DETECTION' => 0, // Check for both VPN's and Proxies instead of just Proxies.
            'RISK_DATA' => 0, // 0 = Off, 1 = Risk Score (0-100), 2 = Risk Score & Attack History.
            'INF_ENGINE' => 0, // Enable or disable the real-time inference engine.
            'TLS_SECURITY' => 0, // Enable or disable transport security (TLS).
            'QUERY_TAGGING' => 0, // Enable or disable query tagging.
        ];
        $ipList = $request->get('proxy');

        if (empty($ipList) && strlen($ipList) == 0) {
            return view('main', [
                'error' => 'Please filed textarea'
            ]);
        }

        $checkedIp = [
            'notPassTest' => 0,
            'passTest' => 0,
            'notIp' => 0
        ];

        $ipArray = explode("\n", $ipList);
        foreach ($ipArray as $ip) {
            $regExpCheck = (bool)filter_var(trim($ip), FILTER_VALIDATE_IP);;
            $isProxy = proxycheck::check($ip, $checkOptions);

            if (!$regExpCheck) {
                $checkedIp['notIp'] += 1;
                continue;
            }
            $start = microtime(true);

            if ($isProxy['block'] != 'yes') {
                $checkedIp['notPassTest'] += 1;
                continue;
            }

            $proxyData = $isProxy[array_keys($isProxy)[2]];
            $port = isset($proxyData['port']) ? ':' . $proxyData['port'] : '';
            $checkTime = round(microtime(true) - $start, 2);

            $insertData = [
                'ip_port' => $ip . $port,
                'proxy_type' => $proxyData['type'] ?? 'undefined',
                'location' => $proxyData['country'] ?? 'undefined',
                'check_time' => $checkTime,
                'ip' => $ip,
                'created_at' => DB::raw('now()')
            ];

            Home::insert($insertData);

            unset($insertData['created_at']);
            $checkedIp['checkedIps'] = $insertData;
            $checkedIp['passTest'] += 1;
        }

        return view('main', [
            'result' => $checkedIp
        ]);
    }
}
