<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;
use App\Models\FinancialCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\FinancialCategoryRequest;

class FinancialCategoryController extends Controller
{
    public function index(): View
    {
        $financialCategories = FinancialCategory::orderBy('name')->get();

        return view('categoryFinancial.index', ['financialCategories' => $financialCategories]);
    }

    public function create(): View
    {
        return view('categoryFinancial.create');
    }

    public function store(FinancialCategoryRequest $request): RedirectResponse
    {
        $categoryFinancial = FinancialCategory::create($request->validated());

        toast('Categoria financeira cadastrada com sucesso!', 'success');

        return to_route('categoryFinancial.show', $categoryFinancial);
    }

    public function show(FinancialCategory $categoryFinancial): View
    {
        return view('categoryFinancial.show', ['financialCategory' => $categoryFinancial]);
    }

    public function edit(FinancialCategory $categoryFinancial): View
    {
        return view('categoryFinancial.edit', ['financialCategory' => $categoryFinancial]);
    }

    public function update(FinancialCategoryRequest $request, FinancialCategory $categoryFinancial): RedirectResponse
    {
        $categoryFinancial->update($request->validated());

        toast('Categoria financeira atualizada com sucesso!', 'success');

        return to_route('categoryFinancial.show', $categoryFinancial);
    }
}
