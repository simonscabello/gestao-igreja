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

        return view('financial_categories.index', ['financialCategories' => $financialCategories]);
    }

    public function create(): View
    {
        return view('financial_categories.create');
    }

    public function store(FinancialCategoryRequest $request): RedirectResponse
    {
        $financialCategory = FinancialCategory::create($request->validated());

        toast('Categoria financeira cadastrada com sucesso!', 'success');

        return to_route('categoryFinancial.show', $financialCategory);
    }

    public function edit(FinancialCategory $financialCategory): View
    {
        return view('financial_categories.edit', ['financialCategory' => $financialCategory]);
    }

    public function update(FinancialCategoryRequest $request, FinancialCategory $financialCategory): RedirectResponse
    {
        $financialCategory->update($request->validated());

        toast('Categoria financeira atualizada com sucesso!', 'success');

        return to_route('categoryFinancial.show', $financialCategory);
    }

    public function activate(FinancialCategory $financialCategory): RedirectResponse
    {
        $financialCategory->update(['active' => true]);

        toast('Categoria financeira ativada com sucesso!', 'success');

        return to_route('categoryFinancial.index');
    }

    public function deactivate(FinancialCategory $financialCategory): RedirectResponse
    {
        $financialCategory->update(['active' => false]);

        toast('Categoria financeira desativada com sucesso!', 'success');

        return to_route('categoryFinancial.index');
    }
}
