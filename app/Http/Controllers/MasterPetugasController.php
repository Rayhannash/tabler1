<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterBdng;
use App\Models\MasterBdngMember;

class MasterPetugasController extends Controller
{
    // Menampilkan daftar petugas
    public function index(Request $request)
{
    return $this->daftar($request);
}
    // Menampilkan daftar dengan join ke bidang
    public function daftar(Request $request)
    {
        $query = MasterBdngMember::join('master_bdng', 'master_bdng.id', '=', 'master_bdng_member.id_bdng')
            ->select(
                'master_bdng_member.id as member_id',
                'master_bdng_member.nama_pejabat',
                'master_bdng_member.nip_pejabat',
                'master_bdng_member.pangkat_pejabat',
                'master_bdng_member.golongan_pejabat',
                'master_bdng_member.ruang_pejabat',
                'master_bdng_member.jabatan_pejabat',
                'master_bdng_member.sub_bidang_pejabat',
                'master_bdng_member.id_bdng',
                'master_bdng.nama_bidang'
            );

        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('master_bdng_member.nama_pejabat', 'like', "%{$keyword}%")
                    ->orWhere('master_bdng_member.nip_pejabat', 'like', "%{$keyword}%");
            });
        }

        $data = $query->orderBy('master_bdng_member.created_at', 'desc')->paginate(10);

        return view('pages.master_petugas.daftar', compact('data'));
    }

    public function edit($id)
    {
        // Ambil data petugas
        $data1 = MasterBdngMember::where('master_bdng_member.id', $id)
            ->join('master_bdng', 'master_bdng.id', '=', 'master_bdng_member.id_bdng')
            ->select('master_bdng_member.*', 'nama_bidang')
            ->first();
        
        // Ambil data bidang
        $bidang = MasterBdng::all();
    
        // Kirim kedua data ke view
        return view('pages.master_petugas.edit', [
            'petugas' => $data1,
            'bidang' => $bidang
        ]);
    }
    
public function update(Request $request, $id)
{
    $request->validate([
        'nama_pejabat' => 'required',
        'nip_pejabat' => 'required',
        'pangkat_pejabat' => 'required',
        'golongan_pejabat' => 'required',
        'ruang_pejabat' => 'required',
        'jabatan_pejabat' => 'required',
        'id_bdng' => 'required',
    ]);

    $petugas = MasterBdngMember::findOrFail($id);
    $petugas->update($request->all());

    return redirect()->route('master_petugas')->with('result', 'success');
}
}
