<?php

namespace App\Http\Controllers;

use App\Category;
use App\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json(Category::all(), 200);
    }

    public function create()
    {
        $validator = Validator::make(request()->all(), [
            'title' => 'required|unique:categories',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $category = Category::query()->create([
            'title' => request()->input('title'),
            'description' => request()->input('description'),
        ]);

        return response()->json(['message' => 'Category created successfully', 'category' => $category], 200);
    }

    public function update(Category $category)
    {
        $validator = Validator::make(request()->all(), [
            'title' => 'required|unique:categories',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Category updated', 'errors' => $validator->errors()], 400);
        }

        $category->title = request()->input('title');

        $category->description = request()->input('description');

        $category->save();

        $category = Category::find($category->id);

        return response()->json(['message' => 'Category updated', 'category' => $category], 200);
    }

    public function delete(Category $category)
    {
        $category->delete();

        return response()->json([], 200);
    }
}
