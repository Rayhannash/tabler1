<?php

namespace App\Http\Controllers;

use App\Models\MasterSklh;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class MasterSklhController extends Controller
{   

    public function index(Request $request)
{
    $keyword = $request->keyword;

    $query = MasterSklh::join('users','users.id','=','master_sklh.id_user')
        ->select('master_sklh.*','users.fullname','users.akun_diverifikasi')
        ->orderBy('users.fullname','asc');

    if ($keyword) {
        $query->where(function($q) use($keyword) {
            $q->where('users.fullname','like',"%{$keyword}%")
              ->orWhere('master_sklh.kabko_sklh','like',"%{$keyword}%");
        });
    }

    $data = $query->get();

    return view('pages.master_sklh.daftar', compact('data'));
}

public function verify($id)
{
    $data = MasterSklh::with('user')->findOrFail($id);
    return view('pages.master_sklh.verify', ['rc' => $data]);
}

public function verification($id, Request $req)
{
    $data = MasterSklh::with('user')->findOrFail($id);
    $user = $data->user;

    $newStatus = in_array($user->akun_diverifikasi, ['belum', 'suspended']) ? 'sudah' : 'suspended';

    $user->akun_diverifikasi = $newStatus;
    $result = $user->save();

    if ($result) {
        return redirect()->route('master_sklh')->with('result', 'update');
    } else {
        return back()->with('result', 'fail');
    }
}

public function edit($id)
{
    $sklh = MasterSklh::findOrFail($id);
    return view('pages.master_sklh.edit', compact('data'));
}



}
