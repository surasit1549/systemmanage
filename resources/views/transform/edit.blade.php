@extends('Home.master')
@section('title','แก้ไขแปลง')
@section('tabbarcss')
<style>
  #transformtab {
    border-right: 5px solid rgb(41, 207, 219);
  }
</style>
@stop
@section('content')
<div class="container">
  <div class="card" style="width:25rem;">
    <div class="card-header text-white">
      <h3><i class="far fa-file"></i>&nbsp;&nbsp;แก้ไขข้อมูลแปลง</h3>
    </div>
    <div class="card-body">
      <form method="post" id="forminput" action="{{action('TransformController@update', $id)}}" class="needs-validation" novalidate>
        {{csrf_field()}}
        <div class="form-group">
          <label>ชื่อแปลง</label>
          <input type="text" name="convertname" class="form-control" value="{{$transform->convertname}}" required>
          <label for="" class="invalid-feedback">
            กรอกชื่อแปลง
          </label>
        </div>
        <div class="form-group">
          <label>ขนาด</label>
          <input type="text" name="size" class="form-control" value="{{$transform->size}}" required>
          <label for="" class="invalid-feedback">
            กรอกชื่อขนาดแปลง
          </label>
        </div>
        <br>
        <div class="form-group text-center">
          <a class="ml-2 btn btn-danger" href="#" onclick="window.history.back()"><i style="font-size:18px;" class="fas fa-undo-alt"></i>&nbsp;&nbsp;ย้อนกลับ</a>
          <a href="#" id="subform" data-toggle="modal" data-target="#passcode_confirm" class="btn btn-success ml-2"><i style="font-size:18px" class="fas fa-save"></i>&nbsp;&nbsp;บันทึก</a>
        </div>

        <input type="hidden" name="id" value="{{ $transform->id }}">
        <input type="hidden" name="_method" value="PATCH" />
        <input type="hidden" name="transform_id" value="{{$id}}">
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


    $('#passcode_confirm').on('shown.bs.modal', function() {
      $(this).find('input[name=passkey]').focus();
    }).on('hidden.bs.modal', function() {
      $(this).find('input[name=passkey]').val('');
    });

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