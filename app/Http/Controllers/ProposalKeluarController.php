<?php

namespace App\Http\Controllers;

use App\Models\MasterPsrt;
use App\Models\PermintaanMgng;
use App\Models\BalasanMgng;
use App\Models\MasterBdngMember;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ProposalKeluarController extends Controller
{
    public function index(Request $req)
{
    // Ambil data permohonan magang beserta relasi masterMgng, masterSklh, user, dan balasan
    $data = PermintaanMgng::with(['masterMgng.masterSklh.user', 'balasan'])  // Memuat relasi balasan
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

    // Ambil data peserta magang
    $data2 = MasterPsrt::all(); 

    // Ambil data balasan magang
    $data3 = BalasanMgng::all(); 

    return view('pages.proposal_keluar.daftar', compact('data', 'data2', 'data3'));
}
public function balasPermohonanKeluar($id)
{
    // Ambil permohonan berdasarkan ID
    $rc = PermintaanMgng::findOrFail($id);

    // Cek apakah balasan sudah ada untuk permohonan ini
    $balasan = BalasanMgng::where('master_mgng_id', $rc->master_mgng_id)->first();

    $rd = MasterPsrt::where('permintaan_mgng_id', $rc->id)->get();

    // Jika tidak ada balasan, buat objek baru
    if (!$balasan) {
        $balasan = new BalasanMgng();
    }

    // Kirim data ke view
    return view('pages.proposal_keluar.tanggapiproposal', compact('rc', 'rd', 'balasan'));
}

public function tanggapiPermohonanKeluar(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'nomor_surat_balasan' => 'required',
        'tanggal_surat_balasan' => 'required|date',
        'sifat_surat_balasan' => 'required',
        'metode_magang' => 'required',
        'lampiran_surat_balasan' => 'nullable|string',
        'scan_surat_balasan' => 'nullable|file|mimes:pdf,jpg,png|max:10240',
        'tanggal_awal_magang' => 'required|date',
        'tanggal_akhir_magang' => 'required|date',
    ]);

    $permohonan = PermintaanMgng::findOrFail($id);

    // Cek apakah balasan sudah ada berdasarkan master_mgng_id
    $balasan = BalasanMgng::where('master_mgng_id', $permohonan->master_mgng_id)->first();

    if (!$balasan) {
        $balasan = new BalasanMgng();
        $balasan->master_mgng_id = $permohonan->master_mgng_id;
    }

    // Update atau isi ulang data
    $balasan->nomor_surat_balasan = $request->nomor_surat_balasan;
    $balasan->tanggal_surat_balasan = $request->tanggal_surat_balasan;
    $balasan->sifat_surat_balasan = $request->sifat_surat_balasan;
    $balasan->metode_magang = $request->metode_magang;
    $balasan->lampiran_surat_balasan = $request->lampiran_surat_balasan;
    $balasan->tanggal_awal_magang = $request->tanggal_awal_magang;
    $balasan->tanggal_akhir_magang = $request->tanggal_akhir_magang;

    // Cek jika ada file baru yang di-upload
    if ($request->hasFile('scan_surat_balasan')) {
        $filename = time().'_'.$request->file('scan_surat_balasan')->getClientOriginalName();
        $request->file('scan_surat_balasan')->storeAs('public/scan_surat_balasan', $filename);
        $balasan->scan_surat_balasan = $filename;
    }

    $balasan->save();

    // Cek kondisi apakah file sudah diupload atau belum
    if ($request->hasFile('scan_surat_balasan')) {
        // Jika file sudah diupload, redirect ke daftar permohonan keluar
        return redirect()->route('proposal_keluar')->with('success', 'Balasan berhasil diperbarui dengan file.');
    } else {
        // Jika tidak ada file, langsung ke halaman daftar permohonan keluar tanpa cetak PDF
        return redirect()->route('proposal_keluar')->with('success', 'Balasan berhasil diperbarui tanpa file.');
    }
    
}

public function cetakpdfpermohonankeluar($id)
{
    // Ambil permohonan berdasarkan ID
    $rc = PermintaanMgng::findOrFail($id);

    // Ambil balasan berdasarkan master_mgng_id
    $balasan = BalasanMgng::where('master_mgng_id', $rc->master_mgng_id)->first();

    // Ambil daftar peserta berdasarkan permohonan
    $rd = MasterPsrt::where('permintaan_mgng_id', $rc->id)->get();

    $pejabat = null;
    if ($balasan->id_bdng_member) {
        $pejabat = MasterBdngMember::find($balasan->id_bdng_member);
    }

    // Generate PDF dengan menggunakan view yang sesuai
    $pdf = Pdf::loadView('pages.proposal_keluar.cetakpdfpermohonankeluar', compact('rc', 'rd', 'balasan', 'petugas'));

    // Return PDF download
    return $pdf->download('PermohonanMagang_' . $rc->nomor_surat_permintaan . '.pdf');
}




}