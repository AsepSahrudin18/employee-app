<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table    = 'employees';
    protected $fillable = [
        'nama',
        'tanggal_lahir',
        'alamat',
        'foto',
        'status_perkawinan',
    ];
}
