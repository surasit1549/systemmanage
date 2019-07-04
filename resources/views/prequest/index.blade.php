@extends('Home.master')
@section('title','welcome Homepage')
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
          @foreach($prequest as $row)
          <tr>
            <td>{{$row['id']}}</td>
            <td>{{$row['numberPR']}}</td>
            <td>{{$row['date']}}</td>
            <td>{{$row['convertname']}}</td>
          </tr>
          @endforeach
        </table>
    </div>
  </div>
</div>
@stop
