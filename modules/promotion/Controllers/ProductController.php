<?php

namespace App\Http\Controllers;

use App\Eloquent\Category;
use App\Eloquent\Gallery;
use App\Eloquent\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json(Product::with(['categories', 'gallery'])->get(), 200);
    }

    public function show(Product $product)
    {
        return response()->json($product->load(['gallery', 'categories']));
    }

    public function create()
    {
        $validator = Validator::make(request()->all(), [
            'title' => 'required',
            'description' => 'required',
            'categories' => 'required|array'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $product = Product::query()->create([
            'title' => request()->input('title'),
            'description' => request()->input('description'),
        ]);

        $product->categories()->sync(request()->input('categories'));

        if (request()->hasFile('gallery')) {
            foreach (request()->file('gallery') as $file) {
                $gallery_item = $file->storeAs('/public', Str::random(40) . '.' . $file->getClientOriginalExtension());
                $product->gallery()->save(new Gallery(['url' => Str::replaceFirst('public', '', $gallery_item)]));
            }
        }

        return response()->json(['message' => 'Product created successfully'], 200);
    }

    public function update(Product $product)
    {
        $product->title = request()->input('title');

        $product->description = request()->input('description');

        $product->save();

        $product->categories()->sync(request()->input('categories'));

        if (request()->hasFile('gallery')) {
            $product->gallery()->delete();
            foreach (request()->file('gallery') as $file) {
                $file = $file->storeAs('/public', Str::random(40) . '.' . $file->getClientOriginalExtension());
                $product->gallery()->save(new Gallery(['url' => Str::replaceFirst('public', '', $file)]));
            }
        }

        return response()->json(['message' => 'Product updated'], 200);
    }

    public function delete(Product $product)
    {
        $product->delete();

        return response()->json([], 200);
    }

    public function filter(Category $category)
    {
        return response()->json($category->products->load('gallery'), 200);
    }
}
