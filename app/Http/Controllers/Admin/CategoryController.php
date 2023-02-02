<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $attr = $request->validate([
            'category_name' => 'required|string|unique:categories|max:250',
            'status' => 'required'
        ]);

        try {
            $data = Category::create($attr);
            if ($data) {
                return to_route('category.index')->with('message', 'Category Successfully created!');
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update(Request $request){
        if ($request->ajax()) {
            $category = Category::find($request->id);
            if($category){
                return response()->json($category, 200);
            }else{
                $errors = "Don't be sneaky!";
                return response()->json(['errors' => $errors], 200);
            }
        }

        $attr = $request->validate([
            'category_name' => 'reuired|string|max:250|unique:categories,id,'.$request->category_id,
            'status' => 'required'
        ]);

        try {
            $data = Category::findOrFail($request->category_id);
            if ($data) {
                $data->update($attr);
                return to_route('category.index')->with('message', 'Category successfully updated');
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }


}
