<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductController extends Controller implements FromCollection
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
            $params['photo'] = $fileName;
            $request->file->move( public_path('storage'), $fileName );
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
    public function update(ProductRequest $request, Product $product)
    {
        $params = $request->all();
        
        if ( $request->file ) {
            $fileName = time() . '_' . $request->file->getClientOriginalName();
            $params['photo'] = $fileName;
            $request->file->move( public_path('storage'), $fileName );
        }

        $categories = explode(',', $request->categories );

        $product->categories()->detach();

        foreach ( $categories as $key => $category ) {
            $product->categories()->attach( $category );
        }

        $product->fill($params)->update();

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

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::all();
    }
}
