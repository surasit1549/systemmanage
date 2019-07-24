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
    <div class="form-row">
      <div class="form-group form-row col-md-4">
        <label for="showentries" class="col-form-label col-md-2">แสดง</label>
        <div class="text-center col-md-3">
          <select name="showentries" class="custom-select" id="">
            <option value="10" selected>10</option>
            <option value="20">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
          </select>
        </div>
        <label class="col-form-label col-md-2 text-center">แถว</label>
      </div>
      <div class="form-group col-md-8 text-right">
        <div class="input-group" id="searchform">
          <div class="input-group-prepend">
            <span class="input-group-text bg-light"><i class="fas fa-search"></i></span>
          </div>
          <input type="text" id="searchtext" class="form-control col-md-6" placeholder="กรอกรหัสร้านค้าหรือชื่อร้านค้าที่ต้องการค้นหา..">
        </div>
      </div>
    </div>

    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th style="width:5%;">#</th>
          <th style="width:15%;">รหัสร้านค้า</th>
          <th style="width:40%;">ชื่อร้านค้า</th>
          <th colspan="3">Manage</th>
        </tr>
      </thead>
      <tbody>
        @foreach($store as $row)
        <tr>
          <td>{{$row->id}}</td>
          <td class="schnum">{{$row->keystore}}</td>
          <td class="schtext">{{$row->name}}</td>
          <td colspan="3">
            <a href="{{action('StoreController@show',$row->id)}}" data-toggle="tooltip" data-placement="top" title="View"><i style="font-size:20px;;" class="fas fa-eye text-primary"></i></a>
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
  {{ $store->links() }}
</div>

</div>

@stop