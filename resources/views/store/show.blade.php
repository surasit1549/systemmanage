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
          @foreach($store as $row)
          <tr>
            <td>{{$row['id']}}</td>
            <td>{{$row['keystore']}}</td>
            <td>{{$row['name']}}</td>
            <td>{{$row['address']}}</td>
            <td>{{$row['phone']}}</td>
            <td>{{$row['fax']}}</td>
            <td>{{$row['contect']}}</td>
            <td>{{$row['cellphone']}}</td>
          </tr>
          @endforeach
        </table>
        <a href="{{route('store.index')}}">กลับ</a>
      </form>
    </div>
  </div>
</div>
@endsection
