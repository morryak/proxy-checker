<?php

namespace App\Http\Controllers;

use App\Models\Home;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        $proxyList = Home::get()->toArray();

        return view('history', [
            'proxyList' => $proxyList
        ]);
    }
}
