<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Office extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'nama_office', 'phone', 'email', 'address',
    ];

    public function outlets()
    {
        return $this->hasMany(Outlet::class, 'office_id', 'id');
    }
}
