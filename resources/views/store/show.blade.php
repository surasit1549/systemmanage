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
    <div class="card">
      <div class="card-header" style="background-color:#435d7d;">
        <h3 class="text-white"><i class="far fa-file"></i>&nbsp;&nbsp;ข้อมูลร้านค้า</h3>
      </div>
      <div class="card-body">
          <table class="table table-borderless">
            <tr>
              <td class="text-right">
                <h5>รหัสร้านค้า</h5>
              </td>
              <td class="text-right">
                <input type="text" class="form-control" disabled value="{{$store->keystore}}">
              </td>
            </tr>
            <tr>
              <td class="text-right">
                <h4>ร้านค้า</h4>
              </td>
              <td class="text-right">
                <input type="text" class="form-control" disabled value="{{$store->name}}">
              </td>
            </tr>
            <tr>
              <td class="text-right">
                <h4>ที่อยู่</h4>
              </td>
              <td class="text-right">
                <input type="text" class="form-control" disabled value="{{$store->address}}">
              </td>
            </tr>
            <tr>
              <td class="text-right">
                <h4>โทรศัทท์</h4>
              </td>
              <td class="text-right">
                <input type="text" class="form-control" disabled value="{{$store->phone}}">
              </td>
            </tr>
            <tr>
              <td class="text-right">
                <h4>โทรสาร</h4>
              </td>
              <td class="text-right">
                <input type="text" class="form-control" disabled value="{{$store->fax}}">
              </td>
            </tr>
            <tr>
              <td class="text-right">
                <h4>ผู้ติดต่อ</h4>
              </td>
              <td class="text-right">
                <input type="text" class="form-control" disabled value="{{$store->contect}}">
              </td>
            </tr>
            <tr>
              <td class="text-right">
                <h4>เบอร์ผู้ติดต่อ</h4>
              </td>
              <td class="text-right">
                <input type="text" class="form-control" disabled value="{{$store->cellphone}}">
              </td>
            </tr>
          </table>

          
        <a href="{{route('store.index')}}">กลับ</a>
  </div>
</div>
    </div>
  </div>
</div>
@endsection
