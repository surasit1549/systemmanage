@extends('Home.master')
@section('title','ข้อมูลใบขอสั่งซื้อ PR')
@section('content')
<div class="container">
  <div class="card">
    <div class="card-header text-white">
      <h3><i class="far fa-file-alt"></i>&nbsp;&nbsp;ข้อมูลใบขอสั่งซื้อ</h3>
    </div>
    <div class="card-body">
      <form method="post" action="{{action('PuchaserequestController@show', $id)}}">
        {{csrf_field()}}
        <div class="row">
          <div class="col-form-label col-md-6">
            <h4 class="d-inline shadow-sm" style="padding:10px"><label class="text-danger">&nbsp;PR {{$pr_create['key']}}</label></h4>
          </div>
          <div class='col-md-6 text-right'>
            <button class="btn btn-danger"><i style="font-size:18px" class="far fa-file-pdf"></i>&nbsp;&nbsp;PDF</button>
          </div>
        </div>
        <hr>

        <div class="container">
          <div style="text-align:center">
            <h5>{{$store_master[0]['name']}}</h5> <br>
            <h5>{{$store_master[0]['address']}}</h5> <br>
            <h5>เบอร์โทรศัทพ์ {{$store_master[0]['phone']}}</h5>
          </div><br>
          <div style="text-align:right">
            <h6>เลขที่เอกสาร <a>{{$pr_create['key']}}</a></h6>
            <h6>วันที่ขอสั่งซื้อ <a>{{$pr_create['date']}}</a></h6>
          </div>
          <div id="data_information">
            <table id="tableexa" >
              <tbody>
                <tr>
                  <th>TO :</th>
                  <td>THERA ASSET CO.,LTD</td>
                </tr>
                <tr>
                  <th>ชื่อผู้รับเหมา</th>
                  <td id="name_ex">{{$pr_create['contractor']}}</td>
                  <th style="padding-left:30px">แปลง</th>
                  <td id="transform_ex">{{$pr_create['prequestconvert']}}</td>
                </tr>
                <tr>
                  <th>แบบงาน</th>
                  <td id="work_ex">{{$pr_create['formwork']}}</td>
                </tr>
              </tbody>
            </table>
          </div><br>

          <table class="table table-hover table-bordered">
            <thead class="text-center">
              <tr>
                <th>ลำดับที่</th>
                <th>ชื่อสินค้า</th>
                <th>จำนวนสินค้า</th>
                <th>หน่วย</th>
              </tr>
            </thead>
            <tbody>
              @foreach($productdb as $row)
              <tr>
                <td>{{$number++}}</td>
                <td>{{$row['productname']}}</td>
                <td>{{$row['productnumber']}}</td>
                <td>{{$row['unit']}}</td>
              </tr>
              @endforeach
              @for($i = $number ; $i <= 10 ; $i++) <tr>
                <td style="padding:10px 0px">&nbsp;</td>
                <td style="padding:10px 0px"></td>
                <td style="padding:10px 0px"></td>
                <td style="padding:10px 0px"></td>
                </tr>
                @endfor
            </tbody>
          </table>
          <br>
          <div class="text-center">
            <a class="btn btn-danger" onclick="window.history.back()" href="#"><i class="fas fa-undo"></i>&nbsp;&nbsp;ย้อนกลับ</a>
          </div>
      </form>
    </div>
  </div>
</div>
</div>
</div>
@endsection