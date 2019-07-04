@extends('Home.master')
@section('title','ประวัติของแปลง')
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
          @foreach($transform as $row)
          <tr>
            <td>{{$row['id']}}</td>
            <td>{{$row['convertname']}}</td>
            <td>{{$row['size']}}</td>
          </tr>
          @endforeach
        </table>
        <a href="{{route('transform.index')}}">กลับ</a>
      </form>
    </div>
  </div>
</div>
@endsection
