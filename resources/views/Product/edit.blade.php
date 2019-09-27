@extends('Home.master')
@section('title','แก้ไขแปลง')
@section('tabbarcss')
<style>
  #store_menutab {
    border-right: 5px solid rgb(41, 207, 219);
  }
</style>
@stop
@section('content')
<div class="container">
  <div class="card" style="width:25rem;">
    <div class="card-header">
      <h3 class="card-title text-white"><i class="far fa-file"></i>&nbsp;&nbsp;แก้ไขข้อมูลสินค้า</h3>
    </div>
    <div class="card-body">
      <form method="post" id="forminput" action="{{action('ProductController@update', $id)}}" class="needs-validation" novalidate>
        {{csrf_field()}}
        <div class="form-group">
          <label for="">รหัสสินค้า</label>
          <input type="text" name="Product_ID" class="form-control" value="{{$product->Product_ID}}" autocomplete="off" required>
          <label for="" class="invalid-feedback">
            กรอกชื่อรหัสสินค้า
          </label>
        </div>
        <div class="form-group">
          <label for="">ชื่อสินค้า</label>
          <input type="text" name="Product_name" class="form-control" value="{{$product->Product_name}}" autocomplete="off" required>
        </div>
        <div class="form-group">
          <label for="">หน่วยสินค้า</label>
          <input type="text" name="unit" list="units" class="form-control" value="{{$product->unit}}" autocomplete="off" required>
          <datalist id="units">
            <option value="กล่อง">
            <option value="ถุง">
            <option value="เส้น">
            <option value="ถัง">
            <option value="กระสอบ">
            <option value="ชิ้น">
          </datalist>
        </div>
        <br>
        <div class="form-group text-center">
          <a class="btn btn-danger" href="#" onclick="window.history.back()"><i class="fas fa-undo"></i>&nbsp;&nbsp;ย้อนกลับ</a>
          &nbsp;
          <a href="#" id="subform" data-toggle="modal" data-target="#passcode_confirm" class="btn btn-success ml-2"><i style="font-size:18px" class="fas fa-save"></i>&nbsp;&nbsp;บันทึก</a>
        </div>
        <input type="hidden" name="_method" value="PATCH" />
        <input type="hidden" name="product_id" value="{{$product->id}}">
      </form>
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

          $('#checkmenu').click();

          $('#subform').click(function() {
            if ($('form')[0].checkValidity() == false) {
              event.preventDefault();
              event.stopPropagation();
              $('form').addClass('was-validated');
            }
          });
        });
</script>

@endsection