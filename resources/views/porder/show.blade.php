@extends('Home.master')
@section('title','ข้อมูลใบสั่งซื้อ PO')
@section('tabbarcss')
<style>
  #potab {
    border-right: 5px solid rgb(41, 207, 219);
  }
</style>
@stop
@section('content')

<script>
  $(document).ready(function() {
    $('#prpo_form').click();
    $('#exportpdfbtn').click(function(e) {
      e.preventDefault();
      e.stopPropagation();
      var key = $('input[name=key]').val();
      $.ajax({
        type: 'post',
        url: 'makepdf',
        data: {
          _token: '{{csrf_token()}}',
          keyPO: key,
          img: $('#logo_po').html(),
          pdf: $('#exportpdf').html(),
          po: $('#ponumber').text()
        },
        success: function(data) {
          alert("ดาวห์โหลด PDF สำเร็จ");
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
            <h4 class="d-inline shadow-sm" style="padding:10px"><label class="text-danger">&nbsp;PO <span id="po_number">{{$po_id[0]['PO_ID']}}</span></label></h4>
          </div>
        </div>
        <hr>
        <div class="container">
          <table class="table table-borderless">
            <tr>
              <th> ผู้ขาย :</th>
              <td>
                {{$store[0]['name']}}&nbsp;&nbsp; [ {{$store[0]['keystore']}} ]
                <input type="hidden" name="key" value="{{$po_id[0]['PO_ID']}}">
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
            @for($i = $number ; $i <= 10 ; $i++) <tr>
              <td>&nbsp;</td>
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
              <td style="vertical-align:top" rowspan="3" colspan="3">สำหรับ &nbsp; {{$convert[0]['prequestconvert']}}&nbsp;PR &nbsp;{{$po_id[0]['keyPR']}} <br> ส่งสินค้า ถนนวงแหวนรอบ3 หลังอรสิริน บิสสิเนส 3 (แยกท่ารั้ว)<br>ติดต่อสั่งชื้อ {{$store_mine[0]['contact_name']}}&nbsp; {{$store_mine[0]['contact_phone']}} </td>
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
        <br>
        <div class="text-center">
          <a class="btn btn-danger btn-lg" href="{{route('porder.index')}}"><i class="fas fa-undo"></i>&nbsp;&nbsp;ย้อนกลับ</a>
        </div>
      </form>
    </div>
  </div>
</div>


<div id="exportpdf" class="d-none">
  <div id="img_po">
    <img src="https://s3.ap-southeast-1.amazonaws.com/document-flow-s3/image/BIvmEHY90liloV3kTZLoqXHxmxCh6XXeRaeO8GBP.png" alt="test">
  </div>
  <div id="cover_detail1_table">
    {{$store_mine[0]['name']}}
  </div>
  <div id="cover_detail2_table">
    {{$store_mine[0]['address']}}
  </div>
  <div id="cover_detail3_table">
    เบอร์โทรศัทพ์ {{$store_mine[0]['phone']}}
  </div>
  <div id="title_table">
    <h2>ใบสั่งซื้อ</h2>
  </div>
  <div id="store_ID_table">
    <table>
      <th style="font-size: 22px;">เลขที่เอกสาร PO</th>
      <th style="font-size: 22px;">{{$po_id[0]['PO_ID']}}</th>
    </table>
  </div>
  <div id="store_table">
    <table id="table_store">
      <tr>
        <th style="text-align:left"> ผู้ขาย :</th>
        <td style="text-align:left;">
          {{$store[0]['name']}}&nbsp;&nbsp; [ {{$store[0]['keystore']}} ]
        </td>
        <th style="text-align:left"> วันที่เอกสาร :</th>
        <td style="text-align:left;">
          {{substr($data[0]['created_at'],0,-9)}}
        </td>
      </tr>
      <tr>
        <th style="text-align:left"> ที่อยู่ :</td>
        <td style="text-align:left;">
          {{$store[0]['address']}}
        </td>
        <th style="text-align:left"> ผู้ติดต่อ : </th>
        <td style="text-align:left;">
          {{$store[0]['contect']}} &nbsp;&nbsp; {{$store[0]['cellphone']}}
        </td>
      </tr>
      <tr>
        <th style="text-align:left"> โทรศัพท์ :</th>
        <td style="text-align:left;">
          {{$store[0]['phone']}}
        </td>
        <th style="text-align:left"> วันที่กำหนดส่ง : </th>
        <td>

        </td>
      </tr>
      <tr>
        <th style="text-align:left"> โทรสาร : </th>
        <td style="text-align:left;">
          {{$store[0]['fax']}}
        </td>
        <th style="text-align:left"> จำนวนเครดิต : </th>
        <td>

        </td>
      </tr>
      <tr>
        <th> </th>
        <td> </td>
        <th style="text-align:left"> เงื่อนไขการชำระ : </th>
        <td>

        </td>
      </tr>
    </table>
  </div>
  <div id="product_table">
    <table id="table_product">
      <thead>
        <tr>
          <th style="width: 5%;height: 50px;">ลำดับที่</th>
          <th style="width: 35%;height: 50px;">ชื่อสินค้า</th>
          <th style="width: 15%;height: 50px;">จำนวนสินค้า</th>
          <th style="width: 10%;height: 50px;">หน่วย</th>
          <th style="width: 5%;height: 50px;">ราคา (บาท)</th>
          <th style="width: 15%;height: 50px;">จำนวนเงิน</th>
        </tr>
      </thead>
      <tbody>
        @foreach($data as $num=>$row)
        <tr>
          <td ><label>{{$num+1}}</label></td>
          <td ><label value="{{$row['Product_name']}}" name="" required>{{$row['Product_name']}}</label>
          <td ><label value="{{$row['Product_number']}}" name="" required>{{$row['Product_number']}}</label></td>
          <td ><label value="{{$row['unit']}}" name="" required>{{$row['unit']}}</label>
          <td ><label value="{{$row['price']}}" required>{{$row['price']}}.00</label></td>
          <td ><label value="{{$row['product_sum']}}" required>{{$row['product_sum']}}.00</label></td>
        </tr>
        @endforeach
        @for($i = $number ; $i <= 10 ; $i++) <tr>
          <td>&nbsp;</td>
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
          <td style="vertical-align:top" rowspan="3" colspan="3">&nbsp;สำหรับ &nbsp; {{$convert[0]['prequestconvert']}}&nbsp;PR &nbsp;{{$po_id[0]['keyPR']}} <br>&nbsp;ส่งสินค้า ถนนวงแหวนรอบ3 หลังอรสิริน บิสสิเนส 3 (แยกท่ารั้ว)<br>&nbsp;ติดต่อสั่งชื้อ {{$store_mine[0]['contact_name']}}&nbsp; {{$store_mine[0]['contact_phone']}} <br><br><br><br><br> </td>
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
          <td style="text-align:center">{{$data[0]['sumofprice']}}.00</td>
        </tr>
      </tfoot>
    </table>
  </div>
  <div id="signature_contractor_PO">
    <img id="signature_contractor_po_img" src="{{$contractor[0]->signature}}" alt="">
    <h4>{{ $contractor[0]->firstname }}&nbsp;&nbsp;{{ $contractor[0]->lastname }}<br>ผู้จัดทำ<br>วันที่ {{ $convert[0]['date'] }}</h4>
  </div>

  <div id="signature_master1_PO">
    <img id="signature_master1_po_img" src="{{$master1[0]->signature}}" alt="">
    <h4>{{ $master1[0]->firstname }}&nbsp;&nbsp;{{ $master1[0]->lastname }}<br>ผู้ตรวจสอบ<br>วันที่ {{ $convert[0]['date']  }}</h4>
  </div>

  <div id="signature_master2_PO">
    <img id="signature_master2_po_img" src="{{$master2[0]->signature}}" alt="">
    <h4>{{ $master2[0]->firstname }}&nbsp;&nbsp;{{ $master2[0]->lastname }}<br>ผู้อนุมัติ<br>วันที่ {{ $convert[0]['date'] }}</h4>
  </div>
</div>

@endsection