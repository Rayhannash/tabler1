<?php

namespace App\Http\Controllers;

use App\Models\PermintaanMgng;
use Illuminate\Http\Request;

class ProposalMasukController extends Controller
{
    public function index(Request $req)
    {
        $data = PermintaanMgng::with(['masterMgng.masterSklh.user'])
            ->whereHas('masterMgng.masterSklh.user', function ($query) use ($req) {
                if ($req->has('keyword')) {
                    $keyword = $req->keyword;
                    $query->where('fullname', 'like', "%{$keyword}%")
                        ->orWhere('alamat_sklh', 'like', "%{$keyword}%")
                        ->orWhere('telp_sklh', 'like', "%{$keyword}%")
                        ->orWhere('email', 'like', "%{$keyword}%")
                        ->orWhere('no_akreditasi_sklh', 'like', "%{$keyword}%")
                        ->orWhere('nama_narahubung', 'like', "%{$keyword}%");
                }
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.proposal_masuk.daftar', compact('data'));
    }
}
