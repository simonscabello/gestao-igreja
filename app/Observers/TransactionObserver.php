<?php

namespace App\Observers;

use App\Models\Transaction;

class TransactionObserver
{
    public function creating(Transaction $transaction): void
    {
        $transaction->created_by = auth()->user()->id;
    }

    public function updating(Transaction $transaction): void
    {
        $transaction->created_by = auth()->user()->id;
    }
}
