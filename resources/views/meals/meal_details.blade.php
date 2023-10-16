

@extends('layouts.app')

@section('content')

   <style type="text/css">
    a.list-group-item{
        background-color: #12956d;
        color: #eee;
        font-size: 18px;
    }
    input.list-group-item{
        /*background-color: #eee;*/
        color: darkblue;
    }
    input.list-group-item:hover{
        color: darkblue;
        
        background-color: lightgreen;
    }
    .card-header{
        /*background-color: rgb(61,114,56);*/
        background-color: #12956d;
        color: #eee;
        font-size: 20px;
    }
    
</style>

<div class="container" dir="rtl">
    <div class="row justify-content-center">
        
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5></h5>
                        الوجبة
                    </div>

    <div class="card-body">
        <div class="row"> 
		  <div class="col-md-6  text-right" >
	    	<p>
	    		<h3><strong style="color: green;">
	    			نوع الوجبة
	    			: 
	    		</strong>
	    		{{$details->category}}
	    		</h3>

	    	</p>
	    	<p>
	    		<h3><strong style="color: green;">
	    			إسم الوجبة:
	    		</strong>
	    		{{$details->name}}
	    		</h3>
	    	</p>
	    	<p>
	    		<h3><strong style="color: green;">
	    			سعر الوجبة:
	    		</strong>
	    		{{$details->price}}
	    		</h3>
	    	</p>
	    	<p>
	    		<h3><strong style="color: green;">
	    			ممكزنات الوجبة:
	    		</strong>
	    		<br>
	    		{{$details->description}}
	    		</h3>
	    	</p>

		    </div>

			<div class="col-md-6">
		        <img class="img-thumbnail" src="{{asset($details->imge)}}" alt="Card image cap"style="width: 500%;">
			</div>

                </div>
            </div>
        </div>
    </div>

        <div class="col-md-4">
            <div class="card">
        <div class="card-header justify-content-center ">{{ __('جميع الاصناف') }}</div>
      <div class="card-body text-right">
        <form action="{{route('order.store')}}" method="post">
            @csrf

            @if(@Auth::check())
   <div class="form-group">
    <p>
    	  <strong style="color: seagreen;font-size: 18px;">الإسم:</strong> {{ @Auth::user()->name; }}<br></p>
    <p>
    	  <strong style="color: seagreen;font-size: 18px;">الإيميل:</strong> {{ @Auth::user()->email;}}</p>
    <p>
    	  <strong style="color: seagreen;font-size: 18px;">رقم الهاتف:</strong><input type="number" name="phone" class="form-control" required></p>
    <p>
    	<input type="hidden" name="meal_id" value="{{ $details->id }}">
    	  <strong style="color: seagreen;font-size: 18px;">العدد:</strong><input type="number" name="qty" class="form-control" value="0"></p>
    <p>
    	  <strong style="color: seagreen;font-size: 18px;">التاريخ:</strong><input type="date" name="date" class="form-control" required></p>
    <p>
    	  <strong style="color: seagreen;font-size: 18px;">الوقت:</strong><input type="time" name="time" class="form-control" required></p>
    <p>
    	  <strong style="color: seagreen;font-size: 18px;">العنواو:</strong><textarea class="form-control"name="address" rows="2"required placeholder="اضف عنوانك هنا"></textarea></p>
    <p class="text-center">
    	<button class="btn btn-success" type="submit">أطلب الآن</button>
    </p>
   </div>       

        </form>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @else
                <p><a href="/login">يجب ان تقوم بتسجيل الدخول أولا</a></p>

                    @endif

                
                </div>
            </div>
        </div>
    </div>



@endsection