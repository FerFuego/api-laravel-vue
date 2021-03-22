<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::orderBy('id', 'DESC')->with('categories')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $params = $request->all();

        if ( $request->file ) {
            $fileName = time() . '_' . $request->file->getClientOriginalName();
            $params['file'] = $fileName;
            $request->file->move( public_path('uploads'), $fileName );
        }

        $product = Product::create($params);

        $categories = explode(',', $request->categories );

        foreach ( $categories as $category ) {
            $product->categories()->attach( $category );
        }

        return $product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\ProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $params = $request->all();
        
        if ( $request->file ) {
            $fileName = time() . '_' . $request->file->getClientOriginalName();
            $params['file'] = $fileName;
            $request->file->move( public_path('uploads'), $fileName );
        }

        $product->fill($params)->update();

        $categories = explode(',', $request->categories );

        $product->categories()->detach();

        foreach ( $categories as $category ) {
            $product->categories()->attach( $category );
        }

        return $product;
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
    }
}
