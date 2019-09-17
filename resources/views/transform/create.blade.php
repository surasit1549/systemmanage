@extends('Home.master')
@section('title','เพิ่มแปลง')
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
      <h3><i class="fas fa-plus-square"></i>&nbsp;&nbsp;เพิ่มข้อมูลแปลง</h3>
    </div>
    <div class="card-body">
      <form method="post" action="{{url('transform')}}" class="needs-validation" novalidate>
        {{csrf_field()}}
        <div class="form-group">
          <label for="">ชื่อแปลง</label>
          <input type="text" name="convertname" class="form-control" autocomplete="off" id="convertname" required>
          <label for="" class="invalid-feedback">
            กรอกชื่อแปลง
          </label>
        </div>
        <div class="form-group">
          <label for="">ขนาด</label>
          <input type="text" name="size" class="form-control" autocomplete="off" required>
          <label for="" class="invalid-feedback">
            กรอกชื่อขนาดแปลง
          </label>
        </div>
    </div>
    <div class="form-group text-center">
      <a class="btn btn-danger" onclick="window.history.back()" href="#"><i class="fas fa-undo"></i>&nbsp;&nbsp;ย้อนกลับ</a>
      <button id="subform" type="submit" class="btn btn-success ml-2" value="Update"><i class="fas fa-save"></i>&nbsp;&nbsp;บันทึก</button>
    </div>
    </form>
  </div>
</div>
</div>

<script>
  $(document).ready(function() {

    $('#subform').click(function() {
      if ($('form')[0].checkValidity() == false) {
        event.preventDefault();
        event.stopPropagation();
        $('form').addClass('was-validated');
      }
      if ($('#convertname').val().indexOf(' ') > -1) {
        event.preventDefault();
        event.stopPropagation();
        Swal.fire({
          title: 'ชื่อแปลงไม่สามารถมีช่องว่างได้',
          text: 'กรอกชื่อแปลงให้ถูกต้อง',
          type: 'info',
          confirmButtonText: 'ตกลง'
        })
      }
    });
  });
</script>


@endsection