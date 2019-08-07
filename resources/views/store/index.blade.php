@extends('Home.master')
@section('title','welcome Homepage')
@section('tabbarcss')
<style>
  #storetab {
    border-right: 5px solid rgb(41, 207, 219);
  }

  #searchtext:focus {
    outline: none !important;
    box-shadow: none;
  }
</style>
@stop
@section('content')
<script>
  $(document).ready(function() {

    $('[data-toggle="tooltip"]').tooltip();
    $('table').DataTable();
    $('.test').click(function() {
      $(this).next('form').submit();
    });
  });
</script>



@if(\Session::has('success'))
<div class="alert alert-success alert-dismissible fade show">
  <a><i style="font-size:20px" class="far fa-check-circle "></i>&nbsp;&nbsp;{{\Session::get('success')}}</a>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

<div class="form-row col-md-12">
  <div class="form-group">
    <a class="btn btn-sm btn-success text-white" href="{{route('store.create')}}">
      <i class="fas fa-plus"></i>
      เพิ่มร้านค้า
    </a>
  </div>
  <div class="form-group ml-2">
    <a class="btn btn-sm btn-primary text-white" href="#">
      <i class="fas fa-info-circle"></i>
      รายละเอียดการใช้งาน
    </a>
  </div>
</div>

<div class="card">
  <div class="card-header">
    <h3 class="text-white"><i class="fas fa-store"></i>&nbsp;&nbsp;STORES</h3>
  </div>
  <div class="card-body">
    <table class="table table-bordered" id="example">
      <thead>
        <tr>
          <th style="width:5%;">ลำดับ</th>
          <th style="width:10%;">รหัสร้านค้า</th>
          <th style="width:30%;">ชื่อร้านค้า</th>
          <th style="width:15%;">โทรศัพท์ร้านค้า</th>
          <th style="width:15%;">ผู้ติดต่อ</th>
          <th style="width:15%;">โทรศัพท์ผู้ติดต่อ</th>
          <th>Manage</th>
        </tr>
      </thead>
      <tbody>
        @foreach($store as $row)
        <tr>
          <td>{{$row->id}}</td>
          <td>{{$row->keystore}}</td>
          <td>{{$row->name}}</td>
          <td>{{$row->phone}}</td>
          <td>{{$row->contect}}</td>
          <td>{{$row->cellphone}}</td>
          <td>
            <a data-toggle="modal" data-target="#test{{$row->id}}" data-placement="top" title="View"><i style="font-size:20px;;" class="fas fa-eye text-primary"></i></a>
            &nbsp;&nbsp;
            <a href="{{action('StoreController@edit',$row->id)}}" data-toggle="tooltip" data-placement="top" title="Edit"><i style="font-size:20px;" class="fas fa-edit text-warning"></i></a>
            &nbsp;&nbsp;
            <a class="test" href="#" data-toggle="tooltip" data-placement="top" title="Remove"><i style="font-size:20px;" class="fas fa-trash-alt text-danger"></i></a>
            <form method="post" class="delete_form" action="{{action('StoreController@destroy',$row->id)}}">
              {{csrf_field()}}
              <input type="hidden" name="_method" value="DELETE" />
            </form>
          </td>
        </tr>
  </div>
  @endforeach
  </tbody>
  </table>
</div>
</div>


@foreach( $store as $row )
<div class="modal fade" id="test{{$row->id}}" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">PR {{$row->keystore}}</h4>
        <button class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6 col-form-label">
            <h5 class="modal-title"><i style="font-size:20px" class="far fa-file-alt"></i>&nbsp;&nbsp;ข้อมูลร้านค้า</h5>
          </div>
          <div class="col-md-6 text-right">
            <button class="btn btn-danger"><i style="font-size:18px" class="far fa-file-pdf"></i>&nbsp;&nbsp;PDF</button>
          </div>
        </div>
        <hr class="line">
        <div class="row">
          <div class="form-group col-md-5">
            <label for="#keystore">รหัสร้านค้า</label>
            <input id="keystore" type="text" value="{{$row->keystore}}" class="form-control" disabled>
          </div>
          <div class="form-group col-md-7">
            <label for="#namestore">ชื่อร้านค้า</label>
            <input id="namestore" type="text" value="{{$row->name}}" class="form-control" disabled>
          </div>
        </div>
        <div class="form-group">
          <label for="#address">ที่อยู่</label>
          <textarea class="form-control" name="" id="address" cols="30" rows="3" disabled>{{$row->address}}</textarea>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label for="#phone">เบอร์โทรศัพท์</label>
            <input id="phone" type="text" class="form-control" value="{{$row->phone}}" disabled>
          </div>
          <div class="form-group col-md-6">
            <label for="#address">โทรสาร</label>
            <input id="address" type="text" class="form-control" value="{{$row->fax}}" disabled>
          </div>
        </div>
        <br>
        <h5 class="modal-title"><i style="font-size:20px" class="far fa-id-card"></i>&nbsp;&nbsp;ข้อมูลผู้ติดต่อ</h5>
        <hr class="line">
        <div class="row">
          <div class="form-group col-md-6">
            <label for="#contact">ชื่อผู้ติดต่อ</label>
            <input id="contact" type="text" class="form-control" value="{{$row->contect}}" disabled>
          </div>
          <div class="form-group col-md-6">
            <label for="#phone">เบอร์ผู้ติดต่อ</label>
            <input id="phone" type="text" class="form-control" value="{{$row->cellphone}}" disabled>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endforeach

@stop