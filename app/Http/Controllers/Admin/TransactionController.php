<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;
use App\Models\Transaction;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    public function index(): View
    {
        $transactions = Transaction::all();

        return view('transactions.index', [
            'transactions' => $transactions,
        ]);
    }

    public function create(): View
    {
        return view('transactions.create');
    }

    public function store(Request $request)
    {
        // Logic to store a new transaction
    }

    public function show(Transaction $transaction): View
    {
        return view('transactions.show', [
            'transaction' => $transaction,
        ]);
    }

    public function edit(Transaction $transaction): View
    {
        return view('transactions.edit', [
            'transaction' => $transaction,
        ]);
    }

    public function update(Request $request, Transaction $transaction)
    {
        // Logic to update an existing transaction
    }
}
