<?php

namespace App\Models;

use App\Enum\MemberGenderEnum;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $all)
 */
class Member extends Model
{
    protected $fillable = [
        'name',
        'birth_date',
        'phone_number',
        'cellphone',
        'email',
        'baptism_date',
        'marital_status',
        'gender',
        'admission_date',
        'dismissed_date',
    ];

    protected $casts = [
        'birth_date' => 'date:d/m/Y',
        'baptism_date' => 'date:d/m/Y',
        'admission_date' => 'date:d/m/Y',
        'dismissed_date' => 'date:d/m/Y',
        'gender' => MemberGenderEnum::class,
    ];
}
