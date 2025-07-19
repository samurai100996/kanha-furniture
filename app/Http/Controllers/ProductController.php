<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');
        
        // Filter by category if provided
        if ($request->has('category') && $request->category != '') {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('name', $request->category);
            });
        }
        
        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        $products = $query->paginate(12);
        $categories = Category::all();
        
        return view('products.index', compact('products', 'categories'));
    }
    
    public function show($slug)
    {
        $product = Product::with('category')->where('slug', $slug)->firstOrFail();
        
        // Get related products from the same category
        $relatedProducts = Product::with('category')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();
            
        return view('products.show', compact('product', 'relatedProducts'));
    }
    
    public function search(Request $request)
    {
        $query = $request->get('q');
        
        $products = Product::with('category')
            ->where('name', 'like', '%' . $query . '%')
            ->orWhere('description', 'like', '%' . $query . '%')
            ->limit(10)
            ->get();
        
        // Return JSON for AJAX requests
        if ($request->expectsJson()) {
            return response()->json([
                'products' => $products->map(function ($product) {
                    return [
                        'id' => $product->id,
                        'name' => $product->name,
                        'slug' => $product->slug,
                        'price' => number_format($product->hasDiscount() ? $product->discounted_price : $product->price, 2),
                        'category' => $product->category->name,
                        'image' => $product->image,
                    ];
                })
            ]);
        }
        
        // For regular HTTP requests, paginate the results
        $products = Product::with('category')
            ->where('name', 'like', '%' . $query . '%')
            ->orWhere('description', 'like', '%' . $query . '%')
            ->paginate(12);
            
        return view('products.search', compact('products', 'query'));
    }
}
