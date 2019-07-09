@extends('Home.master')
@section('title','ประวัติของผู้ใช้ระบบ')
@section('tabbarcss')
  <style>
    #storetab {
      border-right : 5px solid rgb(41, 207, 219);
    }
  }
  </style>
@stop
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12"> <br />
      <h3 align="center">ประวัติของร้านค้า</h3> <br />
      <form method="post" action="{{action('StoreController@show', $id)}}">
        {{csrf_field()}}
        <table class="table table-bordered table-striped">
          <tr>
            <th>ลำดับ</th>
            <th>รหัสร้านค้า</th>
            <th>ร้านค้า</th>
            <th>ที่อยู่</th>
            <th>โทรศัทท์</th>
            <th>โทรสาร</th>
            <th>ผู้ติดต่อ</th>
            <th>เบอร์ผู้ติดต่อ</th>
          </tr>
          
          <tr>
            <td>{{$store->id}}</td>
            <td>{{$store->keystore}}</td>
            <td>{{$store->name}}</td>
            <td>{{$store->address}}</td>
            <td>{{$store->phone}}</td>
            <td>{{$store->fax}}</td>
            <td>{{$store->contect}}</td>
            <td>{{$store->cellphone}}</td>
          </tr>
          
        </table>
        <a href="{{route('store.index')}}">กลับ</a>
      </form>
    </div>
  </div>
</div>
@endsection
