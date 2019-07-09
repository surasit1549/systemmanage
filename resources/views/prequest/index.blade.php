@extends('Home.master')
@section('title','welcome Homepage')
@section('tabbarcss')
  <style>
    #prtab {
      border-right : 5px solid rgb(41, 207, 219);
    }
  }
  </style>
@stop
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12"> <br />
        <h1 align="center">ใบขอสั่งชื้อ (Puchase Request)</h1><br><br>
        <a href="{{route('prequest.create')}}">สร้างใบขอสั่งชื้อ</a><br>
        @if(\Session::has('success'))
          <div class="alert alert-success">
            <a>{{\Session::get('success')}}</a>
          </div>
        @endif
        <table class="table table-hover">
          <tr>
            <th>ลำดับ</th>
            <th>ชื่อเลขที่เอกสาร</th>
            <th>วันที่ขอสั่งซื้อ</th>
            <th>แปลง</th>
            <th>แก้ไขข้อมูล</th>
            <th>ลบ</th>
            <th>พิมพ์</th>
          </tr>
          @foreach($prequestdb as $row)
          <tr>
            <td>{{$row['id']}}</td>
            <td>{{$row['keyPR']}}</td>
            <td>{{$row['date']}}</td>
            <td>{{$row['prequestconvert']}}</td>
            <td><a href="{{action('PuchaserequestController@edit',$row['id'])}}" class="btn btn-sm btn-primary">Edit</a></td>
              <td>
                <form method="post" class="delete_form" action="{{action('PuchaserequestController@destroy',$row['id'])}}">
                  {{csrf_field()}}
                <input type="hidden" name="_method" value="DELETE" />
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
              </form>
              </td>
              <td><a href="{{action('PuchaserequestController@show',$row['id'])}}" class="btn btn-primary btn-sm">Show</a></td>
          </tr>
          @endforeach
        </table>
    </div>
  </div>
</div>
@stop
