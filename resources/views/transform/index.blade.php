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
<div class="alert alert-success">
  <a><i class="fas fa-check"></i>&nbsp;&nbsp;{{\Session::get('success')}}</a>
</div>
@endif
<div class="form-group">
  <a class="btn btn-sm btn-success text-white" href="{{route('transform.create')}}">
    <i class="fas fa-plus"></i>
    สร้างแปลง
  </a>
</div>
<div class="card">
  <div class="card-header">
    <h3 class="text-white"><i class="fas fa-map"></i>&nbsp;&nbsp;แปลง</h3>
  </div>
  <div class="card-body">
    <div class="form-row">
      <div class="form-group col-md-10">
        <div class="input-group" id="searchform">
          <div class="input-group-prepend">
            <span class="input-group-text bg-light"><i class="fas fa-search"></i></span>
          </div>
          <input type="text" id="searchtext" class="form-control" placeholder="กรอกรหัสร้านค้าหรือชื่อร้านค้าที่ต้องการค้นหา..">
        </div>
      </div>

      <nav aria-label="Page navigation" class="col-md-2">
        <ul class="pagination justify-content-end">
          <li class="page-item disabled">
            <a class="page-link" href="#" aria-label="Previous">
              <span aria-hidden="true">&laquo;</span>
            </a>
          </li>
          <li class="page-item active"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item">
            <a class="page-link" href="#" aria-label="Next">
              <span aria-hidden="true">&raquo;</span>
            </a>
          </li>
        </ul>
      </nav>
    </div>
    <table class="table  table-bordered table-striped">
      <thead>
        <tr>
          <th style="width:5%;">ลำดับ</th>
          <th style="width:40%;">ชื่อแปลง</th>
          <th style="width:30%;">ขนาด ( ตารางวา )</th>
          <th colspan="3">จัดการ</th>
        </tr>
      </thead>
      <tbody>
        @foreach($transform as $row)
        <tr>
          <td>{{$row['id']}}</td>
          <td>{{$row['convertname']}}</td>
          <td>{{$row['size']}}</td>
          <td>
            &nbsp;&nbsp;<a href="{{action('TransformController@edit',$row['id'])}}" data-toggle="tooltip" data-placement="top" title="Edit"><i style="font-size:20px;" class="fas fa-edit text-warning"></i></a>
            &nbsp;&nbsp;
            <a class="test" href="#" data-toggle="tooltip" data-placement="top" title="Remove"><i style="font-size:20px;" class="fas fa-trash-alt text-danger"></i></a>
            <form method="post" class="delete_form" action="{{action('TransformController@destroy',$row['id'])}}">
              {{csrf_field()}}
              <input type="hidden" name="_method" value="DELETE" />
            </form>
        </tr>
        @endforeach
      </tbody>
    </table>
    <nav aria-label="Page navigation">
      <ul class="pagination justify-content-center">
        <li class="page-item disabled">
          <a class="page-link" href="#" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
          <a class="page-link" href="#" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
      </ul>
    </nav>
  </div>
  @stop