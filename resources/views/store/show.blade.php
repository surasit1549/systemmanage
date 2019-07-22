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
      <div class="card-header">
        <h3 class="text-white"><i class="far fa-file"></i>&nbsp;&nbsp;ข้อมูลร้านค้า</h3>
      </div>
      <div class="card-body">
          <table class="table table-borderless">
            <tr>
              <td class="text-right">
                <h5>รหัสร้านค้า</h5>
              </td>
              <td class="text-right">
                <input type="text" class="form-control col-md-6" disabled value="{{$store->keystore}}">
              </td>
            </tr>
            <tr>
              <td class="text-right">
                <h5>ร้านค้า</h5>
              </td>
              <td class="text-right">
                <input type="text" class="form-control col-md-6" disabled value="{{$store->name}}">
              </td>
            </tr>
            <tr>
              <td class="text-right">
                <h5>ที่อยู่</h5>
              </td>
              <td class="text-right">
                <textarea rows="5" class="form-control col-md-6" disabled>{{$store->address}}</textarea>
              </td>
            </tr>
            <tr>
              <td class="text-right">
                <h5>โทรศัทท์</h5>
              </td>
              <td class="text-right">
                <input type="text" class="form-control col-md-6" disabled value="{{$store->phone}}">
              </td>
            </tr>
            <tr>
              <td class="text-right">
                <h5>โทรสาร</h5>
              </td>
              <td class="text-right">
                <input type="text" class="form-control col-md-6" disabled value="{{$store->fax}}">
              </td>
            </tr>
            <tr>
              <td class="text-right">
                <h5>ผู้ติดต่อ</h5>
              </td>
              <td class="text-right">
                <input type="text" class="form-control col-md-6" disabled value="{{$store->contect}}">
              </td>
            </tr>
            <tr>
              <td class="text-right">
                <h5>เบอร์ผู้ติดต่อ</h5>
              </td>
              <td class="text-right">
                <input type="text" class="form-control col-md-6" disabled value="{{$store->cellphone}}">
              </td>
            </tr>
          </table>

        <div class="text-center">
          <a class="btn btn-danger" href="{{route('store.index')}}"><i class="fas fa-undo"></i>&nbsp;&nbsp;ย้อนกลับ</a>
        </div>
  </div>
</div>
    </div>
  </div>
</div>
@endsection
