<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JabatanP extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function jenjang()
    {
        return $this->hasMany(JenjangJabatanP::class, 'id', 'id_jabatan');
    }
}
