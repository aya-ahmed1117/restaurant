<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\CategoryControl;
use App\Models\Category;
use App\Models\Meal;
use App\Models\Orders;
use Carbon\Carbon;

class visitorController extends Controller
{
    public function index(Request $Request){

    	$cats =Category::all();
        $meals = Meal::all();
        // return view('home');
    
            if(!$Request->category){
                $page='الصفحة الرئيسية';
        $meals = Meal::all();
        return view('visitorPage' , compact('cats','meals','page'));
    }else{
        $page=$Request->category;
        $meals = Meal::where('category',$Request->category)->get();
        return view('visitorPage' , compact('cats','meals','page'));

        }
    
       // return view('visitorPage');
    
    }

}
