@extends('Home.master')
@section('title','welcome Homepage')
@section('tabbarcss')
<style>
  #transformtab {
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
  <a><i class="fas fa-check"></i>&nbsp;&nbsp;{{\Session::get('success')}}</a>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

<div class="form-row col-md-12">
  <div class="form-group">
    <a class="btn btn-sm btn-success text-white" href="{{route('Product.create')}}">
      <i class="fas fa-plus"></i>
      เพิ่มสินค้า
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
    <h3 class="text-white"><i class="fas fa-map"></i>&nbsp;&nbsp;คลังสินค้า</h3>
  </div>
  <div class="card-body">

    <table class="table table-bordered" id="example">
      <thead>
        <tr>
          <th style="width:5%;">ลำดับ</th>
          <th style="width:40%;">รหัสสินค้า</th>
          <th style="width:30%;">ชื่อสินค้า</th>
          <th>จัดการ</th>
        </tr>
      </thead>
      <tbody>
        @foreach($products as $row)
        <tr>
          <td>{{$num++}}</td>
          <td>{{$row[1]}}</td>
          <td>{{$row[2]}}</td>
          <td>
            &nbsp;&nbsp;<a href="{{action('ProductController@edit',$row[0])}}" data-toggle="tooltip" data-placement="top" title="Edit"><i style="font-size:20px;" class="fas fa-edit text-warning"></i></a>
            &nbsp;&nbsp;
            <a class="test" href="#" data-toggle="tooltip" data-placement="top" title="Remove"><i style="font-size:20px;" class="fas fa-trash-alt text-danger"></i></a>
            <form method="post" class="delete_form" action="{{action('ProductController@destroy',$row[0])}}">
              {{csrf_field()}}
              <input type="hidden" name="_method" value="DELETE" />
              <input type="hidden" name="Product_ID" value="{{$row[1]}}">
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  @stop