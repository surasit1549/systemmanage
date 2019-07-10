@extends('Home.master')
@section('title','ข้อมูลใบขอสั่งซื้อ PR')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12"> <br />
      <h3 align="center">ข้อมูลใบขอสั่งซื้อ</h3> <br />
      <form method="post" action="{{action('PuchaserequestController@show', $id)}}">
        {{csrf_field()}}
        <table class="table table-bordered table-striped">
          <tr>
            <th>เลขที่เอกสาร</th>
            <th>วันที่ขอสั่งซื้อ</th>
            <th>ชื่อผู้รับเหมา</th>
            <th>แบบงาน</th>
          </tr>
          <tr>
            <td>{{$prequestdb->keyPR}}</td>
            <td>{{$prequestdb->date}}</td>
            <td>{{$prequestdb->contractor}}</td>
            <td>{{$prequestdb->formwork}}</td>
          </tr>

          <tr>
            <th>แปลง</th>
            <th>ชื่อสินค้า</th>
            <th>จำนวนสินค้า</th>
            <th>หน่วย</th>
          </tr>
          <tr>
            <td>{{$prequestdb->prequestconvert}}</td>
            <td>{{$prequestdb->productname}}</td>
            <td>{{$prequestdb->productnumber}}</td>
            <td>{{$prequestdb->unit}}</td>
          </tr>

          <tr>
            <th>ร้านค้า</th>
            <th>ราคา</th>
            <th>จำนวนเงิน</th>
          </tr>
          <tr>
            <td>{{$prequestdb->keystore}}</td>
            <td>{{$prequestdb->price}}</td>
            <td>{{$prequestdb->sum}}</td>
          </tr>

        </table>
        <a href="{{route('prequest.index')}}">กลับ</a>
      </form>
    </div>
  </div>
</div>
@endsection