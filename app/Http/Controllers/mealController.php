<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Intervention\Image\facades\Image;
use App\Models\Meal;
use Carbon\Carbon;


class mealController extends Controller
{

	//index meal
	public function index(){
		//all()
		$allMeals = meal::paginate(3);

		return view('meals.index' , compact('allMeals'));
	}
	//view meals
    public function create(){
    	$cats2 = Category::latest()->get();
    	return view('meals.create_meal',compact('cats2'));
    }
    //add
    public function store(Request $Request){
    	$Request->validate([
    		'name'=>'required|string|min:3|max:50',
    		'description'=>'required|min:3|max:400',
    		'price'=>'required|numeric',
    		'imge'=>'required|mimes:png,jpg,jpeg,gif,ico,icon',
    	]);
//hexdec(uniqid())
    	$images = $Request->file('imge');
    	  $image_name = time().'.'.$images->getClientOriginalExtension();
    	  Image::make($images)->resize(300, 200)->save('upload/meals/'.$image_name);
    	  $save_url = 'upload/meals/'.$image_name;

    	  Meal::insert([
    	  	'category'=>$Request->category,
    	  	'name'=>$Request->name,
    	  	'description'=>$Request->description,
    	  	'price'=>$Request->price,
    	  	'imge'=>$save_url,
	        'created_at' =>Carbon::now(),
    	  ]);
    	  $notification = array(
			'message_id' => 'تم إضافة الوجبة بنجاح',
			'alert-type' => 'success'
		);
        
        return redirect()->back()->with($notification);
    }
    //start to update
    public function update($id){
    	$meals = Meal::find($id);
    	$cats2 = category::latest()->get();
    	return view('meals.update_meal' , compact('meals','cats2'));
    }

    ///edit 
    public function edit(Request $Request,$id){
    	$old_image = $Request->old_image;
    	if($Request->file('imge')){
    		unlink($old_image);//remove pld file
    		//add new image
    		$sora = $Request->file('imge');

    		$image_new = time().'.'.$sora->getClientOriginalExtension();
    		image::make($sora)->resize(300,300)->save('upload/meals/'.$image_new);
    		$saved_url = 'upload/meals/'.$image_new;
    		meal::findOrFail($id)->update([
				'category'=>$Request->category,
				'name'=>$Request->name,
				'description'=>$Request->description,
				'price'=>$Request->price,
				'imge'=>$saved_url,
				'updated_at'=>Carbon::now(),
    		]);

    		 $notification = array(
			'message_id' => 'تم تعديل الوجبة بنجاح',
			'alert-type' => 'info'
		);

        return redirect()->route('meal.index')->with($notification);


    	}
    	else{
    		meal::findOrFail($id)->update([
				'category'=>$Request->category,
				'name'=>$Request->name,
				'description'=>$Request->description,
				'price'=>$Request->price,
				'updated_at'=>Carbon::now(),
    		]);

    		 $notification = array(
			'message_id' => 'تم تعديل الوجبة بنجاح',
			'alert-type' => 'info'
		);

        return redirect()->route('meal.index')->with($notification);


    	}

    }

    //delete meal
    public function delete($id){
    	///$dele_me = ;
    	meal::find($id)->delete();


    	 $notification = array(
			'message_id' => 'Meal hase been deleted Successfully',
			'alert-type' => 'success'
		);

        return redirect()->route('meal.index')->with($notification);
    }

    //meal_details

    public function meal_details($id){

        $details=meal::findOrFail($id);
        return view('meals.meal_details',compact('details'));
    }

    
}
