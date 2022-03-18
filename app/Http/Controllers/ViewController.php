<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function create_post(Request $req) {
        dump($req->localStorage);
    }
}
