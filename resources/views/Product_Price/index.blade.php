@extends('Home.master')
@section('title','welcome Homepage')
@section('tabbarcss')
<style>
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

    $('#example').DataTable({
      'columnDefs' : [
        { 'orderable' : false , 'targets' : 2 }
      ]
    });

  });
</script>

@if(\Session::has('success'))
<div class="alert alert-success alert-dismissible fade show">
  <a><i class="fas fa-check"></i>&nbsp;&nbsp;{{\Session::get('success')}}</a>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

<div class="form-row col-md-12">
  <div class="form-group">
    <a class="btn btn-sm btn-success text-white" href="{{route('Product_Price.create')}}">
      <i class="fas fa-plus"></i>
      เพิ่มข้อมูลราคา
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
    <h3 class="text-white"><i class="fas fa-map"></i>&nbsp;&nbsp;ราคาสินค้า</h3>
  </div>
  <div class="card-body">

    <table class="table table-bordered" id="example">
      <thead>
        <tr>
          <th style="width:10%">รหัสร้านค้า</th>
          <th style="width:40%;">ชื่อร้านค้า</th>
          <th style="width:10%;">จัดการ</th>
        </tr>
      </thead>
      <tbody>
        @foreach($store_name as $row)
        <tr>
          <td>{{$number++}}</td>
          <td>{{$row[0]['keystore']}}</td>
          <td>{{$row[0]['name']}}</td>
          <td>
            &nbsp;&nbsp;<a href="{{action('ProductPriceController@show',$row[0]['keystore'])}}" data-toggle="tooltip" data-placement="top" title="View"><i style="font-size:20px;;" class="fas fa-eye text-primary"></i></a>
            &nbsp;&nbsp;
            <a class="test" href="#" data-toggle="tooltip" data-placement="top" title="Remove"><i style="font-size:20px;" class="fas fa-trash-alt text-danger"></i></a>
            <form method="post" class="delete_form" action="{{action('ProductPriceController@destroy',$row[0]['id'])}}">
              {{csrf_field()}}
              <input type="hidden" name="_method" value="DELETE" />
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  @stop