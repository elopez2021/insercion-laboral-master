<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'surname',
        'identification',
        'birthday',
        'sex',
        'direction',
        'municipality',
        'province',
        'nationality',
        'homeNumber',
        'cellphone',
        'hasDrivingLicense',
        'hasVehicle',
        'graduationYear',
        'school',
        'grade',
        'enrollmentID',
        'career',
        'experience',
        'workArea',
        'user_id',
        'offer_id',
        'cv_path',
    ];
}
