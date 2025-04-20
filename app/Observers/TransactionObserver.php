<?php

namespace App\Observers;

use App\Models\Transaction;

class TransactionObserver
{
    public function created(Transaction $transaction): void
    {
        $transaction->created_by = auth()->user()->id;

        $transaction->save();
    }
}
