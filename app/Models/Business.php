<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'RNC',
        'wantsAnonimity',
        'hasFormationDepartment',
        'economicalActivity',
        'industry',
        'enterpriseSize',
        'direction',
        'sector',
        'section',
        'municipality',
        'province',
        'countryArea',
        'mainCellphone',
        'directPhone',
        'contactName',
        'contactNumber',
        'contactEmail',
        'user_id',
    ];
}
