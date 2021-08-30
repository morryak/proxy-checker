<?php

namespace App\Http\Controllers;

use App\Models\Home;

class HistoryController extends Controller
{
    public function index()
    {
        $proxyList = Home::get()->reverse()->toArray();

        return view('history', [
            'proxyList' => $proxyList,
        ]);
    }
}
