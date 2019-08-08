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
            <h4 class="d-inline shadow-sm" style="padding:10px"><label class="text-danger">&nbsp;PR {{$prequestdb->keyPR}}</label></h4>
          </div>
          <div class='col-md-6 text-right'>
            <button class="btn btn-danger"><i style="font-size:18px" class="far fa-file-pdf"></i>&nbsp;&nbsp;PDF</button>
          </div>
        </div>
        <hr>

        <div class="container">
          <table class="table table-borderless">
            <tr>
              <th>
                เลขที่เอกสาร
                </td>
              <td>
                {{$pr_prequest[0]}}
              </td>
              <th>
                วันที่ขอสั่งซื้อ
                </td>
              <td>
                {{$pr_prequest[1]}}
              </td>
            </tr>
            <tr>
              <th>
                ชื่อผู้รับเหมา
                </td>
              <td>
                {{$pr_prequest[2]}}
              </td>
              <th>
                แบบงาน
                </td>
              <td>
                {{$pr_prequest[3]}}
              </td>
            </tr>
            <tr>
              <th>แปลง</th>
              <td>{{$pr_prequest[4]}}</td>
            </tr>
          </table>
        </div>

        <table class="table table-hover table-bordered">
          <thead class="text-center">
            <tr>
              <th>ลำดับที่</th>
              <th>ชื่อสินค้า</th>
              <th>จำนวนสินค้า</th>
              <th>ราคา</th>
              <th>หน่วย</th>
              <th>รวม</th>
              <th>ร้านค้า</th>
            </tr>
          </thead>
          <tbody>
            @if(empty($productdb))
            @foreach($productdb as $row)
            <tr>
              <td>{{$number++}}</td>
              <td>{{$row['productname']}}</td>
              <td>{{$row['productnumber']}}</td>
              <td>{{$row['price']}}</td>
              <td>{{$row['unit']}}</td>
              <td>{{$row['sum']}}</td>
              <td>{{$row['keystore']}}</td>
            @endforeach
          @else
            @foreach($pr_products as $row)
              <tr>
                <td>{{$number++}}</td>
                <td>{{$row[2]}}</td>
                <td>{{$row[3]}}</td>
                <td>{{$row[6]}}</td>
                <td>{{$row[4]}}</td>
                <td>{{$row[7]}}</td>
                <td>{{$row[5]}}</td>
              </tr>
              @endforeach
            @endif
          </tbody>
          <tfoot>
            <tr>
              <th class="text-right" colspan="5">รวมเป็นเงิน</th>
              <th class="text-center"><label id="sumofprice" class="text-danger">{{$prequestdb['sumofprice']}}</label></th>
              <th class="text-center">บาท</th>
            </tr>
          </tfoot>
        </table>
        <br>
        <div class="text-center">
          <a class="btn btn-danger btn-lg" href="{{route('prequest.index')}}"><i class="fas fa-undo"></i>&nbsp;&nbsp;ย้อนกลับ</a>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
</div>
@endsection