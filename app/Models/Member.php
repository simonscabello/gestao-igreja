<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Member extends Model
{
    use HasFactory;

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
        'birth_date' => 'date',
        'baptism_date' => 'date:d/m/Y',
        'admission_date' => 'date',
        'dismissed_date' => 'date',
    ];


    protected function birthDate(): Attribute
    {
        return Attribute::make(
            get: fn (DateTime $value) => $value->format('d/m/Y'),
        );
    }

    // protected function baptismDate(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn (DateTime $value) => $value->format('d/m/Y'),
    //     );
    // }

    protected function dismissedDate(): Attribute
    {
        return Attribute::make(
            get: fn (DateTime $value) => $value->format('d/m/Y'),
        );
    }
}
