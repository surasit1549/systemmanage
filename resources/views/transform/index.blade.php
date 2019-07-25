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

<div class="form-row col-md-12">
  <div class="form-group">
    <a class="btn btn-sm btn-success text-white" href="{{route('transform.create')}}">
      <i class="fas fa-plus"></i>
      สร้างแปลง
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
    <h3 class="text-white"><i class="fas fa-map"></i>&nbsp;&nbsp;แปลง</h3>
  </div>
  <div class="card-body">
    <table class="table table-bordered table-striped" id="example">
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
  </div>

  <script>
    $(document).ready(function() {
      $('#example').DataTable();
    });
  </script>


  @stop