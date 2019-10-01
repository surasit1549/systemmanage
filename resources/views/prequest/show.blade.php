@extends('Home.master')
@section('title','ข้อมูลใบขอสั่งซื้อ PR')
@section('tabbarcss')
<style>
  #prtab {
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
          keyPR: key,
          pdf: $('#exportpdf').html(),
          pr: $('#ponumber').text()
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
      <h3><i class="far fa-file-alt"></i>&nbsp;&nbsp;ข้อมูลใบขอสั่งซื้อ</h3>
    </div>
    <div class="card-body">
      <form method="post" action="{{action('PuchaserequestController@show', $id)}}">
        {{csrf_field()}}
        <div class="row">
          <div class="col-form-label col-md-6">
            <h4 class="d-inline shadow-sm" style="padding:10px"><label class="text-danger">&nbsp;PR {{$pr_create[0]['key']}}</label></h4>
          </div>
          <div class='col-md-6 text-right'>
            <button class="btn btn-danger" id="exportpdfbtn"><i style="font-size:18px" class="far fa-file-pdf"></i>&nbsp;&nbsp;PDF</button>
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
            <h6>
              เลขที่เอกสาร <a>{{$pr_create[0]['key']}}</a>
              <input type="hidden" name="key" value="{{$pr_create[0]['key']}}">
            </h6>
            <h6>วันที่ขอสั่งซื้อ <a>{{$pr_create[0]['date']}}</a></h6>
          </div>
          <div id="data_information">
            <table id="tableexa">
              <tbody>
                <tr>
                  <th>TO :</th>
                  <td>THERA ASSET CO.,LTD</td>
                </tr>
                <tr>
                  <th>ชื่อผู้รับเหมา</th>
                  <td id="name_ex">{{$pr_create[0]['contractor']}}</td>
                  <th style="padding-left:30px">แปลง</th>
                  <td id="transform_ex">{{$pr_create[0]['prequestconvert']}}</td>
                </tr>
                <tr>
                  <th>แบบงาน</th>
                  <td id="work_ex">{{$pr_create[0]['formwork']}}</td>
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
                <th>ร้านค้า</th>
                <th>ราคา (บาท)</th>
                <th>จำนวนเงิน</th>
              </tr>
            </thead>
            <tbody>
              @foreach($pr_store as $num=>$row)
              <tr>
                <td style="width: 5%"><label>{{$num+1}}</label></td>
                <td style="width: 25%"><label value="{{$row['Product_name']}}" required>{{$row['Product_name']}}</label>
                <td style="width: 10%"><label value="{{$row['Product_number']}}" required>{{$row['Product_number']}}</label></td>
                <td style="width: 10%"><label value="{{$row['unit']}}" required>{{$row['unit']}}</label></td>
                <td style="width: 10%"><label value="{{$row['keystore']}}" required>{{$row['keystore']}}</label></td>
                <td style="width: 10%"><label value="{{$row['price']}}" required>{{$row['price']}}</label></td>
                <td style="width: 15%"><label value="{{$row['product_sum']}}" required>{{$row['product_sum']}}</label></td>
              </tr>
              @endforeach
              @for($i = $number ; $i <= 10 ; $i++) <tr>
                <td style="padding:10px 0px">&nbsp;</td>
                <td style="padding:10px 0px"></td>
                <td style="padding:10px 0px"></td>
                <td style="padding:10px 0px"></td>
                <td style="padding:10px 0px"></td>
                <td style="padding:10px 0px"></td>
                <td style="padding:10px 0px"></td>
                </tr>
                @endfor
            </tbody>
            <tfoot>
              <tr>
                <th style="vertical-align:top" rowspan="3">หมายเหตุ</th>
                <td style="vertical-align:top" rowspan="3" colspan="4">สำหรับ &nbsp; {{$pr_create[0]['prequestconvert']}}&nbsp;PR &nbsp;{{$pr_create[0]['key']}} <br> ส่งสินค้า ถนนวงแหวนรอบ3 หลังอรสิริน บิสสิเนส 3 (แยกท่ารั้ว)<br>ติดต่อสั่งชื้อ {{$store_mine[0]['contect']}}&nbsp; {{$store_mine[0]['cellphone']}} </td>
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
                <td colspan="4">&nbsp;&nbsp;{{$letter_sumofprice}}</td>
                <th>รวมทั้งสิ้น</th>
                <td style="text-align:center">{{$pr_store[0]['sumofprice']}}</td>
              </tr>
            </tfoot>
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

<div id="exportpdf" class="d-none">
  <div id="img_pr">
    <img src="https://s3.ap-southeast-1.amazonaws.com/document-flow-s3/image/BIvmEHY90liloV3kTZLoqXHxmxCh6XXeRaeO8GBP.png" alt="test">
  </div>
  <div id="store_detail1_table">
    {{$store_mine[0]['name']}}
  </div>
  <div id="store_detail2_table">
    {{$store_mine[0]['address']}}
  </div>
  <div id="store_detail3_table">
    เบอร์โทรศัทพ์ {{$store_mine[0]['phone']}}
  </div>
  <div id="pr_ID">
    เลขที่เอกสาร {{$pr_create[0]['key']}} <br>
    วันที่ขอสั่งซื้อ {{$pr_create[0]['date']}}
  </div>
  <div id="data_information">
    <table id="tableexa">
      <tbody>
        <tr>
          <th>TO :</th>
          <td style="text-align: left;">THERA ASSET CO.,LTD</td>
        </tr>
        <tr>
          <th>ชื่อผู้รับเหมา</th>
          <td style="width:30%;text-align: left;">{{ $contractor[0]->firstname }}&nbsp;&nbsp;&nbsp;{{ $contractor[0]->lastname }}</td>
          <th >แปลง</th>
          <td style="width:30%;text-align: left;">{{$pr_create[0]['prequestconvert']}}</td>
        </tr>
        <tr>
          <th>แบบงาน</th>
          <td style="width:30%;text-align: left;">{{$pr_create[0]['formwork']}}</td>
        </tr>
      </tbody>
    </table>
  </div>
  <div id="product">
    <table id="table_product">
      <thead>
        <tr>
          <th style="width: 5%;height: 50px;">ลำดับที่</th>
          <th style="width: 25%;height: 50px;">ชื่อสินค้า</th>
          <th style="width: 8%;height: 50px;">จำนวนสินค้า</th>
          <th style="width: 10%;height: 50px;">หน่วย</th>
          <th style="width: 30%;height: 50px;">ร้านค้า</th>
          <th style="width: 5%;height: 50px;">ราคา <br> (บาท)</th>
          <th style="width: 10%;height: 50px;">จำนวนเงิน</th>
        </tr>
      </thead>
      <tbody>
        @foreach($pr_store as $num=>$row)
        <tr>
          <td ><label>{{$num+1}}</label></td>
          <td ><label value="{{$row['Product_name']}}" required>{{$row['Product_name']}}</label>
          <td ><label value="{{$row['Product_number']}}" required>{{$row['Product_number']}}</label></td>
          <td ><label value="{{$row['unit']}}" required>{{$row['unit']}}</label></td>
          <td ><label value="{{$row['keystore']}}" required>{{$row['keystore']}}</label></td>
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
          <td></td>
          </tr>
          @endfor
      </tbody>
      <tfoot>
        <tr>
          <th style="vertical-align:top" rowspan="3">หมายเหตุ</th>
          <td style="vertical-align:top" rowspan="3" colspan="4">&nbsp;สำหรับ &nbsp; {{$pr_create[0]['prequestconvert']}}&nbsp;PR &nbsp;{{$pr_create[0]['key']}} <br>&nbsp; ส่งสินค้า ถนนวงแหวนรอบ3 หลังอรสิริน บิสสิเนส 3 (แยกท่ารั้ว)<br>&nbsp;ติดต่อสั่งชื้อ {{$store_mine[0]['contect']}}&nbsp; {{$store_mine[0]['cellphone']}} </td>
          <th>ราคายังไม่<br>รวมภาษี</th>
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
          <td colspan="4">&nbsp;&nbsp;{{$letter_sumofprice}}</td>
          <th>รวมทั้งสิ้น</th>
          <td style="text-align:center">{{$pr_store[0]['sumofprice']}}.00</td>
        </tr>
      </tfoot>
    </table>
  </div>
  <div id="signature_contractor_PR">
    <img id="signature_contractor_pr_img" src="{{$contractor[0]->signature}}" alt="">
    <h4>ผู้ขอซื้อ&nbsp;&nbsp;{{ $contractor[0]->firstname }}&nbsp;&nbsp;{{ $contractor[0]->lastname }}<br>( ควบคุมงาน บ. )</h4>
  </div>

  <div id="signature_master1_PR">
    <img id="signature_master1_pr_img" src="{{$master1[0]->signature}}" alt="">
    <h4>ผู้อนุมัติการสั่งซื้อ&nbsp;&nbsp;{{ $master1[0]->firstname }}&nbsp;&nbsp;{{ $master1[0]->lastname }}<br>( กรรมการ/ผู้จัดการโครงการ )</h4>
  </div>

  <div id="signature_master2_PR">
    <img id="signature_master2_pr_img" src="{{$Purchasing[0]->signature}}" alt="">
    <h4>{{ $role_purchasing[0]['name_role'] }}&nbsp;&nbsp;{{ $Purchasing[0]->firstname }}&nbsp;&nbsp;{{ $Purchasing[0]->lastname }}<br>วันที่ {{$date_master2}}</h4>
  </div>

</div>
@endsection