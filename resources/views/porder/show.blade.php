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
  <div id="cover_detail_table">
    {{$store_mine[0]['name']}} <br>
    {{$store_mine[0]['address']}} <br>
    เบอร์โทรศัทพ์ {{$store_mine[0]['phone']}}
  </div>
  <div id="title_table">
    <h2>ใบสั่งซื้อ</h2>
  </div>
  <div id="store_ID_table">
    <table>
      <th>เลขที่เอกสาร PO</th>
      <th>{{$po_id['PO_ID']}}</th>
    </table>
  </div>
  <div id="store_table">
    <table id="table_store">
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
  <div id="product_table">
    <table id="table_product">
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
        @foreach($data as $num=>$row)
        <tr>
          <td style="width: 5%"><label>{{$num+1}}</label></td>
          <td style="width: 25%"><label value="{{$row['Product_name']}}" name="" required>{{$row['Product_name']}}</label>
          <td style="width: 10%"><label value="{{$row['Product_number']}}" name="" required>{{$row['Product_number']}}</label></td>
          <td style="width: 10%"><label value="{{$row['unit']}}" name="" required>{{$row['unit']}}</label>
          <td style="width: 10%"><label value="{{$row['price']}}" required>{{$row['price']}}</label></td>
          <td style="width: 15%"><label value="{{$row['product_sum']}}" required>{{$row['product_sum']}}</label></td>
        </tr>
        @endforeach
        @for($i = $number ; $i <= 10 ; $i++) <tr>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          </tr>
          @endfor
      </tbody>
      <tfoot>
        <tr>
          <th style="vertical-align:top" rowspan="3">หมายเหตุ</th>
          <td style="vertical-align:top" rowspan="3" colspan="3">สำหรับ &nbsp; {{$convert[0]['prequestconvert']}}&nbsp;PR &nbsp;{{$po_id['keyPR']}} <br> ส่งสินค้า ถนนวงแหวนรอบ3 หลังอรสิริน บิสสิเนส 3 (แยกท่ารั้ว)<br>ติดต่อสั่งชื้อ {{$store_mine[0]['contect']}}&nbsp; {{$store_mine[0]['cellphone']}} </td>
          <th>ราคายังไม่รวมภาษี</th>
          <td style="text-align:center">{{$sum_price}}</td>
        </tr>
        <tr>
          <th>ส่วนลด</th>
          <td></td>
        </tr>
        <tr>
          <th>ภาษีมูลค่าเพิ่ม 7%</th>
          <td style="text-align:center">{{$tax}}</td>
        </tr>
        <tr>
          <th>ตัวอักษร</th>
          <td colspan="3">&nbsp;&nbsp;{{$letter_sumofprice}}</td>
          <th>รวมทั้งสิ้น</th>
          <td style="text-align:center">{{$data[0]['sumofprice']}}</td>
        </tr>
      </tfoot>
    </table>
  </div>
  <div id="signature_1">
    <img id="signatureimg" src="{{Auth::user()->signature}}" alt="">
    <h4>{{ Auth::user()->firstname }}&nbsp;&nbsp;{{ Auth::user()->lastname }}<br>{{ Auth::user()->role }}<br>วันที่ {{ date('d-m-Y') }}</h4>
  </div>
  <div id="signature_2">
    <img id="signatureimg" src="{{Auth::user()->signature}}" alt="">
    <h4>{{ Auth::user()->firstname }}&nbsp;&nbsp;{{ Auth::user()->lastname }}<br>{{ Auth::user()->role }}<br>วันที่ {{ date('d-m-Y') }}</h4>
  </div>
  <div id="contrator">
    <img id="signatureimg" src="{{Auth::user()->signature}}" alt="">
    <h4>{{ Auth::user()->firstname }}&nbsp;&nbsp;{{ Auth::user()->lastname }}<br>{{ Auth::user()->role }}<br>วันที่ {{ date('d-m-Y') }}</h4>
  </div>
</div>

@endsection