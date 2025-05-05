<?php

namespace App\Http\Controllers;

use App\Models\Access;
use App\Models\Menu;
use App\Models\MasterSklh;
use App\Models\PermintaanMgng;
use App\Models\BalasanMgng;
use App\Models\MasterMgng;
use App\Models\MasterPsrt;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class UserExtrasController extends Controller
{
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
        $data = MasterSklh::where('id_user', Auth::id())->first();
        return view('pages.user_extras.editsklh', ['dt' => $data]);
    }

    public function updatesklh(Request $req)
    {
        $data = MasterSklh::where('id_user', Auth::id())->first();

        $validated = $req->validate([
            'jenis_sklh' => 'required',
            'alamat_sklh' => 'required',
            'kabko_sklh' => 'required',
            'telp_sklh' => 'required|unique:master_sklh,telp_sklh,' . $data->id,
            'akreditasi_sklh' => 'required',
            'no_akreditasi_sklh' => 'required|unique:master_sklh,no_akreditasi_sklh,' . $data->id,
            'scan_surat_akreditasi_sklh' => 'nullable|mimes:pdf,doc,docx|max:10000',
            'nama_narahubung' => 'required',
            'jenis_kelamin_narahubung' => 'required',
            'jabatan_narahubung' => 'required',
            'handphone_narahubung' => 'required|unique:master_sklh,handphone_narahubung,' . $data->id,
        ]);

        // Handle file upload if any
        if ($req->hasFile('scan_surat_akreditasi_sklh')) {
            $file = $req->file('scan_surat_akreditasi_sklh');
            $filename = time() . '_' . str_replace(' ', '', $file->getClientOriginalName());
            $file->storeAs('public/scan_surat_akreditasi_sklh', $filename);
            $validated['scan_surat_akreditasi_sklh'] = $filename;
        }

        $result = MasterSklh::where('id_user', Auth::id())->update($validated);

        return $result
            ? redirect()->route('user_extras.viewsklh')->with('result', 'success')
            : back()->with('result', 'fail');
    }

    public function simpanproposalmagang(Request $req)
    {
        // Ambil data sekolah yang login
        $datasklh = MasterSklh::where('id_user', Auth::id())->firstOrFail();

        // Cek atau buat master_mgng untuk sekolah ini
        $masterMgng = MasterMgng::firstOrCreate([
            'master_sklh_id' => $datasklh->id
        ]);

        // Validasi
        $validated = $req->validate([
            'nomor_surat_permintaan' => 'required|unique:permintaan_mgng,nomor_surat_permintaan',
            'tanggal_surat_permintaan' => 'required|date',
            'perihal_surat_permintaan' => 'required',
            'ditandatangani_oleh' => 'required',
            'scan_surat_permintaan' => 'required|file|max:10000|mimes:pdf,doc,docx',
            'scan_proposal_magang' => 'required|file|max:10000|mimes:pdf,doc,docx',
        ]);

        // Upload file
        $filescansurat = $this->uploadFile($req->file('scan_surat_permintaan'), 'scan_surat_permintaan');
        $filescanproposal = $this->uploadFile($req->file('scan_proposal_magang'), 'scan_proposal_magang');

        // Simpan ke permintaan_mgng
        $saved = PermintaanMgng::create([
            'master_mgng_id' => $masterMgng->id,
            'nomor_surat_permintaan' => $validated['nomor_surat_permintaan'],
            'tanggal_surat_permintaan' => $validated['tanggal_surat_permintaan'],
            'perihal_surat_permintaan' => $validated['perihal_surat_permintaan'],
            'ditandatangani_oleh' => $validated['ditandatangani_oleh'],
            'scan_surat_permintaan' => $filescansurat,
            'scan_proposal_magang' => $filescanproposal,
            'status_surat_permintaan' => 'belum',
            'status_baca_surat_permintaan' => 'belum',
        ]);

        return redirect()->route('user.daftar_permohonan')->with('result', 'success');
    }

    protected function uploadFile($file, $folder)
    {
        $filename = time() . '_' . str_replace(' ', '', $file->getClientOriginalName());
        $file->storeAs('public/' . $folder, $filename);
        return $filename;
    }

    public function daftarPermohonanKeluar()
    {
        // Ambil data master_sklh berdasarkan user yang login
        $masterSklh = MasterSklh::where('id_user', Auth::id())->first();

        if (!$masterSklh) {
            abort(404, 'Sekolah tidak ditemukan.');
        }

        // Ambil data master_mgng berdasarkan master_sklh_id
        $masterMgng = MasterMgng::where('master_sklh_id', $masterSklh->id)->first();

        if (!$masterMgng) {
            abort(404, 'Data master magang belum tersedia.');
        }

        // Ambil semua permintaan magang dengan relasi balasan
        $permintaan = PermintaanMgng::where('master_mgng_id', $masterMgng->id)
            ->where('status_surat_permintaan', 'belum')
            ->get();

        // Ambil data peserta magang jika perlu
        $data2 = MasterPsrt::all();

        return view('pages.user_extras.daftarpermohonankeluar', compact('permintaan', 'data2'));
    }

    public function addPesertaMagang($id)
    {
        // Ambil permohonan berdasarkan id yang diterima dari route
        $permohonan = PermintaanMgng::findOrFail($id);

        // Cek apakah permohonan magang bisa ditambah peserta
        if ($permohonan->status_surat_permintaan != 'belum') {
            return redirect()->route('user.daftarpermohonankeluar')->with('error', 'Tidak bisa menambahkan peserta ke permohonan yang sudah terkirim');
        }

        // Jika status 'belum', lanjutkan dengan proses penambahan peserta
        // Misalnya kita bisa membuat form untuk menambahkan peserta atau langsung menyimpan data peserta
        // return view('pages.user_extras.addpesertamagang', [
        //     'permohonan' => $permohonan, // variabel ini harus ada
        // ]);

        return view('pages.user_extras.addpesertamagang', compact('permohonan'));
    }

    public function simpanPesertaMagang($id, Request $request)
    {
        dd($request());
    }

    public function hapusPermohonan($id)
    {
        $permohonan = PermintaanMgng::find($id);

        if (!$permohonan) {
            return redirect()->route('user.daftar_permohonan')->with('error', 'Permohonan tidak ditemukan.');
        }

        $permohonan->delete();

        return redirect()->route('user.daftar_permohonan')->with('success', 'Permohonan berhasil dihapus.');
    }
}
