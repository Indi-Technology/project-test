<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi (Mass Assignment)
     */
    protected $fillable = [
        'company_id',
        'name',
        'email',
        'phone',
    ];

    /**
     * Relasi ke Company (Many to One)
     * Banyak karyawan dimiliki oleh satu perusahaan
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
