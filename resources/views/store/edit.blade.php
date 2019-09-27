@extends('Home.master')
@section('title','จัดการฐานข้อมูล')
@section('tabbarcss')
<style>
  #storetab {
    border-right: 5px solid rgb(41, 207, 219);
  }
</style>
@stop
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header text-white">
          <h3><i class="fas fa-user-edit"></i>&nbsp;&nbsp;แก้ไขข้อมูลร้านค้า</h3>
        </div>
        <div class="card-body">
          <form method="post" id="forminput" action="{{action('StoreController@update', $id)}}" class="needs-validation" novalidate>
            {{csrf_field()}}
            <br>
            <h3>รายละเอียดร้านค้า</h3>
            <hr class="line">
            <br>
            <div class="form-row">
              <div class="form-group col-md-3">
                <label>รหัสร้านค้า</label>
                <input type="text" name="keystore" class="form-control" value="{{$store->keystore}}" required>
                <label class="invalid-feedback">กรอกรหัสร้านค้า</label>
              </div>

              <div class="form-group col-md-9">
                <label>ชื่อร้านค้า</label>
                <input type="text" name="name" class="form-control" placeholder="ป้อนร้านค้า" value="{{$store->name}}" required>
                <label class="invalid-feedback">กรอกชื่อร้านค้า</label>
              </div>
            </div>

            <div class="form-group">
              <label>ที่อยู่ในปัจจุบัน</label>
              <textarea type="text" name="address" class="form-control" cols="70" placeholder="ที่อยู่ปัจจุบัน" required>{{$store->address}}</textarea>
              <label class="invalid-feedback">กรอกที่อยู่ปัจจุบัน</label>
            </div>

            <div class="form-row">

              <div class="form-group col-md-6">
                <label>โทรศัทท์</label>
                <input type="text" name="phone" class="form-control" value="{{$store->phone}}" pattern="[0-9]{10}" required>
                <label class="invalid-feedback">กรอกเบอร์โทรศัพท์ให้ถูกต้องไม่ต้องมี (-) ตัวอย่าง 0234567895</label>
              </div>

              <div class="form-group col-md-6">
                <label>โทรสาร</label>
                <input type="text" name="fax" class="form-control" value="{{$store->fax}}" pattern="[0-9]{9}" required>
                <label class="invalid-feedback">กรอกเบอร์โทรสารให้ถูกต้องไม่ต้องมี (-) ตัวอย่าง 053894659</label>
              </div>

            </div>
            <br>
            <h3>ข้อมูลผู้ติดต่อ</h3>
            <hr class="line">
            <br>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label>ชื่อผู้ติดต่อ</label>
                <input type="text" name="contect" class="form-control" placeholder="ชื่อ - นามสกุล" value="{{$store->contect}}" required>
                <label class="invalid-feedback">กรอกชื่อผู้ติดต่อ</label>
              </div>

              <div class="form-group col-md-6">
                <label>โทรศัพท์ผู้ติดต่อ</label>
                <input type="text" name="cellphone" class="form-control" value="{{$store->cellphone}}" pattern="[0-9]{10}" required>
                <label class="invalid-feedback">กรอกเบอร์โทรศัพท์ผู้ติดต่อให้ถูกต้องไม่ต้องมี (-) ตัวอย่าง 0234567895</label>
              </div>
            </div>

            <div class="form-group text-right mt-3">
              <a class="ml-2 btn btn-danger" href="#" onclick="window.history.back()"><i style="font-size:18px;" class="fas fa-undo-alt"></i>&nbsp;&nbsp;ย้อนกลับ</a>
              <button id="subform" type="submit" class="btn btn-success ml-2"><i class="far fa-edit"></i>&nbsp;&nbsp;บันทึกข้อมูล</button>
            </div>
            <input type="hidden" name="_method" value="PATCH" />
            <input type="hidden" name="store_id" value="{{$id}}">
          </form>
        </div>
      </div>
    </div>
  </div>
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


    $('#subform').click(function() {
      event.preventDefault();
      event.stopPropagation();
      if ($('form')[0].checkValidity() == false) {
        $('form').addClass('was-validated');
      } else {
        $('#passcode_confirm').modal('show');
      }
    });
  });
</script>

@endsection