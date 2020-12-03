<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResources;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
// namespace App\Http\Controllers\API;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ("all producuts");
    }
  
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        $product=new product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->users_id=$request->users_id;
        $product->review=$request->review;
        $product->save();
        return response()->json($product);
    }

    
    public function show(Request $request)
    {
        

    if(isset($request->price['starting_price']) &&
      isset($request->price['end_price']) && 
      isset($request->name['name'])){
          $product=Product::where('name','like','%'.$request->name.'%')
          ->whereBetween('price',array($request->price['starting_price'],$request->price['end_price']))
          ->get();
      }
      elseif(isset($request->price['starting_price']) &&
      isset($request->price['end_price'])){
          $product=Product::whereBetween('price',array($request->price['starting_price'],$request->price['end_price']))
          ->get();
      }
        elseif(isset($request->name))
        {
            $product=Product::where('name','like','%'.$request->name.'%')->get();
        }
        elseif(isset($request->users_id)){
            $product=Product:: with('User')->where('users_id',array($request->users_id))->get();
        }
        else{
            $product=Product::get();
        }
       
        return response()->json(new ProductResources($product));
        // return view('show',compact('product'));
        return response()->json($product);
}
    
    


    public function edit($id)
    {
        
    }

    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy($id)
    {
        //
    }
}
