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
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

/**
 * @property int $deleted_by
 * @property Carbon|null $dismissed_date
 * @property Address $address
 * @method static create(mixed $validated)
 * @method static orderBy(string $string)
 * @method static count()
 * @method static first()
 * @method static latest(string $string)
 */
#[ObservedBy(MemberObserver::class)]
class Member extends Model
{
    use SoftDeletes;
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
        'deleted_by',
        'wedding_date',
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
        return $this->formattedDateAttribute();
    }

    protected function admissionDate(): Attribute
    {
        return $this->formattedDateAttribute();
    }

    protected function dismissedDate(): Attribute
    {
        return $this->formattedDateAttribute();
    }

    protected function baptismDate(): Attribute
    {
        return $this->formattedDateAttribute();
    }

    protected function weddingDate(): Attribute
    {
        return $this->formattedDateAttribute();
    }

    private function formattedDateAttribute(): Attribute
    {
        return Attribute::make(
            get: fn(?string $value) => $value
                ? Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y')
                : null
        );
    }
}
