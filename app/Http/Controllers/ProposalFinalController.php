<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\NotaDinas;
use App\Models\NotaDinasItem;
use App\Models\MasterMgng;
use App\Models\MasterPsrt;
use App\Models\PermintaanMgng;
use App\Models\BalasanMgng;
use App\Models\MasterBdngMember;
use App\Models\MasterBdng;

class ProposalFinalController extends Controller
{
    public function daftar(Request $req)
{
    $data = PermintaanMgng::with(['masterMgng.masterSklh.user', 'balasan', 'notaDinas.masterBdng'])
        ->whereHas('notaDinas') // **Hanya permohonan yang punya nota dinas**
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

    // Ambil peserta berdasarkan nota_dinas.permintaan_mgng_id, bukan langsung dari permintaan_mgng_id
    $data2 = MasterPsrt::whereIn('permintaan_mgng_id', $data->pluck('id'))->get();

    return view('pages.proposal_final.daftar', compact('data', 'data2'));
}

public function tanggapiProposal($id)
{
    // Ambil permohonan magang berdasarkan ID beserta relasi notaDinas dan masterBdng
    $permohonan = PermintaanMgng::with('notaDinas.masterBdng')->findOrFail($id);

    // Ambil peserta magang terkait permohonan ini
    $peserta = MasterPsrt::where('permintaan_mgng_id', $permohonan->id)->get();

    // Kirim data ke view
    return view('pages.proposal_final.tanggapiproposal', compact('permohonan', 'peserta'));
}
public function penilaian($id)
{
    $rc = MasterPsrt::with('notaDinas.masterBdng')->findOrFail($id);

    $masterBdngId = optional($rc->notaDinas)->master_bdng_id;

    // Ambil anggota bidang yang sesuai bidang peserta
    $bdngMembers = [];
    if ($masterBdngId) {
        $bdngMembers = MasterBdngMember::where('id_bdng', $masterBdngId)->orderBy('nama_pejabat')->get();
    }

    return view('pages.proposal_final.penilaian', compact('rc', 'bdngMembers'));
}

public function simpanPenilaian(Request $request, $id)
{
    $rc = MasterPsrt::findOrFail($id);

    // Validasi input (sesuaikan kebutuhan)
    $validated = $request->validate([
        'id_bdng_member' => 'required|exists:master_bdng_member,id',
        'nilai_kedisiplinan' => 'required|numeric|min:0|max:100',
        'nilai_tanggungjawab' => 'required|numeric|min:0|max:100',
        'nilai_kerjasama' => 'required|numeric|min:0|max:100',
        'nilai_motivasi' => 'required|numeric|min:0|max:100',
        'nilai_kepribadian' => 'required|numeric|min:0|max:100',
        'nilai_pengetahuan' => 'required|numeric|min:0|max:100',
        'nilai_pelaksanaankerja' => 'required|numeric|min:0|max:100',
        'nilai_hasilkerja' => 'required|numeric|min:0|max:100',
        'catatan' => 'nullable|string',
    ]);

    // Simpan data ke model
    $rc->id_bdng_member = $validated['id_bdng_member'];
    $rc->nilai_kedisiplinan = $validated['nilai_kedisiplinan'];
    $rc->nilai_tanggungjawab = $validated['nilai_tanggungjawab'];
    $rc->nilai_kerjasama = $validated['nilai_kerjasama'];
    $rc->nilai_motivasi = $validated['nilai_motivasi'];
    $rc->nilai_kepribadian = $validated['nilai_kepribadian'];
    $rc->nilai_pengetahuan = $validated['nilai_pengetahuan'];
    $rc->nilai_pelaksanaankerja = $validated['nilai_pelaksanaankerja'];
    $rc->nilai_hasilkerja = $validated['nilai_hasilkerja'];
    $rc->catatan = $validated['catatan'];
    $rc->status_penilaian = 'sudah';
    

    // Hitung nilai akhir jika perlu
    $rc->nilai_akhir = (
        $rc->nilai_kedisiplinan * 0.1 +
        $rc->nilai_tanggungjawab * 0.1 +
        $rc->nilai_kerjasama * 0.1 +
        $rc->nilai_motivasi * 0.1 +
        $rc->nilai_kepribadian * 0.15 +  
        $rc->nilai_pengetahuan * 0.15 +
        $rc->nilai_pelaksanaankerja * 0.15 +
        $rc->nilai_hasilkerja * 0.15
    );

    $rc->save();

    return redirect()->route('proposal_final.tanggapi', ['id' => $rc->permintaan_mgng_id])
        ->with('success', 'Penilaian berhasil disimpan');
}

 public function uploadPenilaianForm($id)
    {
        $rc = MasterPsrt::findOrFail($id);

        return view('pages.proposal_final.uploadpenilaian', compact('rc'));
    }

    // Proses simpan file upload penilaian
    public function simpanUploadPenilaian(Request $request, $id)
{
    $rc = MasterPsrt::findOrFail($id);

    $request->validate([
         'scan_penilaian' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240', // max 10MB
    ]);

    if ($request->hasFile('scan_penilaian')) {
        // Hapus file lama jika ada
        if ($rc->scan_penilaian) {
            Storage::disk('public')->delete($rc->scan_penilaian);
        }

        // Simpan file ke folder 'uploads' dalam storage/app/public
        $path = $request->file('scan_penilaian')->store('uploads', 'public');

        // Simpan path file dan update status
        $rc->scan_penilaian = $path; // simpan relative path, misal: uploads/abc.pdf
        $rc->status_scan_penilaian = 'sudah';
        $rc->save();

        return redirect()->route('proposal_final.tanggapi', ['id' => $rc->permintaan_mgng_id])
            ->with('success', 'File penilaian berhasil diupload.');
    }

    return back()->withErrors(['scan_penilaian' => 'File gagal diupload.']);
}

public function cetakPenilaian($id)
{
    $rc = MasterPsrt::with('permintaan.masterMgng.masterSklh', 'notaDinas.masterBdng')->findOrFail($id);

    $pdf = Pdf::loadView('pages.proposal_final.cetakpenilaian', compact('rc'));
    $pdf->setPaper('a4', 'portrait');

    return $pdf->stream("penilaian_{$rc->nama_peserta}.pdf");
}

public function uploadSertifikatForm($id)
{
    $rc = MasterPsrt::findOrFail($id);

    return view('pages.proposal_final.uploadsertifikat', compact('rc'));
}

public function simpanUploadSertifikat(Request $request, $id)
{
    $rc = MasterPsrt::findOrFail($id);

    $request->validate([
        'scan_sertifikat' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240', // max 10MB
    ]);

    if ($request->hasFile('scan_sertifikat')) {
        // Hapus file lama jika ada
        if ($rc->scan_sertifikat) {
            Storage::disk('public')->delete($rc->scan_sertifikat);
        }

        // Simpan file ke folder 'uploads' dalam storage/app/public
        $path = $request->file('scan_sertifikat')->store('uploads', 'public');

        // Simpan path file dan update status
        $rc->scan_sertifikat = $path; // simpan relative path, misal: uploads/abc.pdf
        $rc->status_sertifikat = 'terkirim';
        $rc->save();

        return redirect()->route('proposal_final.tanggapi', ['id' => $rc->permintaan_mgng_id])
            ->with('success', 'File sertifikat berhasil diupload.');
    }

    return back()->withErrors(['scan_sertifikat' => 'File gagal diupload.']);
}
}