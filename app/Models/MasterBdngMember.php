<?php

namespace App\Models;

use App\Models\MasterBdng;
use Illuminate\Database\Eloquent\Model;


class MasterBdngMember extends Model
{
    protected $table = 'master_bdng_member';

    public function bidang()
    {
        return $this->belongsTo(MasterBdng::class, 'id_bdng');
    }
}
