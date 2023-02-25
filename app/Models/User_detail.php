<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User_detail extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'img',
        'user_id',
        'full_name',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'kelamin',
        'agama',
        'alamat_lengkap',
        'alamat_domisili',
        'kewarganegaraan',
        'nama_ibu',
        'pendidikan',
        'cabang_id',
        'jabatan',
        'outlet_id',
        'phone',
        'email',
        'ktp_img',
        'no_kk',
        'bank',
        'rekening',
        'status',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
