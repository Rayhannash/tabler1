<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterMgng extends Model
{
    use HasFactory;

    protected $table = 'master_mgng';

    protected $fillable = [
        'master_sklh_id',
    ];

    // Relasi ke MasterSklh
    public function masterSklh()
    {
        return $this->belongsTo(MasterSklh::class, 'master_sklh_id');
    }

    // Relasi ke PermintaanMgng (diubah menjadi hasMany)
    public function permintaan()
    {
        return $this->hasMany(PermintaanMgng::class, 'master_mgng_id');
    }

    // Relasi ke BalasanMgng (diubah menjadi hasMany jika ada lebih dari satu balasan)
    public function balasan()
    {
        return $this->hasMany(BalasanMgng::class, 'master_mgng_id');
    }

    // Relasi ke MasterPsrt (sudah benar)
    public function peserta()
    {
        return $this->hasMany(MasterPsrt::class, 'master_mgng_id');
    }
}
