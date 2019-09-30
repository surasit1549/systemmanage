@extends('Home.master')
@section('title','ใบขอสั่งซื้อ')
@section('tabbarcss')
<style>
  #person2 {
    border-right: 5px solid rgb(41, 207, 219);
  }

  #searchtext:focus {
    outline: none !important;
    box-shadow: none;
  }
</style>
@stop
@section('content')



<div class="card">
  <div class="card-header text-white">
    <h3><i class="far fa-plus-square"></i>&nbsp;&nbsp;ผู้มีอำนาจคนที่ 2</h3>
  </div>
  <div class="card-body">
    <form method="post" action="{{action('mastertwoController@update', $id)}}" id="forminput" class="needs-validation" novalidate>
      {{csrf_field()}}
      <div class="row">
        <div class="form-group col-md-6">
          <a class="btn btn-info text-white" onclick="location.reload();">Refresh</a>
        </div>
        <div class="form-group col-md-6 text-right">
          <label>วันที่ขอสั่งชื้อ</label><br>
          <label value="{{$pr_create[0]['date']}}" class="border-0" size="8" autocomplete="off"></label>
          <input type="hidden" name="date" value="{{$pr_create[0]['date']}}" class="border-0" size="8" autocomplete="off">
          <input type="hidden" name="id" value="{{$id}}" class="border-0" size="8" autocomplete="off">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-4">
          <label>เลขที่เอกสาร</label>
          <label type="text" class="form-control" autocomplete="off" required>{{$pr_create[0]['key']}}</label>
          <input type="hidden" name="keyPR" class="form-control" value="{{$pr_create[0]['key']}}" autocomplete="off" required>

        </div>
        <div class="form-group col-md-8">
          <label>ชื่อผู้รับเหมา</label>
          <label class="form-control" autocomplete="off" required>{{$pr_create[0]['contractor']}}</label>

          <input type="hidden" name="contractor" class="form-control" value="{{$pr_create[0]['contractor']}}" autocomplete="off" required>

        </div>
      </div>

      <div class="form-row">
        <div class="form-group col-md-6">
          <label>แบบงาน</label>
          <label class="form-control" required>{{$pr_create[0]['formwork']}}</label>
          <input type="hidden" name="formwork" class="form-control" value="{{$pr_create[0]['formwork']}}" required>
        </div>
        <div class="form-group col-md-6">
          <label>แปลง</label>
          <label class="form-control" required>{{$pr_create[0]['prequestconvert']}}</label>
          <input type="hidden" name="prequestconvert" class="form-control" value="{{$pr_create[0]['prequestconvert']}}" required>
        </div>
      </div>
      <input type="hidden" name="_method" value="PATCH" />
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
          @foreach($data_master2 as $row)
          <input type="hidden" name="Product_name[]" value="$row['Product_name']">
          <input type="hidden" name="Product_number[]" value="{{$row['Product_number']}}">
          <input type="hidden" name="unit[]" value="{{$row['unit']}}"> 
          <input type="hidden" name="keystore[]" value="{{$row['Store']}}">
          <input type="hidden" name="price[]" value="{{$row['price']}}">
          <input type="hidden" name="product_sum[]" value="{{$row['product_sum']}}">
          <input type="hidden" name="sum" id="sumofprice" value="{{$data_master2[0]['sumallprice']}}">
          <tr>
            <td class="text-center"><label class="col-form-label">{{$number++}}</label></td>
            <td class="text-center result"><label  class="form-control productname border-0" required>{{$row['Product_name']}}</label>
            <td class="text-center result"><label min="1" class="form-control productnumber border-0" required>{{$row['Product_number']}}</label></td>
            <td class="text-center result"><label class="form-control unit border-0" required>{{$row['unit']}}</label>
            <td>
              <label class="form-control keystore" required>{{$row['Store']}}</label>
            </td>
            <td class="text-center result"><label min="1" class="form-control price border-0" required>{{$row['price']}}</label></td>
            <td class="text-center result"><label min="1" class="sum col-form-label border-0" required>{{$row['product_sum']}}</label></td>
          </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <th></th>
            <th class="text-right" colspan="4">รวมเป็นเงิน</th>
            <th class="text-center"><label id="sumofprice" class="text-danger">{{$data_master2[0]['sumallprice']}}</label></th>
            <th class="text-center">บาท</th>
          </tr>
        </tfoot>
      </table>
  </div>
  <div class="form-group text-center">
    <a class="btn btn-danger" href="#" onclick="window.history.back()"><i style="font-size:18px" class="fas fa-undo-alt"></i>
      &nbsp;&nbsp;ย้อนกลับ</a>
    <a href="#" id="subform" data-toggle="modal" data-target="#passcode_confirm" class="btn btn-success ml-2" value="Update"><i class="fas fa-save"></i>
      &nbsp;&nbsp;ตกลง</a> </div>
  <input type="hidden" name="_method" value="PATCH" />
  </form>
</div>


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


<script>
  $(document).ready(function() {
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
            $('#forminput').submit();
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

@endsection