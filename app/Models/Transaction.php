<?php

namespace App\Models;

use App\Enum\TransactionTypeEnum;
use App\Observers\TransactionObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

/**
 * @method static create(mixed $validated)
 * @property mixed $created_by
 */
#[ObservedBy([TransactionObserver::class])]
class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'financial_category_id',
        'amount',
        'type',
        'action_date',
        'description',
        'created_by',
    ];

    protected $casts = [
        'type' => TransactionTypeEnum::class
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(FinancialCategory::class, 'financial_category_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
