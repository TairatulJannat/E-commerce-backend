<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;



class ProductController extends Controller
{
    //
    public function addProduct(Request $request){
        // return $request;
        $product = new Product();
        $product->p_name = $request->input('p_name');
        $product->file_path = $request->file('file_path')->store('products');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->save();
        return $product;

    }

    public function list(){
        $product = Product::all();
        return $product;
    }

    public function delete($id){

        $result = Product::where('id',$id)->delete();
        if($result){
            return ["result"=>"Product has been delete"];
        }else{
            return ["result"=>"oparetion failed"];
        }

        return $result;

    }

    public function getProduct($id){
        
        $product = Product::find($id);
        return $product;

    }

    public function productUpdate(Request $request,$id)
        {

            $product=Product::find($id);
            // $product->file_path = $request->file('file_path')->store('products');
            $product->p_name = $request->input('p_name');
            $product->file_path = $request->file('file_path')->store('products');
            $product->description = $request->input('description');
            $product->price = $request->input('price');
            $product->update();
            
            return $product;

        }
        public function searchProduct($key){
            $product = Product::where('p_name','Like',"%$key%")->get();
            return $product;
        }
}
