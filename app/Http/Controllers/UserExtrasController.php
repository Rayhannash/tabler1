<?php

namespace App\Http\Controllers;

use App\Models\Access;
use App\Models\Menu;
use App\Models\MasterSklh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class UserExtrasController extends Controller
{
    //
    public function index()
{
    if (request()->routeIs('buat_permohonan')) {
        return view('pages.user_extras.buatproposalmagang');
    }

    return view('pages.user_extras.addsklh');
}
    public function store(Request $request)
{
    // Validasi input
    $validated = $request->validate([
        'jenis' => 'required',
        'alamat' => 'required',
        'kabko_sklh' => 'required',
        'akreditasi' => 'required',
        'telepon_lembaga' => 'required',
        'no_akreditasi' => 'required',
        'nama_narahubung' => 'required',
        'jenis_kelamin' => 'required',
        'jabatan_narahubung' => 'required',
        'telepon_narahubung' => 'required',
        'file_akreditasi' => 'required|file|mimes:pdf,jpeg,png|max:10240',  // Maksimal ukuran 10MB
    ]);

    // Proses penyimpanan file
    if ($request->hasFile('file_akreditasi')) {
        // Menyimpan file di storage public
        $filePath = $request->file('file_akreditasi')->store('uploads', 'public');
    }

    // Simpan data menggunakan Eloquent Model MasterSklh
    $data = MasterSklh::create([
        'id_user' => Auth::id(),
        'jenis_sklh' => $request->jenis,
        'alamat_sklh' => $request->alamat,
        'kabko_sklh' => $request->kabko_sklh,
        'telp_sklh' => $request->telepon_lembaga,
        'akreditasi_sklh' => $request->akreditasi,
        'no_akreditasi_sklh' => $request->no_akreditasi,
        'scan_surat_akreditasi_sklh' => $filePath ?? null,
        'nama_narahubung' => $request->nama_narahubung,
        'jenis_kelamin_narahubung' => $request->jenis_kelamin,
        'jabatan_narahubung' => $request->jabatan_narahubung,
        'handphone_narahubung' => $request->telepon_narahubung,
    ]);

    // Redirect ke halaman detail data setelah berhasil disimpan
    return redirect()->route('user_extras.viewsklh', $data->id)
                     ->with('result', 'success');
}

public function show()
    {
        // ambil data milik user yang sedang login
        $dt = MasterSklh::where('id_user', Auth::id())
            ->join('users', 'users.id', '=', 'master_sklh.id_user')
            ->select('master_sklh.*', 'users.fullname', 'users.email')
            ->firstOrFail();

        return view('pages.user_extras.viewsklh', compact('dt'));
    }

public function edit()
{
    $data=MasterSklh::where('id_user',Auth::id())->first();
    return view('pages.user_extras.editsklh',['dt'=>$data]);
}

}
