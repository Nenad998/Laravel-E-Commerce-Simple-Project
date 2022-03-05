<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function showNewCategoryForm()
    {
        return view('category.newCategory');
    }

    public function createNewCategory(Request $request)
    {
        $request->validate([
            'name'=> 'required|string|min:3'
        ]);

        $name = $request->name;

        $category = new Category();
        $category->name = $name;
        $category->save();

        return redirect('/admin')->with('message', 'category successfully created');

    }
}
