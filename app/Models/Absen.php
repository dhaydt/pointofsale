<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'outlet_id',
        'shift',
        'jam_masuk',
        'lokasi_masuk',
        'jam_pulang',
        'lokasi_pulang',
        'keterangan'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function outlet(){
        return $this->belongsTo(Outlet::class, 'outlet_id');
    }
}
