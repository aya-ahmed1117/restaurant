


@extends('layouts.app')

@section('content')

<style type="text/css">
    a.list-group-item{
        background-color: #eee ;
        color: #12956d;
        font-size: 18px;
    }
    a.list-group-item:hover{
        background-color: #12956d ;
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
        <div class="col-md-4">
            <div class="card">
                <div class="card-header justify-content-center ">{{ __('جميع الاصناف') }}</div>

                <div class="card-body text-right">
                    <form action="" method="get">
                        @csrf
                        <a class="list-group-item list-group-item-action" 
                        href="/">جميع  الوجبات</a>

                        @foreach ($cats as $cat_name)

                        <input type="submit" name="category" class="list-group-item list-group-item-action" value="{{$cat_name->cat_name}}">
                        @endforeach

                    </form>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                
                </div>
            </div>

             <div class="card">
                <div class="card-header justify-content-center ">
                {{ __('الطبات السابقة') }}</div>

                <div class="card-body text-right">
                    <form action="" method="get">
                        @csrf
                        <a class="list-group-item list-group-item-action" 
                        href="/order/show">إظهار الطلبات السابقة</a>

                    </form>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                
                </div>
            </div>
        </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5>{{$page}}</h5>
                    عدد الوجبات   ({{count($meals)}})</div>
                    <div class="card-body">
                        <div class="row"> 

                        @if(count($meals)>0)

                        @foreach($meals as $meal)

    <div class="col-md-4 mt-3 text-center card" style="width: 18rem; border-radius: 2px solid gray;">
          <img class="img-thumbnail" src="{{asset($meal->imge)}}" alt="Card image cap"style="width: 100%;height: 100%;">

          <div class="card-body">
            <h5 class="card-title">{{$meal->name}}</h5>
            <p class="card-text">{{$meal->description}}</p>
            <a href="{{route('meal_details',$meal->id)}}" class="btn btn-success">أطلب الآن</a>
          </div>
        </div>
    @endforeach

    @else
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>Holy guacamole!</strong> No Meals is available
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>

    @endif


                    </div>
                    
                </div>
            </div>
        </div>
    </div>


@endsection
