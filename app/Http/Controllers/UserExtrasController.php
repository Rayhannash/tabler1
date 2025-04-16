<?php

namespace App\Http\Controllers;

use App\Models\Access;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class UserExtrasController extends Controller
{
    //
    public function index() {
        return view('pages.user_extras.addsklh');
    }
}
