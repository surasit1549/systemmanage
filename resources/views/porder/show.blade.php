@extends('Home.master')
@section('title','ข้อมูลใบสั่งซื้อ PO')
@section('content')

<script>
  $(document).ready(function() {
    $('#exportpdfbtn').click(function(e) {
      e.preventDefault();
      e.stopPropagation();
      $.ajax({
        type: 'post',
        url: 'makepdf',
        data: {
          _token: '{{csrf_token()}}',
          pdf: $('#exportpdf').html(),
          po: $('#ponumber').text()
        },
        success: function(data) {
          console.log(data.msg);
        }
      })
    });
  });
</script>

<div class="container">
  <div class="card">
    <div class="card-header text-white">
      <h3><i class="far fa-file-alt"></i>&nbsp;&nbsp;ข้อมูลใบสั่งซื้อ</h3>
    </div>
    <div class="card-body">
      <form method="post" action="{{action('PurchaseorderController@show', $id)}}">
        {{csrf_field()}}
        <div class='text-right'>
          <button class="btn btn-lg btn-primary" id="exportpdfbtn"><i class="fas fa-print"></i>&nbsp;&nbsp;พิมพ์เอกสาร</button>
        </div>
        <div class="row">
          <div class="col-form-label col-md-6">
            <h4 class="d-inline shadow-sm" style="padding:10px"><label class="text-danger">&nbsp;PO <span id="po_number">{{$po_id['PO_ID']}}</span></label></h4>
          </div>
        </div>
        <hr>
        <div class="container">
          <table class="table table-borderless">
            <tr>
              <th> ผู้ขาย :</th>
              <td>
                {{$store[0]['name']}}&nbsp;&nbsp; [ {{$store[0]['keystore']}} ]
              </td>
              <th> วันที่เอกสาร :</th>
              <td>
                {{substr($data[0]['created_at'],0,-9)}}
              </td>
            </tr>
            <tr>
              <th> ที่อยู่ :</td>
              <td>
                {{$store[0]['address']}}
              </td>
              <th> ผู้ติดต่อ : </th>
              <td>
                {{$store[0]['contect']}} &nbsp;&nbsp; {{$store[0]['cellphone']}}
              </td>
            </tr>
            <tr>
              <th> โทรศัพท์ :</th>
              <td>
                {{$store[0]['phone']}}
              </td>
              <th> วันที่กำหนดส่ง : </th>
              <td>

              </td>
            </tr>
            <tr>
              <th> โทรสาร : </th>
              <td>
                {{$store[0]['fax']}}
              </td>
              <th> จำนวนเครดิต : </th>
              <td>

              </td>
            </tr>
            <tr>
              <th> </th>
              <td> </td>
              <th> เงื่อนไขการชำระ : </th>
              <td>

              </td>
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
              <th>ราคา (บาท)</th>
              <th>จำนวนเงิน</th>
            </tr>
          </thead>
          <tbody>
            @foreach($data as $row)
            <tr>
              <td class="text-center"><label class="col-form-label">{{$number++}}</label></td>
              <td class="text-center result"><label class="form-control productname border-0" value="{{$row['Product_name']}}" name="" required>{{$row['Product_name']}}</label>
              <td class="text-center result"><label class="form-control productnumber border-0" value="{{$row['Product_number']}}" name="" required>{{$row['Product_number']}}</label></td>
              <td class="text-center result"><label class="form-control unit border-0" value="{{$row['unit']}}" name="" required>{{$row['unit']}}</label>
              <td class="text-center result"><label class="form-control price border-0" value="{{$row['price']}}" required>{{$row['price']}}</label></td>
              <td class="text-center result"><label class="sum col-form-label border-0" value="{{$row['product_sum']}}" required>{{$row['product_sum']}}</label></td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th class="text-right" colspan="4">รวมเป็นเงิน</th>
              <th class="text-center"><label class="text-danger" value="{{$data[0]['sumofprice']}}">{{$data[0]['sumofprice']}}</label></th>
              <th class="text-center">บาท</th>
            </tr>
          </tfoot>
        </table>
        <br>
        <div class="text-center">
          <a class="btn btn-danger btn-lg" href="{{route('porder.index')}}"><i class="fas fa-undo"></i>&nbsp;&nbsp;ย้อนกลับ</a>
        </div>
      </form>
    </div>
  </div>
</div>

<div id="exportpdf" class="d-none">
  <div style="position:absolute">
  </div>
  <div style="text-align:center">
    <h3>
      {{ $store_mine[0]->name }} <br>
      {{ $store_mine[0]->address }} <br>
      {{ $store_mine[0]->phone }}
    </h3>
  </div>
  <div style="position:absolute;top:140px;left:47%;text-align:center">
    <h4>ใบสั่งซื้อ</h4>
  </div>
  <div id="number_doc">
    <h4>เลขที่เอกสาร PO <span style="color:red">{{$po_id['PO_ID']}}</span></h4>
  </div>
  <div class="pd_table">
    <table class="main_detail_po">
=======
<<<<<<< HEAD
=======
>>>>>>> 32323488ff5f2f665b33a1e86e52a04e823f45d4

<div style="position:absolute;left:60px">
  <img style="width:300px;height:150px" src="{{asset('pic/store.png')}}" alt="pic">
</div>
<div style="text-align:center">
  <h4>{{ $store_mine[0]->name }}</h4>
  <h5>{{ $store_mine[0]->address }}</h5>
  <h5>{{ $store_mine[0]->phone }}</h5>
</div>
<div style="text-align:center;top:20px;position:relative">
  <h4>ใบสั่งซื้อ</h4>
</div>
<div style="border:2px solid black;position:absolute;right:100px;padding:10px;">
  <h5>เลขที่เอกสาร PO {{$po_id['PO_ID']}}</h5>
</div>
<br>
<br>
<div class="pd_table">
  <table class="main_detail_po">
    <tr>
      <td>
        <table class="detail_po">
          <tr>
            <th>ผู้ขาย :</th>
            <td>{{$store[0]['name']}}&nbsp;&nbsp; [ {{$store[0]['keystore']}} ]</td>
          </tr>
          <tr>
            <th>โทรศัทพ์ :</th>
            <td>{{$store[0]['phone']}}</td>
          </tr>
          <tr>
            <th>ที่อยู่ :</th>
            <td>{{$store[0]['address']}}</td>
          </tr>
          <tr>
            <th>โทรสาร :</th>
            <td>{{$store[0]['fax']}}</td>
          </tr>
        </table>
      </td>
      <td>
        <table class="detail_po">
          <tr>
            <th>วันที่เอกสาร :</th>
            <td> {{substr($data[0]['created_at'],0,-9)}}</td>
          </tr>
          <tr>
            <th>ผู้ติดต่อ :</th>
            <td>{{$store[0]['contect']}} &nbsp;&nbsp; {{$store[0]['cellphone']}}</td>
          </tr>
          <tr>
            <th>วันที่กำหนดส่ง :</th>
            <td>ผู้ขาย</td>
          </tr>
          <tr>
            <th>จำนวนเครดิต :</th>
            <td>ผู้ขาย</td>
            <th>วัน</th>
          </tr>
          <tr>
            <th>เงื่อนไขการชำระ :</th>
            <td>ผู้ขาย</td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</div>

<div style="position:absolute;padding:20">
  <table class="table-detail" style="font-size:18px">
    <thead>
      <tr>
        <th>ลำดับ</th>
        <th>รายการ</th>
        <th>จำนวน</th>
        <th>หน่วย</th>
        <th>ราคา/หน่วย</th>
        <th>จำนวนเงิน</th>
      </tr>
    </thead>
    <tbody>
      @foreach($data as $num=>$row)
      <tr>
        <td>
          <table class="detail_po">
            <tr>
              <th style="text-align:left">ผู้ขาย :</th>
              <td style="width:290px">{{$store[0]['name']}}&nbsp;&nbsp; [ {{$store[0]['keystore']}} ]</td>
            </tr>
            <tr>
              <th style="text-align:left">โทรศัทพ์ :</th>
              <td style="width:290px">{{$store[0]['phone']}}</td>
            </tr>
            <tr>
              <th style="text-align:left;vertical-align:top">ที่อยู่ :</th>
              <td style="width:290px">{{$store[0]['address']}}</td>
            </tr>
            <tr>
              <th style="text-align:left">โทรสาร :</th>
              <td style="width:290px">{{$store[0]['fax']}}</td>
            </tr>
          </table>
        </td>
        <td>
          <table class="detail_po">
            <tr>
              <th style="text-align:left">วันที่เอกสาร :</th>
              <td>{{substr($data[0]['created_at'],0,-9)}}</td>
            </tr>
            <tr>
              <th style="text-align:left">ผู้ติดต่อ :</th>
              <td>{{$store[0]['contect']}} &nbsp;&nbsp; {{$store[0]['cellphone']}}</td>
            </tr>
            <tr>
              <th style="text-align:left">วันที่กำหนดส่ง :</th>
              <td>..</td>
            </tr>
            <tr>
              <th style="text-align:left">จำนวนเครดิต :</th>
              <td>..</td>
              <th>วัน</th>
            </tr>
            <tr>
              <th style="text-align:left">เงื่อนไขการชำระ :</th>
              <td>..</td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </div>


  <div class="detail_table">
    <table class="table-detail">
      <thead>
        <tr>
          <th style="width:5%;font-size:200px">ลำดับ</th>
          <th style="width:30%;font-size:200px">รายการ</th>
          <th style="width:15%;font-size:200px">จำนวน</th>
          <th style="width:15%;font-size:200px">หน่วย</th>
          <th style="width:15%;font-size:200px">ราคา/หน่วย</th>
          <th style="width:20%;font-size:200px">จำนวนเงิน</th>
        </tr>
      </thead>
      <tbody>
        @foreach($data as $num=>$row)
        <tr>
          <td style="width:5%;font-size:200px">{{$num + 1}}</td>
          <td style="width:30%;font-size:200px">{{$row['Product_name']}}</td>
          <td style="width:15%;font-size:200px">{{$row['Product_number']}}</td>
          <td style="width:15%;font-size:200px">{{$row['unit']}}</td>
          <td style="width:15%;font-size:200px">{{$row['price']}}</td>
          <td style="width:20%;font-size:200px">{{$row['product_sum']}}</td>
        </tr>
        @endforeach
        @for( $num = $number ; $num <= 10 ; $num++ ) <tr>
          <td style="width:5%">&nbsp;</td>
          <td style="width:30%"></td>
          <td style="width:15%"></td>
          <td style="width:15%"></td>
          <td style="width:15%"></td>
          <td style="width:20%"></td>
          </tr>
          @endfor
      </tbody>
      <tfoot>
        <tr>
          <th rowspan="3">หมายเหตุ</th>
          <td rowspan="3" colspan="3">สำหรับ..</td>
          <th>ราคายังไม่รวมภาษี</th>
          <td>..</td>
        </tr>
        <tr>
          <th>ส่วนลด</th>
          <td></td>
        </tr>
        <tr>
          <th>ภาษีมูลค่าเพิ่ม 7%</th>
          <td>..</td>
        </tr>
        <tr>
          <th>ตัวอักษร</th>
          <td colspan="3">..</td>
          <th>รวมทั้งสิ้น</th>
          <td>..</td>
        </tr>
      </tfoot>
    </table>
  </div>
</div>

@endsection