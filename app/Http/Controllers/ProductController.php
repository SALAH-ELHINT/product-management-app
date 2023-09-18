<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Inertia\Inertia;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $query = Product::query();

        if (request()->has('search')) {
            $searchTerm = request()->input('search');
            
            $query->where(function ($query) use ($searchTerm) {
                $query->where('name', 'LIKE', '%' . $searchTerm . '%')
                      ->orWhere('description', 'LIKE', '%' . $searchTerm . '%')
                      ->orWhere('price', 'LIKE', '%' . $searchTerm . '%')
                      ->orWhere('size', 'LIKE', '%' . $searchTerm . '%')
                      ->orWhere('type', 'LIKE', '%' . $searchTerm . '%');
            });
        }


        if ($request->has('sort')) {
            $sortOption = $request->input('sort');
            switch ($sortOption) {
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'lowToHigh':
                    $query->orderBy('price', 'asc');
                    break;
                case 'highToLow':
                    $query->orderBy('price', 'desc');
                    break;
            }
        }

        $product = $query->paginate(10);

        return Inertia::render('Product/Index', [
            'products' => $product,
            'filters' => request()->all('search'),
        ]);        

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Product/Index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0.01',
            'size' => 'required|string|max:50',
            'type' => 'required|string|max:255',
        ]);

        Product::create($validatedData);        
        
        return redirect()->route('product.index')
        ->with('message', __('User created successfully.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('product.index')->with('error', 'Product not found.');
        }
        // return $product;
        return Inertia::render('Product/Show', [
            'product' => $product,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return Inertia::render('Product/Index');

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('product.index')->with('error', 'Product not found.');
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0.01',
            'size' => 'required|string|max:50',
            'type' => 'required|string|max:255',
        ]);

        $product->update($validatedData);

        return redirect()->route('product.index')->with('success', 'Product updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('product.index')->with('error', 'Product not found.');
        }

        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product deleted successfully.');    

    }
}
