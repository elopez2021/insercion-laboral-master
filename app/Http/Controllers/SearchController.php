<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    function search_business(Request $request){
        $request->validate([
            'query'=>'required|min:2'
         ]);

         $search_text = $request->input('query');
         $business = DB::table('businesses')
                    ->where('name','LIKE','%'.$search_text.'%')
                    ->orWhere('industry','like','%'.$search_text.'%')
                    ->orWhere('municipality','like','%'.$search_text.'%')
                    ->orWhere('province','like','%'.$search_text.'%')
                    ->paginate(15);
          return view('business.index',['businesses'=>$business]);
    }

    function search_offer(Request $request){
        $request->validate([
            'query'=>'required|min:2'
         ]);

         $search_text = $request->input('query');
         $offer = DB::table('offers')
                    ->where('name','LIKE','%'.$search_text.'%')
                    ->orWhere('salary','like','%'.$search_text.'%')
                    ->orWhere('business_id','like','%'.$search_text.'%')
                    ->orWhere('status','like','%'.$search_text.'%')
                    ->orWhere('schedule','like','%'.$search_text.'%')
                    ->orWhere('location','like','%'.$search_text.'%')
                    ->orWhere('salary','like','%'.$search_text.'%')
                    ->paginate(15);
          return view('offer.index',['offers'=>$offer]);
    }
}