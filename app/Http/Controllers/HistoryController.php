<?php

namespace App\Http\Controllers;

use App\Models\Home;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        $testArray = [];
        $proxyList = Home::get()->reverse()->toArray();

        return view('history', [
            'proxyList' => $proxyList,
        ]);
    }
}
