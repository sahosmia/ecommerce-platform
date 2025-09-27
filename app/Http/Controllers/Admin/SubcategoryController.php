<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubcategoryStoreRequest;
use App\Http\Requests\SubcategoryUpdateRequest;
use App\Models\Category;
use App\Models\Subcategory;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategories = Subcategory::with('category')
            ->latest()
            ->paginate(20);

        return view('admin.subcategories.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.subcategories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubcategoryStoreRequest $request)
    {
        Subcategory::create($request->validated());

        return redirect()->route('admin.subcategories.index')
            ->with('success', 'Subcategory created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subcategory $subcategory)
    {
        return view('admin.subcategories.show', compact('subcategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subcategory $subcategory)
    {
        $categories = Category::all();
        return view('admin.subcategories.edit', compact('subcategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubcategoryUpdateRequest $request, Subcategory $subcategory)
    {
        $subcategory->update($request->validated());

        return redirect()->route('admin.subcategories.index')
            ->with('success', 'Subcategory updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subcategory $subcategory)
    {
        $subcategory->delete();

        return redirect()->route('admin.subcategories.index')
            ->with('success', 'Subcategory soft-deleted successfully.');
    }

    // Trashed Items
    public function trash()
    {
        $trashedSubcategories = Subcategory::onlyTrashed()->paginate(20);
        return view('admin.subcategories.trash', compact('trashedSubcategories'));
    }

    // Restore Trashed Item
    public function restore($id)
    {
        $subcategory = Subcategory::onlyTrashed()->findOrFail($id);
        $subcategory->restore();

        return redirect()->route('admin.subcategories.index')
            ->with('success', 'Subcategory restored successfully.');
    }

    // Force Delete
    public function forceDelete($id)
    {
        $subcategory = Subcategory::onlyTrashed()->findOrFail($id);
        $subcategory->forceDelete();
        return redirect()->route('admin.subcategories.trash')
            ->with('success', 'Subcategory permanently deleted.');
    }
}