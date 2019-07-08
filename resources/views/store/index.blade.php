@extends('Home.master')
@section('title','welcome Homepage')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12"> <br />
        @if(\Session::has('success'))
          <div class="alert alert-success">
            <a>{{\Session::get('success')}}</a>
          </div>
        @endif
      <div class="card">
        <div class="card-header" style="background-color:#435d7d;">
          <div class="row">
            <div class="col-md-8">
              <h3 class="text-white">STORES</h3>
            </div>
            <div class="col-md-2 text-right">
              <a class="btn btn-danger text-white text-right" href="{{route('store.create')}}">
              <i class="fas fa-trash"></i>
              ลบร้านค้า
              </a>
            </div> 
            <div class="col-md-2 text-right">
              <a class="btn btn-success text-white text-right" href="{{route('store.create')}}">
              <i class="fas fa-plus"></i>
              เพิ่มร้านค้า
              </a>
            </div>  
          </div>
            
        </div>
        <div class="card-body">
          <table class="table table-hover text-center">
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
              <td><a href="{{action('StoreController@edit',$row['id'])}}" class="btn btn-sm btn-primary">Edit</a></td>
              <td>
                <form method="post" class="delete_form" action="{{action('StoreController@destroy',$row['id'])}}">
                  {{csrf_field()}}
                <input type="hidden" name="_method" value="DELETE" />
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
              </form>
              </td>
              <td><a href="{{action('StoreController@show',$row['id'])}}" class="btn btn-primary btn-sm">Show</a></td>
            </tr>
            @endforeach
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@stop
