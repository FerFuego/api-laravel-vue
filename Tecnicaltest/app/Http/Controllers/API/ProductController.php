<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Product;
use Validator;
use Carbon\Carbon;
use App\Http\Resources\Product as ProductResource;

class ProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
    
        return $this->sendResponse(ProductResource::collection($products), 'Products retrieved successfully.');
    }

    /**
     * Display the specified resource.
     * 
     * @param date $date
     * @return \Illuminate\Http\Response
     */
    public function show($rate) 
    {
        $product = Product::join('rates', 'products.id', '=', 'rates.product_id')
                        ->where('rates.start_date','<=', $rate)
                        ->where('rates.end_date','>=', $rate)
                        ->get(['products.*','rates.price','rates.start_date','rates.end_date']);

        if (is_null($product)) {
            return $this->sendError('Product not found.');
        }

        return $this->sendResponse(new ProductResource($product), 'Product retrieved successfully.');
    }

    public function store(Request $request) 
    {
        return $this->sendError('Method not allowed.');
    }

    public function update(Request $request) 
    {
        return $this->sendError('Method not allowed.');
    }

    public function destroy() 
    {
        return $this->sendError('Method not allowed.');
    }

}