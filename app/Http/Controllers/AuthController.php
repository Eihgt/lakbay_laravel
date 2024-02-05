<?php

namespace App\Http\Controllers;

use App\Classes\Authentication;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function landingPage()
    {
        $auth = new Authentication();
        $prices = $auth->getPrices();
        return view('pages.home', compact('prices'));
    }
}
