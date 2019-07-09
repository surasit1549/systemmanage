@extends('Home.master')
@section('title','welcome Homepage')
@section('tabbarcss')
  <style>
    #transformtab {
      border-right : 5px solid rgb(41, 207, 219);
    }
  }
  </style>
@stop
@section('content')
<script>
  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
    $('.test').click(function(){
      $(this).next('form').submit();
    });
  });
</script>
<div class="container">
  <div class="row">
    <div class="col-md-12">
        @if(\Session::has('success'))
          <div class="alert alert-success">
            <a>{{\Session::get('success')}}</a>
          </div>
        @endif
      <div class="card">
        <div class="card-header" style="background-color:#435d7d;">
          <div class="row">
            <div class="col-md-10">
              <h3 class="text-white">แปลง</h3>
            </div>
            <div class="col-md-2 text-right">
              <a class="btn btn-success text-white text-right" href="{{route('transform.create')}}">
              <i class="fas fa-plus"></i>
              สร้างแปลง
              </a>
            </div>  
          </div>
        </div>
        <div class="card-body">
        <table class="table table-bordered">
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
                &nbsp;&nbsp;<a href="{{action('TransformController@show',$row['id'])}}" data-toggle="tooltip" data-placement="top" title="View"><i style="font-size:20px;;" class="fas fa-eye text-primary"></i></a>
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
    </div>
  </div>
</div>
@stop
