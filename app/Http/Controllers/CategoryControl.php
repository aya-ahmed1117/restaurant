<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CategoryControl extends Controller
{
    public function shows(){
      $cats = Category::paginate();

      return view('category.categoryPage', compact('cats'));
    }

    // add cate 
    public function store(request $request){
      $request->validate(['cat_name' =>'required|string|unique:categories|min:3|max:40',]);

      Category::insert([
        'cat_name' => $request->cat_name,
        'created_at' =>Carbon::now()
      ]);

    return back()->with('message','تم إضافة صنف جديد');


    }
    //delete
    public function delete($id){
      Category::find($id)->delete();
      return redirect()->route('cat.shows')->with('message','تم مسح الصف بنجاح');
    }//

    public function update(request $request){
      $request->validate([
        'cat_name'=>'required|string|unique:categories|min:3|max:40',
      ]);
      $id=$request->id;
      Category::findOrFail($id)->update([
        'cat_name'=>$request->cat_name,
      ]);
      return redirect()->route('cat.shows')->with('message','تم تعديل الصنف');
    }

}
