<?php

namespace App\Models;

use Carbon\Carbon;
use App\Enum\MemberGenderEnum;
use App\Observers\MemberObserver;
use App\Enum\MemberMaritalStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

/**
 * @property int $deleted_by
 * @property Carbon|null $dismissed_date
 * @property Address $address
 * @method static create(mixed $validated)
 */
#[ObservedBy(MemberObserver::class)]
class Member extends Model
{
    use SoftDeletes;

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
        'deleted_by',
    ];

    protected $casts = [
        'gender' => MemberGenderEnum::class,
        'marital_status' => MemberMaritalStatusEnum::class,
    ];

    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }

    protected function birthDate(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value ?
                Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y') :
                null
        );
    }

    protected function admissionDate(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value ?
                Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y') :
                null,
        );
    }

    protected function dismissedDate(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value ?
                Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y') :
                null
        );
    }

    protected function baptismDate(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value ?
                Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y') :
                null,
        );
    }
}
