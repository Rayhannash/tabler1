<?php

namespace App\Http\Controllers;

use App\Models\Access;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    //
    public function index() {
        return view('pages.home.index');
    }
}
