@extends('Home.master')
@section('title','ประวัติของแปลง')
@section('tabbarcss')
  <style>
    #transformtab {
      border-right : 5px solid rgb(41, 207, 219);
    }
  }
  </style>
@stop
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12"> <br />
      <h3 align="center">ข้อมูลแปลง</h3> <br />
      <form method="post" action="{{action('TransformController@show', $id)}}">
        {{csrf_field()}}
        <table class="table table-bordered table-striped">
          <tr>
            <th>ลำดับ</th>
            <th>ชื่อแปลง</th>
            <th>พื่นที่แปลง</th>
          </tr>
        
          <tr>
            <td>{{$transform->id}}</td>
            <td>{{$transform->convertname}}</td>
            <td>{{$transform->size}}</td>
          </tr>
         
        </table>
        <a href="{{route('transform.index')}}">กลับ</a>
      </form>
    </div>
  </div>
</div>
@endsection
