<?php

namespace App\Http\Controllers;

use App\Models\Home;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $string = '103.86.49.193:3128
                    177.33.218.127:3129
                    103.52.145.97:8080
                    103.47.67.10:8080
                    103.98.131.194:8081
                    45.184.128.201:8181';

        // не уверен, что  это подходит звучит как временное решение
//        $pattern = "(\d+\.\d+\.\d+\.\d+:\d+)";
//        $proxyArray = explode("\n", $string);
//        foreach ($proxyArray as $proxy) {
//            $isProxy = preg_match($pattern, $proxy);
//            if ($isProxy) {
//                dd(explode("\n", $proxy));
//            }
//        }
        return view('main');
    }

    public function addForm(Request $request)
    {
        $proxyList = $request->get('proxy');
        // @todo  прокси лист сперва проверить на isset,чекнуть как лучше завадилировать textarea правильно


        // 1) валидация
        // 2) парсим строки
        // 3) доабвляю через форич в таблицу каждое прокси (есть дока в ларе способ попроще)

        if (strlen($proxyList) > 0) {
            $proxyArray = explode("\n", $proxyList);
            foreach ($proxyArray as $proxy) {
                // не уверен, что эта регулярка подходит звучит как временное решение
                // @todo только от одного до трех для айпи.
                $isProxy = preg_match("(\d+\.\d+\.\d+\.\d+:\d+)", $proxy);
                if ($isProxy) {
                    $q = Home::insert([
                        'proxy' => $proxy,
                        'created_at' => DB::raw('now()')
                    ]);
                }
            }
        }

        return view('main');
    }
}
