@extends('Home.master')
@section('title','ใบขอสั่งซื้อ')
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

    function sumofeachprice() {
      var sum = 0.00;
      $('#main_table tbody tr').each(function() {
        sum += parseFloat($('td:last input', this).val());
      });
      $('.sumprice').val(sum.toFixed(2));
    }


    $('.price_item').blur(function() {
      var num = $(this).parent().prevAll().eq(2).children('.productnumber').text();
      var sum = parseInt(num) * parseFloat($(this).val());
      $(this).val(parseFloat($(this).val()).toFixed(2));
      $(this).parent().next('td').children('input').val(sum.toFixed(2));
      sumofeachprice();
    });

    $('.select_store').chosen({
      width: "95%"
    });

    $('.select_store').change(function() {
      var price = $(this).parent().next('td').children('.price_item');
      var subval = $(this).val().split(':');
      var store_id = subval[0];
      var product_id = subval[1];
      var point = $(this).parent();
      $.ajax({
        url: '/prequest/getprice',
        type: 'post',
        data: {
          _token: '{{csrf_token()}}',
          store_id: store_id,
          product_id: product_id
        },
        success: function(data) {
          price.val(data.msg);
          console.log(data.msg);
          var perprice = parseInt(point.parent().find('.productnumber').text()) * price.val();
          point.next().next().children('input').val(perprice.toFixed(2));
          sumofeachprice();
        }
      });

    });


    $('#prpo_form').click();
    $('#passcode_confirm').on('shown.bs.modal', function() {
      $(this).find('input[name=passkey]').focus();
    }).on('hidden.bs.modal', function() {
      $(this).find('input[name=passkey]').val('');
    });

    $('#sub_confirm').click(function(e) {
      e.preventDefault();
      e.stopPropagation();
      $.ajax({
        type: 'POST',
        url: 'checkpasscode',
        data: {
          _token: '{{csrf_token()}}',
          passkey: $('input[name=passkey]').val()
        },
        success: function(data) {
          if (data.msg) {
            $('#formsub').submit();
          } else {
            Swal.fire({
              type: 'error',
              title: 'รหัสลับไม่ถูกต้อง',
              text: 'กรอกรหัสลับอีกครั้ง',
              confirmButtonText: 'ตกลง',
              onAfterClose: () => {
                $('input[name=passkey]').val('').focus();
              }
            })
          }
        }
      });
    });
  });
</script>
@if($pr_create['status'] === "active")
<div class="card">
  <div class="card-header text-white">
    <h3><i class="far fa-plus-square"></i>&nbsp;&nbsp;สร้างใบขอสั่งซื้อ PR</h3>
  </div>
  <div class="card-body">
    <form method="post" id="formsub" action="{{action('PuchaserequestController@update', $id)}}" class="needs-validation" novalidate>
      {{csrf_field()}}
      <div class="row">
        <div class="form-group col-md-12 text-right">
          <label>วันที่ขอสั่งชื้อ</label><br>
          <input type="text" name="date" value="{{$pr_create['date']}}" class="border-0 bg-light" size="8" readonly>
          <input type="hidden" name="id" value="{{$id}}" class="border-0">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-4">
          <label>เลขที่เอกสาร</label>
          <input type="text" name="keyPR" class="form-control" value="{{$pr_create['key']}}" autocomplete="off" disabled>
          <input type="hidden" name="keyPR" class="form-control" value="{{$pr_create['key']}}" autocomplete="off">
        </div>
        <div class="form-group col-md-8">
          <label>ชื่อผู้รับเหมา</label>
          <input type="text" name="contractor" class="form-control" value="{{$pr_create['contractor']}}" autocomplete="off" disabled>
          <input type="hidden" name="contractor" class="form-control" value="{{$pr_create['contractor']}}" autocomplete="off">
        </div>
      </div>

      <div class="form-row">
        <div class="form-group col-md-6">
          <label>แบบงาน</label>
          <input type="text" name="formwork" class="form-control" value="{{$pr_create['formwork']}}" disabled>
          <input type="hidden" name="formwork" class="form-control" value="{{$pr_create['formwork']}}">
        </div>
        <div class="form-group col-md-6">
          <label>แปลง</label>
          <input type="text" name="prequestconvert" class="form-control" value="{{$pr_create['prequestconvert']}}" disabled>
          <input type="hidden" name="prequestconvert" class="form-control" value="{{$pr_create['prequestconvert']}}">
        </div>
      </div>
      <!-- สินค้าที่ขอสั่งซื้อ -->
      <br>

      <table id="main_table" class="table table-hover table-bordered border-dark table-border-dark">
        <thead>
          <tr>
            <th colspan="4" class="text-center">จัดการสินค้า</th>
            <th colspan="4" class="text-center">จัดซื้อสินค้า</th>
          </tr>
          <tr class="text-center">
            <th style="width:5%;">ลำดับ</th>
            <th style="width:20%;">รายการสินค้า</th>
            <th style="width:10%;">จำนวน</th>
            <th style="width:10%;">หน่วย</th>
            <th style="width:30%">ร้านค้า</th>
            <th style="width:10%">ราคาต่อหน่วย</th>
            <th style="width:10%">ราคา</th>
          </tr>
        </thead>
        <tbody>
          @foreach($min as $row)
          <tr>
            <input type="hidden" name="Product_name[]" class="form-control productname border-0" value="{{$row[0]}}" name="" required>
            <input type="hidden" name="Product_number[]" min="1" class="form-control productnumber border-0" value="{{$row[1]}}" name="" required>
            <input type="hidden" name="unit[]" class="form-control unit border-0" value="{{$row[2]}}" name="" required>
            <td class="text-center"><label class="col-form-label">{{$number++}}</label></td>
            <td class="text-center result"><label class="form-control productname border-0">{{$row[0]}}</label></td>
            <td class="text-center result"><label min="1" class="form-control productnumber border-0">{{$row[1]}}</label></td>
            <td class="text-center result"><label class="form-control unit border-0">{{$row[2]}}</label></td>
            <td>
              <select class="custom-select select_store" name="keystore[]">
                @foreach($row[3] as $r)
                <option value="{{$r['Store']}}:{{$r['Product_ID']}}:{{$r['name']}}">{{$r['Store']}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$r['name']}}</option>
                @endforeach
              </select>
            </td>
            <td><input class="price_item form-control" name="store_price[]" type="number" value="{{$row[4]}}"></td>
            <td class="text-center">
              <input class="form-control text-center" type="number" name="store_sumprice[]" value="{{ $row[6] }}" readonly>
            </td>
          </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <th class="text-right" colspan="6">รวมเป็นเงิน</th>
            <td><input type="text" name="sumofprice" class="form-control text-center text-danger sumprice" value="{{ $sumde }}" readonly></td>
          </tr>
        </tfoot>
      </table>
  </div>

  <div class="form-group text-center">
    <a class="btn btn-danger" href="#" onclick="window.history.back()"><i style="font-size:18px" class="fas fa-undo-alt"></i>&nbsp;&nbsp;ย้อนกลับ</a>
    <a href="#" id="subform" data-toggle="modal" data-target="#passcode_confirm" class="btn btn-success ml-2" value="Update"><i style="font-size:18px" class="fas fa-save"></i>&nbsp;&nbsp;บันทึก</a>
  </div>
  <input type="hidden" name="_method" value="PATCH" />
  </form>
</div>

<input type="hidden" id="signature" value="{{ Auth::user()->signature }}">

<div class="modal fade" id="passcode_confirm">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5><i style="font-size:20px" class="fas fa-key mr-2 text-danger"></i>กรอกรหัสลับ</h5>
        <button data-dismiss="modal" class="close">&times;</button>
      </div>
      <div class="modal-body">
        {!! Form::open(['url' => '/checkpasscode']) !!}
        <div class="form-group">
          {!! Form::label('รหัสลับ') !!}
          {!! Form::password('passkey',['class' => 'form-control','maxlength' => 4]) !!}
        </div>
      </div>
      <div class="modal-footer">
        {!! Form::submit('ยืนยัน',['class' => 'btn btn-success','id' => 'sub_confirm']) !!}
        <a class="btn btn-secondary" data-dismiss="modal" href="#">ยกเลิก</a>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@else
<div class="card">
  <div class="card-header text-white">
    <h3><i class="far fa-plus-square"></i>&nbsp;&nbsp;สร้างใบขอสั่งซื้อ PR</h3>
  </div>
  <div class="card-body">
    <form method="post" id="formsub" action="{{action('PuchaserequestController@update', $id)}}" class="needs-validation" novalidate>
      {{csrf_field()}}
      <div class="row">
        <div class="form-group col-md-12 text-right">
          <label>วันที่ขอสั่งชื้อ</label><br>
          <label class="border-0 bg-light" size="8">{{$pr_create['date']}}</label>
          <input type="hidden" name="id" value="{{$id}}" class="border-0">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-4">
          <label>เลขที่เอกสาร</label>
          <label class="form-control" autocomplete="off">{{$pr_create['key']}}</label>
        </div>
        <div class="form-group col-md-8">
          <label>ชื่อผู้รับเหมา</label>
          <label class="form-control" autocomplete="off">{{$pr_create['contractor']}}</label>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group col-md-6">
          <label>แบบงาน</label>
          <label class="form-control">{{$pr_create['formwork']}}</label>
        </div>
        <div class="form-group col-md-6">
          <label>แปลง</label>
          <label class="form-control">{{$pr_create['prequestconvert']}}</label>
        </div>
      </div>
      <!-- สินค้าที่ขอสั่งซื้อ -->
      <br>

      <table class="table table-hover table-bordered border-dark table-border-dark">
        <thead>
          <tr>
            <th colspan="4" class="text-center">จัดการสินค้า</th>
            <th colspan="4" class="text-center">จัดซื้อสินค้า</th>
          </tr>
          <tr class="text-center">
            <th style="width:5%;">ลำดับ</th>
            <th style="width:20%;">รายการสินค้า</th>
            <th style="width:10%;">จำนวน</th>
            <th style="width:10%;">หน่วย</th>
            <th style="width:20%;">ร้านค้า</th>
            <th style="width:10%;">ราคาต่อหน่วย</th>
            <th style="width:15%;">รวม</th>
          </tr>
        </thead>
        <tbody>
          @foreach($min as $row)
          <tr>
            <td class="text-center"><label class="col-form-label">{{$number++}}</label></td>
            <td class="text-center result"><label class="form-control productname border-0" required>{{$row[0]}}</label></td>
            <td class="text-center result"><label min="1" class="form-control productnumber border-0" required>{{$row[1]}}</label></td>
            <td class="text-center result"><label class="form-control unit border-0" value="{{$row[2]}}" required>{{$row[2]}}</label></td>
            <td>
              <select class="custom-select" name="keystore[]">
                @foreach($row[3] as $r)
                <option value="{{$r['name']}}">{{$r['name']}}</option>
                @endforeach
              </select>
            </td>
            <td class="text-center result"><label min="1" class="form-control price border-0" required>{{$row[4]}}</label></td>
            <td class="text-center result"><label min="1" class="sum col-form-label border-0" required></label></td>
          </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <th></th>
            <th class="text-right" colspan="4">รวมเป็นเงิน</th>
            <th class="text-center">
              <input id="sumofprice" class="ax_sum text-danger border-0">
            </th>
            <th class="text-center">บาท</th>
          </tr>
        </tfoot>
      </table>
  </div>

  <div class="form-group text-center">
    <a class="btn btn-danger" href="#" onclick="window.history.back()"><i style="font-size:18px" class="fas fa-undo-alt"></i>&nbsp;&nbsp;ย้อนกลับ</a>
  </div>
  </form>
</div>
@endif
@endsection