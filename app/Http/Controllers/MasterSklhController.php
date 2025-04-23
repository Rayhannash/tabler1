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
            ->select('master_sklh.*','users.fullname')
            ->orderBy('users.fullname','asc');
    
        if ($keyword) {
            $query->where(function($q) use($keyword) {
                $q->where('users.fullname','like',"%{$keyword}%")
                  ->orWhere('master_sklh.alamat_sklh','like',"%{$keyword}%")
                  ->orWhere('master_sklh.kecamatan_sklh','like',"%{$keyword}%")
                  ->orWhere('master_sklh.kabupaten_sklh','like',"%{$keyword}%");
            });
        }
    
        // get all matching rows
        $data = $query->get();
    
        return view('pages.master_sklh.daftar', compact('data'));
    }
    

public function edit($id)
{
    $sklh = MasterSklh::findOrFail($id);
    return view('pages.master_sklh.edit', compact('data'));
}



}
