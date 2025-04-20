<?php

namespace App\Models;

use App\Enum\TransactionTypeEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'amount',
        'type',
        'action_date',
        'description',
        'created_by',
    ];

    protected $casts = [
        'amount' => 'float',
        'type' => TransactionTypeEnum::class
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(FinancialCategory::class, 'category_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
