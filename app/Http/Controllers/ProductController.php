<?php

namespace App\Http\Controllers;

use view;
use App\Models\Product;
use Illuminate\Support\str;
use App\Services\ConvertPriceService;
use App\Traits\ConvertPrice;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{

    use ConvertPrice;

    protected $usd_price;
    public function __construct(ConvertPriceService $convertPrice)
    {
        $this->usd_price = $convertPrice;
    }
    public function index()
    {
        $products = Product::paginate(10);

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $productData = $request->validated();
        // $productData['slug'] = str::slug($productData['name']);

        // $productData['price_usd'] = $this->convertToUSD($productData['price']); // Convert Price by Traits

        // $productData['price_usd'] = $this->usd_price->convertToUSD($productData['price']); // Convert Price by service

        $productData['price_usd'] = convertToUSD($productData['price']); // Convert Price by helpers or global function

        // dd($productData);

        $product = Product::create($productData);

        return redirect()->route('products.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return response()->view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $productdata = $request->validated();
        // $productdata['slug'] = str::slug($productdata['name']);
        $product->update($productdata);

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return response()->view('products.show', compact('product'));
    }
}
