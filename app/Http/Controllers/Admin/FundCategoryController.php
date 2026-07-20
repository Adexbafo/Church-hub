<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FundCategory;
use Illuminate\Http\Request;

class FundCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = FundCategory::latest()->paginate(10);

        return view(
            'admin.fund-categories.index',
            compact('categories')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.fund-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:fund_categories',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        FundCategory::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->route('admin.fund-categories.index')
            ->with(
                'success',
                'Fund category created successfully.'
            );
    }

    /**
     * Display the specified resource.
     */
    public function show(FundCategory $fundCategory)
    {
        return view(
            'admin.fund-categories.show',
            [
                'category' => $fundCategory,
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FundCategory $fundCategory)
    {
        return view(
            'admin.fund-categories.edit',
            [
                'category' => $fundCategory,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        Request $request,
        FundCategory $fundCategory
    ) {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:fund_categories,name,'.$fundCategory->id,
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $fundCategory->update([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->route('admin.fund-categories.index')
            ->with(
                'success',
                'Fund category updated successfully.'
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        FundCategory $fundCategory
    ) {
        if (
            $fundCategory->donations()->exists()
            || $fundCategory->transactions()->exists()
        ) {
            return back()->with(
                'error',
                'This category is in use and cannot be deleted.'
            );
        }

        $fundCategory->delete();

        return redirect()
            ->route('admin.fund-categories.index')
            ->with(
                'success',
                'Fund category deleted successfully.'
            );
    }
}
