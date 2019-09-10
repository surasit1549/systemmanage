@extends('Home.master')
@section('title','ข้อมูลรายการผู้รับเหมา')
@section('content')

<script>
  $(document).ready(function() {
    $('#exportpdfbtn').click(function(e) {
      e.preventDefault();
      e.stopPropagation();
      var key = $('input[name=key]').val();
      $.ajax({
        type: 'post',
        url: 'makepdf',
        data: {
          _token: '{{csrf_token()}}',
          keypr: key,
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
      <h3><i class="far fa-file-alt"></i>&nbsp;&nbsp;รายการของผู้รับเหมา</h3>
    </div>
    <div class="card-body">
      <form method="post" action="{{action('pr_createController@show', $id)}}">
        {{csrf_field()}}
        <div class="row">
          <div class="col-form-label col-md-6">
            <h4 class="d-inline shadow-sm" style="padding:10px"><label class="text-danger">&nbsp;PR {{$pr_create['key']}}</label></h4>
          </div>
          <div class='col-md-6 text-right'>
            <button class="btn btn-lg btn-primary" id="exportpdfbtn"><i class="fas fa-print"></i>&nbsp;&nbsp;พิมพ์เอกสาร</button>
          </div>
        </div>
        <hr>

        <div class="container">
          <table class="table table-borderless">
            <tr>
              <th>
                เลขที่เอกสารผู้รับเหมา
                </td>
              <td>
                {{$pr_create['key']}}
                <input type="hidden" name="key" value="{{$pr_create['key']}}">
              </td>
              <th>
                วันที่ขอสั่งซื้อ
                </td>
              <td>
                {{$pr_create['date']}}
              </td>
            </tr>
            <tr>
              <th>
                ชื่อผู้รับเหมา
                </td>
              <td>
                {{$pr_create['contractor']}}
              </td>
              <th>
                แบบงาน
                </td>
              <td>
                {{$pr_create['formwork']}}
              </td>
            </tr>
            <tr>
              <th>แปลง</th>
              <td>
                {{$pr_create['prequestconvert']}}
              </td>
            </tr>
          </table>
        </div>

        <table class="table table-hover table-bordered">
          <thead class="text-center">
            <tr>
              <th style="width:10%">ลำดับ</th>
              <th style="width:35%">ชื่อสินค้า</th>
              <th style="width:30%">จำนวนสินค้า</th>
              <th style="width:20%">หน่วย</th>
            </tr>
          </thead>
          <tbody>
            @foreach($pr_products as $row)
            <tr>
              <td>{{$number++}}</td>
              <td>{{$row['productname']}}</td>
              <td>{{$row['productnumber']}}</td>
              <td>{{$row['unit']}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <br>
        <div class="text-center">
          <a class="btn btn-danger" href="#" onclick="window.history.back()"><i class="fas fa-undo"></i>&nbsp;&nbsp;ย้อนกลับ</a>
        </div>
      </form>
    </div>
  </div>
</div>

<div id="exportpdf" class="d-none">
  <div id="heading">
    <h3 style="text-align:center">ใบขอสั่งซื้อ<br>PURCHASE REQUEST</h3>
  </div>
  <div id="tabletop">
    <table>
      <tr>
        <th>เลขที่เอกสาร</th>
        <td id="prcode_ex">{{$pr_create['key']}}</td>
      </tr>
      <tr>
        <th>วันที่ขอสั่งซื้อ</th>
        <td id="date_ex">{{$pr_create['date']}}</td>
      </tr>
    </table>
  </div>
  <div id="exporta">
    <table id="tableexa">
      <tbody>
        <tr>
          <th>TO :</th>
          <td>THERA ASSET CO.,LTD</td>
          <th style="padding-left:30px">งวดงานที่</th>
          <td>...............</td>
        </tr>
        <tr>
          <th>ชื่อผู้รับเหมา</th>
          <td id="name_ex">{{$pr_create['contractor']}}</td>
          <th style="padding-left:30px">แปลง</th>
          <td id="transform_ex">{{$pr_create['formwork']}}</td>
        </tr>
        <tr>
          <th>แบบงาน</th>
          <td id="work_ex">{{$pr_create['prequestconvert']}}</td>
        </tr>
      </tbody>
    </table>
  </div>
  <table id="exportb">
    <thead>
      <tr>
        <th id="no_exb">ลำดับ</th>
        <th id="detail_exb">รายการสินค้า</th>
        <th id="num_exb">จำนวน</th>
        <th id="unit_exb">หน่วย</th>
      </tr>
    </thead>
    <tbody>
      @foreach($pr_products as $num=>$row)
      <tr>
        <td>{{$num + 1}}</td>
        <td>{{$row['productname']}}</td>
        <td>{{$row['productnumber']}}</td>
        <td>{{$row['unit']}}</td>
      </tr>
      @endforeach
      @for($i = $number ; $i <= 10 ; $i++) <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        </tr>
        @endfor
    </tbody>
  </table>
</div>
@endsection