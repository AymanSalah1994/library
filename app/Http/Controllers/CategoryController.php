<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    //
    public function index()
    {
        $allCategories  = Category::paginate(2);
        return view('Categories/index', compact('allCategories'));
    }

    public function show($id)
    {
        $category = Category::findorfail($id);
        return view('Categories/show', compact('category'));
    }

    public function  create()
    {
        return view('categories/create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'string|required|max:100',
        ]);

        Category::create(
            [
                // TODO : in the HTMl file 
                'name' => $request->name,
            ]
        );
        return redirect(route('Categories.all'));
    }

    public function edit($id)
    {
        $editedCategory = Category::findorfail($id);
        return view('Categories/edit', compact('editedCategory'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'string|required|max:100',
        ]);

        $category = Category::findorfail($id);


        $category->update([
            'name' => $request->name,
        ]);
        return redirect(route('Categories.edit', $id));
    }

    public function delete($id)
    {
        $category = Category::findorfail($id);
        $category->delete();
        return redirect(route('Categories.all'));
    }
}
