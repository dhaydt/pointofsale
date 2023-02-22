<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Outlet extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'nama_outlet', 'office_id', 'lokasi', 'address',
    ];

    public function cabang()
    {
        return $this->hasOne(Office::class, 'id', 'office_id');
    }
}
