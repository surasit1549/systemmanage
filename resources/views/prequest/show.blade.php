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
        <div class='text-right'>
          <button class="btn btn-lg btn-primary"><i class="fas fa-print"></i>&nbsp;&nbsp;พิมพ์เอกสาร</button>
        </div>

        <hr>

        <div class="container">
          <table class="table table-borderless">
            <tr>
              <th>
                เลขที่เอกสาร
                </td>
              <td>
                {{$prequestdb->keyPR}}
              </td>
              <th>
                วันที่ขอสั่งซื้อ
                </td>
              <td>
                {{$prequestdb->date}}
              </td>
            </tr>
            <tr>
              <th>
                ชื่อผู้รับเหมา
                </td>
              <td>
                {{$prequestdb->contractor}}
              </td>
              <th>
                แบบงาน
                </td>
              <td>
                {{$prequestdb->formwork}}
              </td>
            </tr>
            <tr>
              <th>แปลง</th>
              <td>{{$prequestdb->prequestconvert}}</td>
            </tr>
          </table>
        </div>

        <table class="table table-hover table-bordered">
          <thead>
            <tr>
              <th>ลำดับที่</th>
              <th>ชื่อสินค้า</th>
              <th>จำนวนสินค้า</th>
              <th>หน่วย</th>
              <th>ร้านค้า</th>
              <th>ราคา (บาท)</th>
              <th>จำนวนเงิน</th>
            </tr>
          </thead>
          @foreach($prequestproduct as $row)
            @if($prequestdb->keyPR === $row['keyPR'])
              @if($prequestdb->formwork === $row['formwork'])
                <tbody>
                  <td style="width:5%">1</td>
                  <td style="width:20%">{{$row['productname']}}</td>
                  <td style="width:10%">{{$row['productnumber']}}</td>
                  <td style="width:10%">{{$row['unit']}}</td>
                  <td style="width:10%">{{$row['keystore']}}</td>
                  <td style="width:10%">{{$row['price']}}</td>
                  <td style="width:10%">{{$row['sum']}}</td>
                </tbody>
              @endif
            @endif
          @endforeach
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