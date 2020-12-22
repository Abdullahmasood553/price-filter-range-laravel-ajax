<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use App\Product;

class UserController extends Controller
{

    public function range_filter(Request $request) {
        $products = Product::paginate(6);
        return view('product_filter_range', compact('products'));
    }


    // public function filter_product_range(Request $request) {
    //     if ($request->ajax() && isset($request->minimum_range)) { 
    //         $start = $request->minimum_range; // min price value
    //         $end = $request->maximum_range; // max price value
    //         $products = DB::table('products')
    //         ->where('price', '>=', $start)->where('price', '<=', $end)->orderby('price', 'ASC')->paginate(6);
    //         response()->json($products); //return to ajax
    //         $output = '';
    //         if(!$products->isEmpty()) {
    //             foreach($products as $row) {
    //                 $output .= '<div class="card">
    //                 <img src="'.'assets/img/'.$row->image.'" alt="image">
    //                 <div class="card-body">
    //                 <span class = "tag tag-teal">$ '.$row->price.'</span>
    //                     <p class="card-title">'.$row->name.'</p>
    //                 </div>
    //             </div>';
    //             }
    //         } else {
    //             $output .= '
    //             <div id="load_more">
    //                 <p>No Data Found</p>
    //             </div>';
    //         }
    //         echo $output;
    //     }   
    // }


        public function filter_product_range(Request $request) {
        if ($request->ajax() && isset($request->minimum_range)) { 
            $start = $request->minimum_range; // min price value
            $end = $request->maximum_range; // max price value
            $products = DB::table('products')
            ->where('price', '>=', $start)->where('price', '<=', $end)->orderby('price', 'ASC')->paginate(6);
            response()->json($products); //return to ajax
            $output = '';
            if(!$products->isEmpty()) {
                foreach($products as $row) {
                    $output .= '<div class="card">
                    <div class="card-header">
                        <img src="'.'assets/img/'.$row->image.'" alt="image">
                    </div>
                    <div class="card-body">
                        <span class="tag tag-teal">$ '.$row->price.'</span>
                           <p>'.$row->name.'</p>
                    </div>
                </div>';
                }
            } else {
                $output .= '
                <div id="load_more">
                    <p>No Data Found</p>
                </div>';
            }
            echo $output;
        }   
    }
}
