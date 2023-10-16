<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\CategoryControl;
use App\Models\Category;
use App\Models\Meal;
use App\Models\Orders;
use Carbon\Carbon;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $Request)
    {
        $cats =Category::all();
        $meals = meal::all();
        $orders=Orders::orderBy('id','DESC')->get();

        if(auth()->user()->is_admin == 1){
            return view('adminPage',compact('orders'));

        }
        else{
            if(!$Request->category){
                $page='الصفحة الرئيسية';
        $meals = meal::all();
        return view('userPage' , compact('cats','meals','page'));
    }else{
        $page=$Request->category;
        $meals = meal::where('category',$Request->category)->get();
        return view('userPage' , compact('cats','meals','page'));

        }
    }

    }

    //order_store
    public function order_store(Request $Request){
   $meals = meal::all();
        Orders::insert([
            'user_id'=>Auth()->user()->id,
            'phone'=>$Request->phone,
            'date'=>$Request->date,
            'time'=>$Request->time, 
            'meal_id'=>$Request->meal_id,
            'qty'=>$Request->qty,
            'address'=>$Request->address,
            'status'=>'pending',
            'created_at'=>Carbon::now(),
            ]);

         $notification = array(
            'message_id' => 'تم طلب الوجبة بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('home')->with($notification);
    }

    public function show_order(){
        //$ordrs=order::paginate();
        $orders=Orders::where('user_id',Auth::user()->id)->get();

        return view('orders.show_orders',compact('orders'));
    }

    public function show_Huser(){
        $meals = meal::where('user_id',Auth::user()->id)->get();
        return view('adminPage',compact('meals'));
    }

    public function changeStatus(Request $Request ,$id){
        $status=Orders::find($id);
        Orders::where('id',$id)->update(
            ['status'=>$Request->status]
        );
        

         $notification = array(
            'message_id' => 'تم التعديل بنجاح',
            'alert-type' => 'success'
        );

         return redirect()->route('home')->with('message','تم تغيير حالة الطلب بنجاح',$notification);

    }
}
