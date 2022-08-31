<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenjangJabatanP extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function jabatan()
    {
        return $this->hasOne(JabatanP::class, 'id', 'id_jabatan');
    }
}
