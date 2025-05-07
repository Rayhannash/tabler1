<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BalasanMgng extends Model
{
    protected $table = 'balasan_mgng';

    public function permintaan()
    {
        return $this->belongsTo(PermintaanMgng::class, 'permintaan_mgng_id');
    }

    public function permintaanMgng()
{
    return $this->belongsTo(PermintaanMgng::class, 'master_mgng_id', 'master_mgng_id');
}

    public function master()
    {
        return $this->belongsTo(MasterMgng::class, 'master_mgng_id');
    }

    public function masterMgng()
{
    return $this->belongsTo(MasterMgng::class, 'master_mgng_id', 'id');
}


    
}
