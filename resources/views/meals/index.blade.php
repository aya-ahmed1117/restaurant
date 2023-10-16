@extends('layouts.app')

@section('content')

<div class="container" dir="rtl">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header bg-warning text-light text-center ">القائمة</div>
                    <div class="card-body text-right ">
                        <ul class="list-group ">
                            <a href="{{route('meal.index')}}" class="list-group-item list-group-item-action ">عرض
                                الوجبات</a>
                            <a href="{{ route('create_meal')}}" class="list-group-item list-group-item-action">إضافة
                                وجبة</a>
                            <a href="{{Route('home')}}" class="list-group-item list-group-item-action">طلبات المستخدمين</a>

                        </ul>
                    </div>
                </div>
            </div>


            <div class="col-md-9">
                <div class="card">
                    <div class="card-header bg-warning text-light text-center ">جميع الوجبات

                    </div>

        <div class="card-body">
           @if(session('message'))
                <div class="alert alert-success" role="alert">
                  {{session('message')}}
                </div>
      @endif
            <table class="table table-bordered text-center col-md">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">صورة الوجبة</th>
                        <th scope="col">اسم الوجبة</th>
                        <th scope="col">الوصف</th>
                        <th scope="col">الصنف</th>
                        <th scope="col">السعر ($)</th>
                        <th scope="col">تعديل</th>
                        <th scope="col">حذف</th>

                    </tr>

                </thead>
                <tbody>
           @if (count($allMeals)>0)
               @foreach ($allMeals as $meal=>$aID)
                <tr>
                    <th scope="row">{{$meal = $meal+1 }}</th>
                    <td><img src="{{asset($aID->imge)}}" width="80"></td>
                    <td>{{$aID->name}}</td>
                    <td>{{$aID->category}}</td>
                    <td>{{$aID->description}}</td>
                    <td>{{$aID->price}}</td>
                  
        <td><a href="{{route('meal.update',$aID->id)}}"><button class="btn btn-primary">تعديل</button></a></td>

        <td> <a href="{{ route('meal.delete',$aID->id) }}" class="btn btn-danger" id="delete">حذف</a></td>
                                
                </tr>
            @endforeach

            @else
                    <p>لا يوجد وجبات </p>
            @endif
              


                </tbody>
            </table>
                 {{ $allMeals->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection