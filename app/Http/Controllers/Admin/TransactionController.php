<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;
use App\Models\Transaction;
use App\Models\FinancialCategory;
use App\Enum\TransactionTypeEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\TransactionRequest;

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
        $financialCategories = FinancialCategory::orderBy('name')->get();
        $types = TransactionTypeEnum::cases();

        return view('transactions.create', [
            'financialCategories' => $financialCategories,
            'types' => $types,
        ]);
    }

    public function store(TransactionRequest $request): RedirectResponse
    {
        $transaction = Transaction::create($request->validated());

        toast('Transação criada com sucesso!', 'success');

        return to_route('transactions.show', $transaction);
    }

    public function show(Transaction $transaction): View
    {
        return view('transactions.show', [
            'transaction' => $transaction,
        ]);
    }

    public function edit(Transaction $transaction): View
    {
        $transaction->load('category');

        $financialCategories = FinancialCategory::orderBy('name')->get();
        $types = TransactionTypeEnum::cases();

        return view('transactions.edit', [
            'transaction' => $transaction,
            'financialCategories' => $financialCategories,
            'types' => $types,
        ]);
    }

    public function update(TransactionRequest $request, Transaction $transaction): RedirectResponse
    {
        $transaction->update($request->validated());

        toast('Transação atualizada com sucesso!', 'success');

        return to_route('transactions.index');
    }
}
