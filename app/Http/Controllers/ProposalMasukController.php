<?php

namespace App\Http\Controllers;

use App\Models\MasterPsrt;
use App\Models\PermintaanMgng;
use App\Models\BalasanMgng;
use App\Models\MasterBdngMember;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ProposalMasukController extends Controller
{
    public function index(Request $req)
    {
        // Ambil data permohonan magang beserta relasi
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

        // Ambil data peserta magang
        $data2 = MasterPsrt::all(); 

        return view('pages.proposal_masuk.daftar', compact('data', 'data2'));
    }

      
    public function cetakpdfpermohonanmasuk($id)
{
    // Ambil permohonan berdasarkan ID
    $rc = PermintaanMgng::findOrFail($id);

    // Ambil balasan berdasarkan master_mgng_id
    $balasan = BalasanMgng::where('master_mgng_id', $rc->master_mgng_id)->first();

    // Ambil daftar peserta berdasarkan permohonan
    $rd = MasterPsrt::where('permintaan_mgng_id', $rc->id)->get();

    $petugas = MasterBdngMember::with('masterBdng') // Eager load relasi masterBdng
                            ->findOrFail($id);

    // Generate PDF
    $pdf = Pdf::loadView('pages.proposal_masuk.cetakpdfpermohonanmasuk', compact('rc', 'rd', 'balasan', 'petugas'));

    
    // Return PDF download
    return $pdf->download('PermohonanMagang_' . $rc->nomor_surat_permintaan . '.pdf');
}





    public function balasPermohonan($id)
    {
        // Ambil permohonan berdasarkan ID
        $rc = PermintaanMgng::findOrFail($id);

        // Ambil daftar peserta magang berdasarkan permohonan
        $rd = MasterPsrt::where('permintaan_mgng_id', $rc->id)->get();

        // Kirim data ke view
        return view('pages.proposal_masuk.tanggapiproposal', compact('rc', 'rd'));
    }


    public function tanggapiPermohonan(Request $request, $id)
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

    // Ambil permohonan magang berdasarkan ID
    $permohonan = PermintaanMgng::findOrFail($id);

    // Create a new BalasanMgng entry
    $balasan = new BalasanMgng();
    $balasan->master_mgng_id = $permohonan->master_mgng_id; 
    $balasan->nomor_surat_balasan = $request->nomor_surat_balasan;
    $balasan->tanggal_surat_balasan = $request->tanggal_surat_balasan;
    $balasan->sifat_surat_balasan = $request->sifat_surat_balasan;
    $balasan->metode_magang = $request->metode_magang;
    $balasan->lampiran_surat_balasan = $request->lampiran_surat_balasan;
    $balasan->tanggal_awal_magang = $request->tanggal_awal_magang;
    $balasan->tanggal_akhir_magang = $request->tanggal_akhir_magang;

    // Handle file upload jika ada
    if ($request->hasFile('scan_surat_balasan')) {
        $filename = time().'_'.$request->file('scan_surat_balasan')->getClientOriginalName();
        $request->file('scan_surat_balasan')->storeAs('public/scan_surat_balasan', $filename);
        $balasan->scan_surat_balasan = $filename;
    }

    // Save balasan entry
    $balasan->save();

    // Redirect ke halaman cetak PDF setelah data disimpan
    return redirect()->route('proposal_masuk.cetakpdfpermohonanmasuk', ['id' => $id]);
}

    

}

