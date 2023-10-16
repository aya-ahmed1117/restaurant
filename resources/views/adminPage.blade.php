@extends('layouts.app')

@section('content')

<div class="container" dir="rtl">
    <div class="row ">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-warning">
                    <li class="breadcrumb-item active " aria-current="page">طلبات الزبائن</li>
                </ol>
            </nav>

            <div class="card">
                <div class="card-header">
                    <a style="float:right;" href="{{ route('cat.shows')}}"><button class="bnt btn-success btn-default"
                            style="margin-left:6px ;">إضافة صنف جديد </button></a>

                    <a style="float:right;" href="{{route('create_meal')}}"><button class="bnt btn-danger btn-default" 
                            style="margin-left:6px ;">إضافة وجبة </button></a>
                    <a style="float:right;" href="{{route('meal.index')}}"><button class="bnt btn-info btn-default"
                            style="margin-left:6px ;">عرض الوجبات</button></a>

                </div>

    <table class="table align-middle mb-0 bg-white table-hover" style="overflow:auto; ">
      <thead class="bg-light">
        <tr>
            <th scope="col">الاسم</th>
            <th scope="col">الايميل</th>
            <th scope="col">الهاتف</th>
            <th scope="col">التاريخ</th>
            <th scope="col">الوقت</th>
            <th scope="col">اسم الوجبة</th>
            <th scope="col">العدد</th>
            <th scope="col">سعر الوجبة($)</th>
            <th scope="col">المجموع ($)</th>
            <th scope="col">العنوان</th>
            <th scope="col">الحالة </th>
            <th scope="col">القبول</th>
            <th scope="col">رفض الطلب</th>
            <th scope="col">إتمام الطلب</th>
        </tr>
      </thead>
      <tbody>

    @foreach ($orders as $row)
        <tr>

            <td>
        <div class="d-flex align-items-center">
          <!-- <img
              src="https://mdbootstrap.com/img/new/avatars/8.jpg"
              alt=""
              style="width: 45px; height: 45px"
              class="rounded-circle"
              /> -->
          <div class="ms-3">
            <p class="fw-bold mb-1">{{ $row->order_user->name }}</p>
          </div>
        </div>
      </td>
      <td><p class="text-muted mb-0" style="justify-content: space-between;">{{ $row->order_user->email }}</p></td>
            
            <td>
        <p class="fw-normal mb-1">{{ $row->phone }}</p>
        <p class="text-muted mb-0">{{ $row->phone }}</p>
        </td>
            <td>{{ $row->date }}</td>
            <td>{{ $row->time }}</td>

            <td>{{ $row->order_meal->name }}</td>
            <td>{{ $row->qty }}</td>
            <td>${{ $row->order_meal->price }}</td>
            <td>${{ $row->order_meal->price * $row->qty }}</td>
            <td>{{ $row->address }}</td>




            @if ($row->status =='pending')
<!-- class="text-light bg-secondary" -->
                <td >
                    <span class="badge badge-secondary rounded-pill d-inline">
                    {{ $row->status=='تتم مراجعة الطلب' }}
                </span></td>

            @endif

            @if ($row->status == 'رفض')

                <td>
                    <span class="badge badge-danger rounded-pill d-inline">
                    {{ $row->status }}</span></td>

            @endif

            @if ($row->status == 'قبول')

                <td >
                    <span class="badge badge-primary rounded-pill d-inline">{{ $row->status }}</span></td>

            @endif

            @if ($row->status == 'إتمام')

                <td ><span class="badge badge-success rounded-pill d-inline">
                    {{ $row->status }}</span></td>

            @endif

            <form action="{{route('order.status',$row->id)}}" method="post">
                @csrf

                <td>
                    <input name="status" type="submit" value="قبول"
                        class="btn btn-primary btn-sm">
                </td>

                <td>
                    <input name="status" type="submit" value="رفض"
                        class="btn btn-danger btn-sm">
                </td>
                <td>
                    <input name="status" type="submit" value="إتمام"
                        class="btn btn-success btn-sm">
                </td>

            </form>





        </tr>
    @endforeach

    
                       </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@if(session('message'))
                <div class="alert alert-success" role="alert">
                  {{session('message')}}
                </div>
      @endif
@endsection