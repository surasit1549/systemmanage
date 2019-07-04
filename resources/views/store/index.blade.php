@extends('Home.master')
@section('title','welcome Homepage')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12"> <br />
        <h1 align="center">ชื่อร้านค้า</h1><br><br>
        <a href="{{route('store.create')}}">เพิ่มร้านค้า</a><br>
        @if(\Session::has('success'))
          <div class="alert alert-success">
            <a>{{\Session::get('success')}}</a>
          </div>
        @endif
        <table class="table table-hover">
          <tr>
            <th>ลำดับ</th>
            <th>รหัสร้านค้า</th>
            <th>ร้านค้า</th>
            <th>แก้ไข</th>
            <th>ลบร้านค้า</th>
            <th>ประวัติร้านค้า</th>
          </tr>
          @foreach($store as $row)
          <tr>
            <td>{{$row['id']}}</td>
            <td>{{$row['keystore']}}</td>
            <td>{{$row['name']}}</td>
            <td><a href="{{action('StoreController@edit',$row['id'])}}" class="btn btn-primary">Edit</a></td>
            <td>
              <form method="post" class="delete_form" action="{{action('StoreController@destroy',$row['id'])}}">
                {{csrf_field()}}
              <input type="hidden" name="_method" value="DELETE" />
              <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            </td>
            <td><a href="{{action('StoreController@show',$row['id'])}}" class="btn btn-primary">Show</a></td>
          </tr>
          @endforeach
        </table>
    </div>
  </div>
</div>
@stop
