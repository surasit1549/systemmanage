@extends('Home.master')
@section('title','welcome Homepage')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12"> <br />
        <h1 align="center">แปลง</h1><br><br>
        <a href="{{route('transform.create')}}">สร้างแปลง</a><br>
        @if(\Session::has('success'))
          <div class="alert alert-success">
            <a>{{\Session::get('success')}}</a>
          </div>
        @endif
        <table class="table table-hover text-center">
          <thead>
            <tr>
              <th>ลำดับ</th>
              <th>ชื่อแปลง</th>
              <th>ขนาด</th>
              <th>แก้ไข</th>
              <th>ลบ</th>
              <th>ข้อมูล</th>
            </tr>
          </thead>
          <tbody>
            @foreach($transform as $row)
            <tr>
              <td>{{$row['id']}}</td>
              <td>{{$row['convertname']}}</td>
              <td>{{$row['size']}}</td>
              <td><a href="{{action('TransformController@edit',$row['id'])}}" class="btn btn-primary">Edit</a></td>
              <td>
                <form method="post" class="delete_form" action="{{action('TransformController@destroy',$row['id'])}}">
                  {{csrf_field()}}
                <input type="hidden" name="_method" value="DELETE" />
                <button type="submit" class="btn btn-danger">Delete</button>
              </form>
              </td>
              <td><a href="{{action('TransformController@show',$row['id'])}}" class="btn btn-primary">Show</a></td>
            </tr>
            @endforeach
          </tbody>
        </table>
    </div>
  </div>
</div>
@stop
