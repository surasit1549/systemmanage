@extends('Home.master')
@section('title','ข้อมูลใบขอสั่งซื้อ PR')
@section('content')
<div class="container">
  <div class="card">
    <div class="card-header text-white" style="background:#435d7d">
      <h3><i class="far fa-file-alt"></i>&nbsp;&nbsp;ข้อมูลใบขอสั่งซื้อ</h3>
    </div>
    <div class="card-body">
      <form method="post" action="{{action('PuchaserequestController@show', $id)}}">
        {{csrf_field()}}
        <div class='text-right'>
          <button class="btn btn-lg btn-primary"><i class="fas fa-print"></i>&nbsp;&nbsp;พิมพ์เอกสาร</button>
        </div>
        <br>
        <table class="table table-bordered">
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
        <br>
        <div class="text-center">
          <a class="btn btn-danger" href="{{route('prequest.index')}}"><i class="fas fa-undo"></i>&nbsp;&nbsp;ย้อนกลับ</a>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
</div>
@endsection